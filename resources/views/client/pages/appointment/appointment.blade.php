@extends('client.layout.master')

@section('seo')
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="description" content="{{ $meta_desc }}">
    <link rel="canonical" href="{{ $url_canonical }}">
    <!-- Share FB -->
    {{-- <meta property="og:site_name" content="http://127.0.0.1:8000/appointment"> --}}
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:title" content="MaiVaccine">
    <meta property="og:url" content="{{ $url_canonical }}">
    <meta property="og:type" content="website">
    {{-- <meta property="og:image" content="link image" /> --}}
@endsection

@section('titleIntroAndButtonBanner')
    <h5>We are here for your care</h5>
    <h1>Appointment</h1>
    <p>Making an appointment for a vaccine is an important step in protecting oneself and one's community from preventable diseases. Appointments can typically be made with healthcare providers or through public health agencies. Making an appointment allows individuals to receive accurate information about the vaccine, ask any questions or address concerns, and receive the vaccine in a safe and controlled environment. Appointments also help ensure that there is enough supply of the vaccine available for those who need it and minimize wait times. By making an appointment for a vaccine, individuals can take an important step towards promoting their own health and the health of their community.</p>
    <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="" data-size=""><a target="_blank"
            href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}"
            class="fb-xfbml-parse-ignore btn_2"><i class="share icon"></i>Share FB</a></div>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/appointment_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <!--Form appointment-->
    <section class="doctor_part">
        <div>
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2 id="appointmentform"> Form Appointment</h2>
                    </div>
                </div>
            </div>

            <!-- Form appointment-->
            <div class="container" style="margin-bottom: 10%">
                <div class="ui segment">
                    <form action="{{ route('appointment.store') }}" role="form" method="POST">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label><i class="user icon"></i>Name:</label>
                            <input type="text" class="form-control form-select required" id="name"
                                placeholder="Enter name" name="name">
                        </div>
                        @error('name')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label><i class="envelope icon"></i>Email:</label>
                            <input type="text" class="form-control form-select required" id="email"
                                placeholder="Enter email" name="email">
                        </div>
                        @error('email')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label><i class="phone icon"></i>Phone:</label>
                            <input type="tel" class="form-control form-select required" id="phone" name="phone"
                                placeholder="Enter phone number">
                        </div>
                        @error('phone')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label><i class="thumbtack  icon"></i>Age:</label>
                            <input type="number" class="form-control form-select required" id="age" name="age"
                                placeholder="Enter Age">
                        </div>
                        @error('age')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label><i class="user md icon"></i>Doctor:</label>
                            <select name="doctor_id" class="form-control form-select required">
                                <option value="">--Select option--</option>
                                @foreach ($doctorList as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('doctor_id')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label><i class="user md icon"></i>Nurse:</label>
                            <select name="nurse_id" class="form-control form-select required">
                                <option value="">--Select option--</option>
                                @foreach ($nurseList as $nurse)
                                    <option value="{{ $nurse->id }}">{{ $nurse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('nurse_id')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label><i class="folder open icon"></i>Product Category:</label>
                            <select name="product_category_id" id="productCategoryList"
                                class="form-control form-select required">

                            </select>
                        </div>
                        @error('product_category_id')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label><i class="syringe icon"></i>Vaccine:</label>
                            <select name="product_id" id="productList" class="form-control form-select required">

                            </select>
                        </div>
                        @error('product_id')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label><i class="money bill alternate icon"></i>Price:</label>
                            <div id="price">
                                <!--name="total_price"-->

                            </div>
                        </div>
                        @error('total_price')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label><i class="calendar alternate outline icon"></i> Date: </label>
                            <input type="text" id="datepicker" name="date_appointment">
                            <label><i class="clock outline icon"></i>Time: </label>
                            <input type="time" id="time_appointment" name="time_appointment" min="08:00" max="18:00">
                            {{-- <input type="time" id="time_appointment" name="time_appointment"> --}}
                        </div>
                        @error('date_appointment')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        @error('time_appointment')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label><i class="credit card outline icon"></i>Pay by:</label>
                            <select name="pay_by" class="form-control form-select required" id="pay_by_select">
                                <option value="0">Cash in hand</option>
                                <option value="1">Momo</option>
                                <option value="2">Vnpay</option>
                            </select>
                        </div>
                        @error('pay_by')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <input type="hidden" name="users_id" value="{{ $users_id = auth()->id() }}"> <!-- user id -->
                        <input type="hidden" name="status" value="1"> <!-- 1: chưa sử dụng -->
                        <button style="margin-top: 2%" type="submit" class="btn btn-primary" id="payment_button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


{{-- <form action="{{ route('client.vnpay_payment.pay') }}" method="POST">
        @csrf
        <input type="hidden" name="total_price" value="900000">
        <button class="btn btn-primary" type="submit" name="redirect">VNPAY</button>
    </form> --}}
    {{-- <form action="{{ route('client.momo_payment.pay') }}" method="POST">
        @csrf
        <input type="hidden" id="total_momo" name="total_price"  value="900000" >
        <button class="btn btn-primary" type="submit" name="payUrl">MOMO</button>
    </form> --}}
@endsection

@section('script-pop-up')
    <div class="content">
        @if (session('message') == "success")
            <script>
                Swal.fire(
                    'Success!',
                    'You have successfully scheduled an appointment, thank you!',
                    'success'
                );
            </script>
        @endif
        @if(session('message') == "failed")
            <script>
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
                });
            </script>
        @endif
    </div>
@endsection

@section('js-custom')
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#pay_by_select').on('click', function(event) {
                var selectedValue = $(this).val();
                var paymentButton = document.getElementById('payment_button');

                if (selectedValue == 1) {
                    paymentButton.name = 'payUrl';
                } else if (selectedValue == 2) {
                    paymentButton.name = 'redirect';
                }else{
                    delete paymentButton.name;
                }
            });
        });
    </script> --}}
    {{-- age -> productCategoryList --}}
    <script>
        $(document).ready(function() {
            $('#age').on('change', function() {
                let age = $(this).val();
                $('#productCategoryList').empty();
                $('#productCategoryList').append(
                    `<option value="0" disabled selected>Processing...</option>`);

                $.ajax({
                    type: 'GET',
                    url: 'appointment/getProductCategory/' + age,
                    success: function(response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#productCategoryList').empty();
                        $('#productCategoryList').append(
                            `<option value="0" disabled selected>--Select Product Category--</option>`
                        );
                        response.forEach(element => {
                            $('#productCategoryList').append(
                                `<option value="${element['id']}"> ${element['name']} </option>`
                            );
                        });
                    }
                })
            })
        })
    </script>
    {{-- productCategoryList -> productList --}}
    <script>
        $(document).ready(function() {
            $('#productCategoryList').on('change', function() {
                let id = $(this).val();
                $('#productList').empty();
                $('#productList').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: 'appointment/getProduct/' + id,
                    success: function(response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#productList').empty();
                        $('#productList').append(
                            `<option value="0" disabled selected>--Select Product--</option>`
                        );
                        response.forEach(element => {
                            $('#productList').append(
                                `<option value="${element['id']}"> ${element['name_product']} </option>`
                            );
                        });
                    }
                })
            })
        })
    </script>
    {{-- productList->total_price --}}
    <script>
        $(document).ready(function() {
            $('#productList').on('change', function() {
                let id = $(this).val();
                $('#price').empty();
                $('#price').append(`<input type="number" class="form-control" name="price" value="">`);
                $.ajax({
                    type: 'GET',
                    url: 'appointment/getPrice/' + id,
                    success: function(response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#price').empty();
                        response.forEach(element => {
                            $('#price').append(
                                `<input type="number" class="form-control form-select required" id="total_price" name="total_price" value="${element['price']}" readonly style="background-color:#fdfac7">`
                            );
                        });
                    }
                })
            })
        })
    </script>
    {{-- now -> future // day --}}
    <script>
        var today = new Date();
        var holidays = [];
        holidays = <?= json_encode($holidayList) ?>;
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: today,
                maxDate: "+3y", // 3 năm
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    var dateString = $.datepicker.formatDate("yy-mm-dd", date);
                    if (day == 0 || ($.inArray(dateString, holidays) != -1)) { //0: Chủ nhật
                        return [false, "", "Weekend"];
                    } else {
                        return [true, "", ""];
                    }
                }
            });
        });
    </script>
@endsection
