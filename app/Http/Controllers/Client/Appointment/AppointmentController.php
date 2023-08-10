<?php

namespace App\Http\Controllers\Client\Appointment;

use App\Events\AppointmentSuccessEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Appointment\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MomoPayment;
use App\Models\VnpayPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        //seo
        $meta_desc = "Getting vaccinated is an important step in protecting ourselves and our communities from the spread of infectious diseases. Making an appointment for a vaccine is a simple and straightforward process. First, check your eligibility for the vaccine based on your age, occupation, or underlying health conditions.";
        $meta_keywords = "Appointment about vaccine, Booking about vaccine, vaccination ";
        //$meta_title = "Appointment About Vaccine";
        $url_canonical = $request->url();
        $nurseList = Nurse::all();
        $doctorList = Doctor::all();
        $holidayList = DB::select('select dayoff from holiday');

        $holidayList = array_map(function($holiday) {
            return $holiday->dayoff;
        }, $holidayList); // lấy value ko lấy key

        return view('client.pages.appointment.appointment')
        ->with('doctorList',$doctorList) ->with('nurseList',$nurseList)->with('holidayList',$holidayList)
        ->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('url_canonical', $url_canonical);
    }

    public function getProductCategory($age) //lấy category theo độ tuổi người dùng nhập vào
    {
        $filter =[];
        if(!is_null( $age )){
            $filter[]=['minimum_limit_age', '<=', $age];
            $filter[]=['maximum_limit_age', '>=', $age];
            $filter[]=['status', 1];
        }
        // lấy category có product
        // $productCategories =ProductCategory::where($filter)->has('products')->get();
        // lấy category có product có status khác 0 và qty > 0
        $productCategories = ProductCategory::where($filter)
        ->whereHas('products', function ($query) {
            $query->where('status', '!=', 0)->where('qty', '>', 0);
        })
        ->get();
        echo json_encode($productCategories);
    }

    public function getProduct(string $id) //lấy product có id là id của product category người dùng chọn
    {
        $filter =[]; //lọc thêm lần nữa , không có cũng được
        if(!is_null( $id )){
            $filter[]=['product_category_id', $id];
            $filter[]=['qty', '>',0];
            $filter[]=['status', 1];
        }
        echo json_encode(Product::where($filter)->get());
    }

    public function getPrice(string $id) //lấy giá của product mà người dùng chọn
    {
        echo json_encode(DB::table('product')->where('id',$id)->get());
    }

    public function store(StoreAppointmentRequest $request)
    {
        try{
            DB::beginTransaction();
            $order_id = time();
            $check = Appointment::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'age' => $request->age,
                'users_id'=>$request->users_id,
                'doctor_id'=> $request->doctor_id,
                'nurse_id'=> $request->nurse_id,
                'product_category_id'=> $request->product_category_id,
                'product_id'=>$request->product_id,
                'date_appointment'=> $request->date_appointment,
                'time_appointment'=> $request->time_appointment,
                'total_price'=>$request->total_price,
                'status'=>$request->status,
                'pay_by'=>$request->pay_by,
                'status_payment' => "Unpaid",
                'order_id' => $order_id
            ]);
            DB::commit();
            if($check->pay_by == 1){ // chuyển qua momo
                $response = app()->call('App\Http\Controllers\Client\Appointment\AppointmentController@momo_payment', ['appointment' => $check]);
                return $response;
            }
            if($check->pay_by == 2){ //chuyển qua vnpay
                $response = app()->call('App\Http\Controllers\Client\Appointment\AppointmentController@vnpay_payment', ['appointment' => $check]);
                return $response;
            }
            event(new AppointmentSuccessEvent($check));
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('appointment.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }

    public function vnpay_payment($appointment)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/appointment/data-vnpay";  // chỉnh trả về
        $vnp_TmnCode = "BAICZJ2I";//Mã website tại VNPAY
        $vnp_HashSecret = "QZBAWUJQHJKCTILVRRNTVMHNTGCNSQPW"; //env('VNPAY_HASH_SECRET');
        $vnp_TxnRef = $appointment->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Pay for appointment via vnpay ';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $appointment->total_price * 100;//$vnp_Amount = $data['total_vnpay'] * 100; // để thanh toán được 20000 thì phải có * 100
        $vnp_Locale = 'vn' ;//$_POST['language']
        $vnp_BankCode = 'NCB' ;//$_POST['bank_code']
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            // if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            // } else {
                // echo json_encode($returnData);
            // }
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momo_payment($appointment)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'; //env('MOMO_SECRET_KEY');
        $orderInfo = $appointment->id;
        $amount = $appointment->total_price;// $amount = $data['total_momo'];
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/appointment/data-momo";
        $ipnUrl = "http://127.0.0.1:8000/appointment/data-momo";
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        // header('Location: ' . $jsonResult['payUrl']);
        return redirect()->to($jsonResult['payUrl']);
    }
    public function saveDataVnpay()
    {
        try{
            DB::beginTransaction();
            $vnp_transactionstatus = $_GET['vnp_TransactionStatus'];
            $appointmentId = $_GET['vnp_TxnRef'];
            if($vnp_transactionstatus == "00"){
                $vnpay = VnpayPayment::create([
                    'vnp_amount' => $_GET['vnp_Amount'],
                    'vnp_bankcode' => $_GET['vnp_BankCode'],
                    'vnp_banktranno' =>$_GET['vnp_BankTranNo'],
                    'vnp_cardtype' => $_GET['vnp_CardType'],
                    'vnp_orderinfo' => $_GET['vnp_OrderInfo'],
                    'vnp_paydate' => $_GET['vnp_PayDate'],
                    'vnp_tmncode' => $_GET['vnp_TmnCode'],
                    'vnp_transactionno' => $_GET['vnp_TransactionNo'],
                    'vnp_transactionstatus' => $_GET['vnp_TransactionStatus'],
                    'users_id' => Auth::id(),
                ]);
                if(!is_null($vnpay)){
                    $check = Appointment::find($appointmentId);
                    $check->status_payment = "Paid";
                    $check->save();
                    event(new AppointmentSuccessEvent($check));
                }
            }else{
                $check = Appointment::find($appointmentId);
                $check->status_payment = "error Paid";
                $check->save();
                event(new AppointmentSuccessEvent($check));
            }
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('appointment.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }
    public function saveDataMomo()
    {
        try{
            DB::beginTransaction();
            $message = $_GET['message'];
            $appointmentId = $_GET['orderInfo'];
            if($message == "Successful."){
                $momo = MomoPayment::create([
                    'partner_code' => $_GET['partnerCode'],
                    'order_id' => $_GET['orderId'],
                    'request_id' => $_GET['requestId'],
                    'amount' =>$_GET['amount'],
                    'order_info' => $_GET['orderInfo'],
                    'order_type' => $_GET['orderType'],
                    'trans_id' => $_GET['transId'],
                    'pay_type' => $_GET['payType'],
                    'response_time' => $_GET['responseTime'],
                    'message' => $_GET['message'],
                    'users_id' => Auth::id(),
                ]);
                if(!is_null($momo)){
                    $check = Appointment::find($appointmentId);
                    $check->status_payment = "Paid";
                    $check->save();
                    event(new AppointmentSuccessEvent($check));
                }
            }else{
                $check = Appointment::find($appointmentId);
                $check->status_payment = "error Paid";
                $check->save();
                event(new AppointmentSuccessEvent($check));
            }
            DB::commit();
            $msg = $check ? 'success' : 'failed';
            return redirect()->route('appointment.index')->with('message', $msg);
        }catch(\Exception $message){
            DB::rollback();
        }
    }
}
