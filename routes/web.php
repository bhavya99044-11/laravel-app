<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CoupanDiscountController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\AuthUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\CsvController;
use App\Http\Middleware\ContentMiddleware;
use App\Http\Middleware\LocalizationMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


Route::middleware(LocalizationMiddleware::class)->group(function(){
Route::get('/',[UserDashboardController::class,'Dashboard'])->name('dashboard');
Route::post('/live-search',[UserDashboardController::class,'LiveSearch'])->name('LiveSearch');
Route::get('/product/{id}',[ProductController::class,'Product'])->name('Product');
Route::get('/admin',[AdminController::class,'AdminDashboard'])->name('AdminDashboard');
Route::post('/add-product',[AdminController::class,'AddProduct'])->name('AddProduct');
Route::post('/new-product',[AdminController::class,'NewProduct'])->name('NewProduct');
Route::post('/table-data',[AdminController::class,'tableData'])->name('tableData');
Route::post('/update-data',[AdminController::class,'updateData'])->name('updateData');
Route::post('/delete-data',[AdminController::class,'deleteData'])->name('deleteData');
Route::post('color-size',[AdminController::class,'colorSize'])->name('colorSize');
Route::post('inlineUpdate',[AdminController::class,'inlineUpdate'])->name('inlineUpdate');
Route::post('/product/comment',[ProductController::class,'productComment'])->name('productComment');
Route::post('/product/comment/reply',[ProductController::class,'productCommentReply'])->name('productCommentReply');
Route::post('/product/comment/upvote',[ProductController::class,'commentUpvote'])->name('commentUpvote');
Route::post('/product/comment/downvote',[ProductController::class,'commentDownvote'])->name('commentDownvote');
Route::get('/language/{language}',[LocalizationController::class,'languageChange'])->name('localChange');
});

Route::get('/localization',[LocalizationController::class,'addFileData']);
Route::post('/add-localization',[LocalizationController::class,'addLocalization'])->name('addLocalization');
Route::post('/language/yajraTable',[LocalizationController::class,'languageYajraTable'])->name('languageYajraTable');
Route::post('/service/post',[ServiceController::class,'Save'])->name('ServiceSave');
Route::get('/service',function(){
return view('ServiceView');
});
Route::get('/service/{id}',[ServiceController::class,'find'])->name('serviceFind');
Route::get('/authentication/view',function(){
return view('ServiceView');
})->name('users.view');
Route::get('/authentication/password-reset',function(){
    return view('password-reset');
    })->name('users.passwordReset');
Route::get('/authentication/two-factor',function(){
    return view('two-factor');
})->name('users.twoFactor');
Route::post('/authentication/login',[AuthenticationController::class,'login'])->name('user.login');
Route::post('/authentication/twoFactor',[AuthenticationController::class,'twoFactor'])->name('twoFactor');
Route::resource('permissions', PermissionController::class);
Route::get('roles/{id}/add-permissions', [RoleController::class,'addPermission']);
Route::get('roles/{id}/submit-permission', [RoleController::class,'submitPermission']);
Route::resource('roles',RoleController::class);

Route::get('/home',function(){
dd(Auth::user());
});


// new routes
// Route::middleware([AuthUser::class])->group(function(){
Route::get('/home',[UserDashboardController::class,'dashboard']);
Route::get('/categories/{id}',[CategoryController::class,'categories']);
Route::get('/product/{id}',[ProductController::class,'productData'])->name('productData');
Route::post('/new-comment',[ProductController::class,'newComment'])->name('newComment');
Route::post('/comment/reply',[ProductController::class,'commentReply'])->name('commentReply');


// });
Route::get('/login',function(){
    return view('frontend.login');
})->name('login');
Route::post('/login/user',[UserDashboardController::class,'loginUser'])->name('loginUser');
Route::get('/login/otp',function(){
    return view('frontend.otp-form');
})->name('otpForm');
Route::post('/login/otp-verify',[UserDashboardController::class,'otpVerify'])->name('otpVerify');
Route::post('/user/cart-data',[CartController::class,'addUserCart'])->name('addUserCart');
Route::get('/logout',function(){
    Auth::logout();
    Session::flush();
    Cookie::forget('content_password');
});
// end new routes

//delete routes
Route::get('/add-cart',[CartController::class,'cartView'])->name('addCart');
Route::post('/cart/update',[CartController::class,'cartUpdate'])->name('cartUpdate');
Route::post('/cart/coupon/apply',[CartController::class,'couponApply'])->name('couponApply');
Route::get('/checkout/view',[CartController::class,'checkoutCart'])->name('checkoutCart');
Route::get('/cart/delete/{id}',[CartController::class,'deleteCart'])->name('deleteCart');
Route::get('/invoice',[CartController::class,'invoice'])->name('invoice');
Route::get('/invoice/download/{orderId}',[CartController::class,'invoiceDownload'])->name('invoiceDownload');
Route::get('/order/place',[OrderController::class,'placeOrder'])->name('placeOrder')->middleware([AuthUser::class]);
Route::get('/order/view',[OrderController::class,'viewOrder'])->name('viewOrder');
Route::get('/product/{id}/{colorId}/{sizeId}',[CartController::class,'quantityCheck'])->name('quantity.check');
//end delte route
Route::resource('coupon', CoupanDiscountController::class);
Route::post('/cart/pay-now',[CartController::class,'payNow'])->name('payNow');
Route::get('/admin/panel',[UserDashboardController::class,'adminPanel'])->name('adminPanel');
Route::get('/admin/panel/practice',
function(){
    return view('admin.panel');
});

Route::get('/order/mail',[CartController::class,'orderMail'])->name('orderMail');
Route::controller(AdminController::class)->group(function(){
Route::get('/admin/panel','adminPanel')->name('admin.panel');
Route::post('/status/update','statusUpdate')->name('statusUpdate');
});

Route::group(['middleware'=>['auth']],function(){
    Route::resource('roles',RoleController::class);
});

//chat routes
Route::group(['middleware'=>[AuthUser::class]],function(){
Route::get('/chats',[ChatController::class,'chatView'])->name('chats');
Route::get('/chats/{id}',[ChatController::class,'chatUser'])->name('chat.user');
Route::post('/chat/send',[ChatController::class,'send'])->name('chat.send');
Route::get('/chat/messages/{userId}',[ChatController::class,'messages'])->name('chat.messages');
Route::get('/chat/status/{userId}',[ChatController::class,'status'])->name('chat.status');
});

Route::get('/content/password',[ChatController::class,'index'])->name('content.password');

Route::get('/content',[ChatController::class,'content'])->name('content.index');
Route::post('/password/verify',[ChatController::class,'passwordVerify'])->name('content.verify');
Route::post('/password/session',[ChatController::class,'passwordVerify'])->name('content.verify');
Route::get('/status/update/{id}',[ChatController::class,'statusUpdate'])->name('status.update');

