<?php

use App\Http\Controllers\Admin\AdminAgentController;
use App\Http\Controllers\Admin\AdminAmenityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminPropertyController;
use App\Http\Controllers\Admin\AdminTypeController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// front

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/select-user', [FrontController::class, 'select_user'])->name('select_user');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('pricing');
Route::get('/property/{slug}', [FrontController::class, 'property_detail'])->name('property_detail');

// Agent Section
Route::middleware('agent')->prefix('agent')->group(function () {
    Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('agent_dashboard');
    Route::get('/profile', [AgentController::class, 'profile'])->name('agent_profile');
    Route::post('/profile', [AgentController::class, 'profile_submit'])->name('agent_profile_submit');
    Route::get('/payment', [AgentController::class, 'payment'])->name('agent_payment');
    Route::get('/order', [AgentController::class, 'order'])->name('agent_order');
    Route::get('/invoice/{order_id}', [AgentController::class, 'invoice'])->name('agent_invoice');
    

    Route::get('/property/index', [AgentController::class, 'property_all'])->name('agent_property_index');
    Route::get('/property/create', [AgentController::class, 'property_create'])->name('agent_property_create');
    Route::post('/property/store', [AgentController::class, 'property_store'])->name('agent_property_store');
    Route::get('/property/edit/{id}', [AgentController::class, 'property_edit'])->name('agent_property_edit');
    Route::post('/property/update/{id}', [AgentController::class, 'property_update'])->name('agent_property_update');
    Route::get('/property/delete/{id}', [AgentController::class, 'property_delete'])->name('agent_property_delete');
    
    Route::get('/property/photo-gallery/{property_id}', [AgentController::class, 'property_photo_gallery'])->name('agent_property_photo_gallery');
    Route::post('/property/photo-gallery/{property_id}', [AgentController::class, 'property_photo_gallery_store'])->name('agent_property_photo_gallery_store');
    Route::get('/property/photo-gallery-delete/{property_photo_id}', [AgentController::class, 'property_photo_gallery_delete'])->name('agent_property_photo_gallery_delete');
    Route::get('/property/photo-gallery-delete/{property_photo_id}', [AgentController::class, 'property_photo_gallery_delete'])->name('agent_property_photo_gallery_delete');

    Route::get('/property/video-gallery/{property_id}', [AgentController::class, 'property_video_gallery'])->name('agent_property_video_gallery');
    Route::post('/property/video-gallery/{property_id}', [AgentController::class, 'property_video_gallery_store'])->name('agent_property_video_gallery_store');
    Route::get('/property/video-gallery-delete/{property_video_id}', [AgentController::class, 'property_video_gallery_delete'])->name('agent_property_video_gallery_delete');


});

Route::prefix('agent')->group(function () {
    Route::get('/', function () {return redirect()->route('agent_login');});
    Route::get('/registration', [AgentController::class, 'registration'])->name('agent_registration');
    Route::post('/registration', [AgentController::class, 'registration_submit'])->name('agent_registration_submit');
    Route::get('/registration-verify/{token}/{email}', [AgentController::class, 'registration_verify'])->name('agent_registration_verify');
    Route::get('/login', [AgentController::class, 'login'])->name('agent_login');
    Route::post('/login', [AgentController::class, 'login_submit'])->name('agent_login_submit');
    Route::get('/forget-password', [AgentController::class, 'forget_password'])->name('agent_forget_password');
    Route::post('/forget-password', [AgentController::class, 'forget_password_submit'])->name('agent_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AgentController::class, 'reset_password'])->name('agent_reset_password');
    Route::post('/reset-password/{token}/{email}', [AgentController::class, 'reset_password_submit'])->name('agent_reset_password_submit');
    Route::get('/logout', [AgentController::class, 'logout'])->name('agent_logout');
});

// user

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profile_submit'])->name('profile_submit');
});

