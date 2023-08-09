<?php

use App\Http\Controllers\Admin\AboutUs\AboutUsController;
use App\Http\Controllers\Admin\Appointment\AppointmentController;
use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\Holiday\HolidayController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\ProductCategory\ProductCategoryController;
use App\Http\Controllers\Admin\Service\ServiceController;
use App\Http\Controllers\Admin\Team\DoctorController;
use App\Http\Controllers\Admin\Team\NurseController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Vaccine\VaccineController;
use App\Http\Controllers\Client\About_us\AboutUsController as AboutUsClientController;
use App\Http\Controllers\Client\Appointment\AppointmentController as AppointmentClientController;
use App\Http\Controllers\Client\Blog\BlogController as BlogClientController;
use App\Http\Controllers\Client\Contact\ContactController as ContactClientController;
use App\Http\Controllers\Client\Home\HomeController as HomeClientController;
use App\Http\Controllers\Client\Service\ServiceController as ServiceClientController;
use App\Http\Controllers\Client\Team\DoctorController as DoctorClientController;
use App\Http\Controllers\Client\Team\NurseController as NurseClientController;
use App\Http\Controllers\Client\User\UserController as UserClientController;
use App\Http\Controllers\Client\Vaccine\VaccineController as VaccineClientController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\GoogleController;
use App\Http\Controllers\Client\FacebookController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