Route::get('/registration', [UserController::class, 'registration'])->name('registration');
Route::post('/registration', [UserController::class, 'registration_submit'])->name('registration_submit');
Route::get('/registration-verify/{token}/{email}', [UserController::class, 'registration_verify'])->name('registration_verify');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login_submit'])->name('login_submit');
Route::get('/forget-password', [UserController::class, 'forget_password'])->name('forget_password');
Route::post('/forget-password', [UserController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset-password/{token}/{email}', [UserController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}/{email}', [UserController::class, 'reset_password_submit'])->name('reset_password_submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// admin

Route::middleware('admin')->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [AdminController::class, 'profile_submit'])->name('admin_profile_submit');

    Route::get('/package/index', [AdminPackageController::class, 'index'])->name('admin_package_index');
    Route::get('/package/create', [AdminPackageController::class, 'create'])->name('admin_package_create');
    Route::post('/package/store', [AdminPackageController::class, 'store'])->name('admin_package_store');
    Route::get('/package/edit/{id}', [AdminPackageController::class, 'edit'])->name('admin_package_edit');
    Route::post('/package/update/{id}', [AdminPackageController::class, 'update'])->name('admin_package_update');
    Route::get('/package/delete/{id}', [AdminPackageController::class, 'delete'])->name('admin_package_delete');

    Route::get('/location/index', [AdminLocationController::class, 'index'])->name('admin_location_index');
    Route::get('/location/create', [AdminLocationController::class, 'create'])->name('admin_location_create');
    Route::post('/location/store', [AdminLocationController::class, 'store'])->name('admin_location_store');
    Route::get('/location/edit/{id}', [AdminLocationController::class, 'edit'])->name('admin_location_edit');
    Route::post('/location/update/{id}', [AdminLocationController::class, 'update'])->name('admin_location_update');
    Route::get('/location/delete/{id}', [AdminLocationController::class, 'delete'])->name('admin_location_delete');

    Route::get('/type/index', [AdminTypeController::class, 'index'])->name('admin_type_index');
    Route::get('/type/create', [AdminTypeController::class, 'create'])->name('admin_type_create');
    Route::post('/type/store', [AdminTypeController::class, 'store'])->name('admin_type_store');
    Route::get('/type/edit/{id}', [AdminTypeController::class, 'edit'])->name('admin_type_edit');
    Route::post('/type/update/{id}', [AdminTypeController::class, 'update'])->name('admin_type_update');
    Route::get('/type/delete/{id}', [AdminTypeController::class, 'delete'])->name('admin_type_delete');

    Route::get('/amenity/index', [AdminAmenityController::class, 'index'])->name('admin_amenity_index');
    Route::get('/amenity/create', [AdminAmenityController::class, 'create'])->name('admin_amenity_create');
    Route::post('/amenity/store', [AdminAmenityController::class, 'store'])->name('admin_amenity_store');
    Route::get('/amenity/edit/{id}', [AdminAmenityController::class, 'edit'])->name('admin_amenity_edit');
    Route::post('/amenity/update/{id}', [AdminAmenityController::class, 'update'])->name('admin_amenity_update');
    Route::get('/amenity/delete/{id}', [AdminAmenityController::class, 'delete'])->name('admin_amenity_delete');

    Route::get('/customer/index', [AdminCustomerController::class, 'index'])->name('admin_customer_index');
    Route::get('/customer/create', [AdminCustomerController::class, 'create'])->name('admin_customer_create');
    Route::post('/customer/store', [AdminCustomerController::class, 'store'])->name('admin_customer_store');
    Route::get('/customer/edit/{id}', [AdminCustomerController::class, 'edit'])->name('admin_customer_edit');
    Route::post('/customer/update/{id}', [AdminCustomerController::class, 'update'])->name('admin_customer_update');
    Route::get('/customer/delete/{id}', [AdminCustomerController::class, 'delete'])->name('admin_customer_delete');

     Route::get('/agent/index', [AdminAgentController::class, 'index'])->name('admin_agent_index');
    Route::get('/agent/create', [AdminAgentController::class, 'create'])->name('admin_agent_create');
    Route::post('/agent/store', [AdminAgentController::class, 'store'])->name('admin_agent_store');
    Route::get('/agent/edit/{id}', [AdminAgentController::class, 'edit'])->name('admin_agent_edit');
    Route::post('/agent/update/{id}', [AdminAgentController::class, 'update'])->name('admin_agent_update');
    Route::get('/agent/delete/{id}', [AdminAgentController::class, 'delete'])->name('admin_agent_delete');
    Route::get('/order/index', [AdminOrderController::class, 'index'])->name('admin_order_index');

   // Route::get('/property/index', [AdminController::class, 'index'])->name('admin_property_index');

     Route::get('/property/index', [AdminPropertyController::class, 'index'])->name('admin_property_index');
     Route::get('/property/detail/{id}', [AdminPropertyController::class, 'detail'])->name('admin_property_detail');
  
    });

Route::prefix('admin')->group(function () {

    Route::get('/', function () {return redirect()->route('admin_login');});
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');

});