//google
Route::get('/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

//facebook
// Route::get('/facebook/redirect', [FacebookController::class, 'redirect'])->name('facebook.redirect');
// Route::get('/facebook/callback', [FacebookController::class, 'callback'])->name('facebook.callback');

//language
Route::get('language/{locale}', [LanguageController::class, 'index'])->name('language.index');

//client
Route::get('/', [HomeClientController::class, 'index'])->name('client.home.list');

//team
Route::get('/doctor', [DoctorClientController::class, 'index'])->name('client.doctor.list');
Route::get('/doctor/detail/{slug}', [DoctorClientController::class, 'show'])->name('client.doctor.show');
Route::get('/nurse', [NurseClientController::class, 'index'])->name('client.nurse.list');
Route::get('/nurse/detail/{slug}', [NurseClientController::class, 'show'])->name('client.nurse.show');

//blog
Route::get('/blog',[BlogClientController::class, 'index'])->name('client.blog.list');
Route::get('/blog/detail/{slug}',[BlogClientController::class, 'show'])->name('client.blog.show');

//service
Route::get('/service',[ServiceClientController::class, 'index'])->name('client.service.list');
Route::get('/service/detail/{slug}',[ServiceClientController::class, 'show'])->name('client.service.show');

//vaccine
Route::get('/vaccine', [VaccineClientController::class, 'index'])->name('client.vaccine.list');
Route::get('/vaccine/detail/{slug}', [VaccineClientController::class, 'show'])->name('client.vaccine.show');

//about-us
Route::get('/about-us',[AboutUsClientController::class, 'index'])->name('about-us');

//contact
Route::get('/contact',[ContactClientController::class, 'index'])->name('contact');
Route::post('/contact/store',[ContactClientController::class, 'store'])->name('client.contact.store');

//simsimi
Route::post('/chatsimsimi', [ContactClientController::class, 'chatSimsimi'])->name('chatSimsimi.send');



//phải login
Route::middleware(['auth'])->group( function(){
    //appointment
    Route::get('/appointment', [AppointmentClientController::class, 'index'])->name('appointment.index');
    Route::post('/appointment/store', [AppointmentClientController::class, 'store'])->name('appointment.store');
    Route::get('/appointment/getProductCategory/{age}', [AppointmentClientController::class, 'getProductCategory'])->name('client.appointment.getProductCategory');
    Route::get('/appointment/getProduct/{id}', [AppointmentClientController::class, 'getProduct'])->name('client.appointment.getProduct');
    Route::get('/appointment/getPrice/{id}', [AppointmentClientController::class, 'getPrice'])->name('client.appointment.getPrice');
    Route::get('/appointment/confirm-email', [AppointmentClientController::class, 'confirmEmail'])->name('client.confirmEmail.send');
    Route::post('/appointment/vnpay_payment', [AppointmentClientController::class, 'vnpay_payment'])->name('client.vnpay_payment.pay');
    Route::get('/appointment/data-vnpay', [AppointmentClientController::class, 'saveDataVnpay']); //->name('client.dataVnpay.save');
    Route::post('/appointment/momo_payment', [AppointmentClientController::class, 'momo_payment'])->name('client.momo_payment.pay');
    Route::get('/appointment/data-momo', [AppointmentClientController::class, 'saveDataMomo']); //->name('client.dataMomo.save');

    //account
    Route::resource('/account', UserClientController::class);
    Route::post('/account/changeStatusComplete/{account}',[UserClientController::class,'changeStatusComplete'])->name('client.account.changeStatusComplete');
    Route::post('/account/changeStatusCancel/{account}',[UserClientController::class,'changeStatusCancel'])->name('client.account.changeStatusCancel');
    Route::get('/confirm-cancel-email', [UserClientController::class, 'confirmCancelEmail'])->name('client.cancelEmail.send');
    Route::get('/confirm-thank-email', [UserClientController::class, 'confirmThankEmail'])->name('client.thankEmail.send');
    Route::post('/account/evaluation',[UserClientController::class,'evaluate'])->name('client.account.evaluate');
    Route::get('/account/history/{id}',[UserClientController::class,'history'])->name('client.account.history');

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//phải admin
Route::middleware(['auth.admin'])->name('admin.')->group(function () {
    //vaccine
    Route::resource('admin/vaccine', VaccineController::class);
    Route::post('admin/vaccine/slug',[VaccineController::class, 'getSlug'])->name('vaccine.slug');
    Route::post('admin/vaccine/restore/{vaccine}', [VaccineController::class, 'restore'])->name('vaccine.restore');
    Route::post('/admin/product-upload-image',[VaccineController::class, 'uploadImage'])->name('product.image.upload');

    //doctor
    Route::resource('admin/doctor', DoctorController::class);
    Route::post('admin/doctor/restore/{doctor}', [DoctorController::class, 'restore'])->name('doctor.restore');
    Route::post('admin/doctor/slug',[DoctorController::class, 'getSlug'])->name('doctor.slug');
    Route::post('/admin/doctor-upload-image',[DoctorController::class, 'uploadImage'])->name('doctor.image.upload');

    //nurse
    Route::resource('admin/nurse', NurseController::class);
    Route::post('admin/nurse/restore/{nurse}', [NurseController::class, 'restore'])->name('nurse.restore');
    Route::post('admin/nurse/slug',[NurseController::class, 'getSlug'])->name('nurse.slug');
    Route::post('/admin/nurse-upload-image',[NurseController::class, 'uploadImage'])->name('nurse.image.upload');

    //service
    Route::resource('admin/service', ServiceController::class);
    Route::post('admin/service/slug',[ServiceController::class, 'getSlug'])->name('service.slug');
    Route::post('/admin/service-upload-image',[ServiceController::class, 'uploadImage'])->name('service.image.upload');

    //product category
    Route::resource('admin/product-category', ProductCategoryController::class);
    Route::post('admin/product-category/slug',[ProductCategoryController::class, 'getSlug'])->name('product-category.slug');
    Route::post('admin/product-category/restore/{product_category}', [ProductCategoryController::class, 'restore'])->name('product-category.restore');

    //holiday
    Route::resource('admin/holiday', HolidayController::class);

    //contact
    Route::resource('admin/contact', ContactController::class);
    Route::post('admin/contact/changeStatus/{contact}', [ContactController::class, 'changeStatus'])->name('contact.changeStatus');
    Route::get('admin/called-contact/list',[ContactController::class, 'completeList'])->name('called_contact.index');


    //blog
    Route::resource('admin/blog', BlogController::class);
    Route::post('admin/blog/slug',[BlogController::class, 'getSlug'])->name('blog.slug');
    Route::post('/admin/blog-upload-image',[BlogController::class, 'uploadImage'])->name('blog.image.upload');

    //user
    Route::resource('admin/user', UserController::class);

    //admin
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    //about-us
    Route::get('/admin/about-us', [AboutUsController::class, 'index'])->name('aboutus.index');
    Route::post('/admin/about-us/store', [AboutUsController::class, 'store'])->name('aboutus.store');
    Route::get('/admin/about-us/create', [AboutUsController::class, 'create'])->name('aboutus.create');
    Route::post('/admin/aboutus-upload-image',[AboutUsController::class, 'uploadImage'])->name('aboutus.image.upload');
    Route::post('/chatgpt', [AboutUsController::class, 'chatGpt'])->name('chatgpt.send');

    //appointment
    Route::resource('admin/appointment', AppointmentController::class);
    Route::post('admin/appointment/changeStatusComplete/{appointment}', [AppointmentController::class, 'changeStatusComplete'])->name('appointment.changeStatusComplete');
    Route::post('admin/appointment/changeStatusCancel/{appointment}', [AppointmentController::class, 'changeStatusCancel'])->name('appointment.changeStatusCancel');
    Route::get('admin/used-appointment',[AppointmentController::class, 'completeList'])->name('used_appointment.index');
    Route::get('admin/canceled-appointment',[AppointmentController::class, 'cancelList'])->name('canceled_appointment.index');
    Route::get('admin/confirm-cancel-email', [AppointmentController::class, 'confirmCancelEmail'])->name('cancelEmail.send');
    Route::get('admin/confirm-thank-email', [AppointmentController::class, 'confirmThankEmail'])->name('thankEmail.send');

});




require __DIR__.'/auth.php';




