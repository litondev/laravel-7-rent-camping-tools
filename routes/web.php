<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// USER ROUTE
Route::group(['namespace' => 'User','middleware' => 'isGlobal'],function(){    
    // HOME CONTROLLER
    Route::get("/","HomeController@index");
    Route::get('/info',"HomeController@info");
    Route::get("/info/{slug}","HomeController@infoDetail");
    Route::get("/product","HomeController@product");
    Route::get("/product/{id}","HomeController@productDetail");

    Route::group(["middleware" => "isNotLogin"],function(){
        Route::get('/signin',"AuthController@signin");
        Route::get('/signup',"AuthController@signup");
        Route::get('/forget-password',"AuthController@forgetPassword");
        Route::get('/reset-password',"AuthController@resetPassword");

        Route::post("/action-signin","ActionAuthController@signin");
        Route::post("/action-signup","ActionAuthController@signup");
        Route::post("/action-forget-password","ActionAuthController@forgetPassword");
        Route::post("/action-reset-password","ActionAuthController@resetPassword");
    });

    Route::group(["middleware" => "isLogin"],function(){
        // CART CONTROLLER
        Route::get("/cart","CartController@index");
        Route::get("/action/sub-cart/{id}","CartController@subCart");
        Route::get("/action/add-cart/{id}","CartController@addCart");
        Route::get("/action/subs-cart","CartController@subsCart");

        // CHECKOUT CONTROLLER
        Route::post("/checkout","CheckoutController@checkout");

        // AUTH CONTROLLER
        Route::get("/logout","AuthController@logout");

        // HOME CONTROLLER
        Route::get("/akun","HomeController@akun");

        // PROFIL CONTROLLER
        Route::get("/profil","ProfilController@index");
        Route::post("/action/update-data","ProfilController@updateData");
        Route::post("/action/update-password","ProfilController@updatePassword");

        // WISHLIST CONTROLLER
        Route::get("/wishlist","WishlistController@index");
        Route::get("/action/sub-wishlist/{id}","WishlistController@subWishlist");
        Route::get("/action/add-wishlist/{id}","WishlistController@addWishlist");

        // NOTIF CONTROLLER
        Route::get("/notif","NotifController@index");

        // INVOICE CONTROLLER
        Route::get("/invoice","InvoiceController@index");
        Route::get("/action/cancel-order/{id}","InvoiceController@cancelOrder");
        Route::get("/history-invoice","InvoiceController@historyInvoice");

        // INVOICE DOWNLOAD CONTROLLER
        Route::get("/action/download-pdf-invoice/{id}","InvoiceController@downloadPdfInvoice");

        // MANUAL PAYMENT CONTROLLER
        Route::get("/history-manual-payment","ManualPaymentController@index");
        Route::post("/action/manual-payment","ManualPaymentController@manualPayment");
        Route::get("/manual-payment","ManualPaymentController@formManualPayment");
        
        // REVIEW PRODUCT CONTROLLER
        Route::post("/action/review-product","ReviewController@reviewProduct");
    });
});

// ADMIN ROUTE
Route::group(["namespace" => "Admin","middleware" => "isAdmin","prefix" => "admins"],function(){
    // HOME CONTROLLER
    Route::get("/","HomeController@index");

    // INFO CONTROLLER
    Route::get("/info","InfoController@index");
    Route::get("/info/{id}","InfoController@deleteInfo");
    Route::post("/info/{id}","InfoController@editInfo");
    Route::post("/info","InfoController@addInfo");

    // SLIDER CONTROLLER
    Route::get("/slider","SliderController@index");
    Route::get("/slider/{id}","SliderController@deleteSlider");
    Route::get("/slider/{id}/{status}","SliderController@changeStatus");
    Route::post("/slider","SliderController@addSlider");

    // CATEGORY CONTROLLER
    Route::get("/category","CategoryController@index");
    Route::get("/category/{id}/{status}","CategoryController@changeStatus");
    Route::post("/category/{id}","CategoryController@editCategory");
    Route::post("/category","CategoryController@addCategory");

    // LOG ADMIN CONTROLLER
    Route::get("/log-admin","LogAdminController@index");

    // NOTIF CONTROLLER
    Route::get("/notif-admin","NotifAdminController@index");

    // SETTING CONTROLLER
    Route::group(["namespace" => "Setting","prefix" => "setting"],function(){
        Route::get("/invoice","InvoiceController@index");
        Route::post("/invoice","InvoiceController@editInvoice");

        Route::get("/order","OrderController@index");
        Route::post("/order","OrderController@editOrder");

        Route::get("/website","WebsiteController@index");
        Route::post("/website","WebsiteController@editWebsite");
    });

    // USER CONTROLLER
    Route::group(["prefix" => "user"],function(){
        Route::get("/","UserController@index");

        // BLOKIR & UNBLOKIR USER
        Route::get("/blokir","UserController@userBlokir");
        Route::post("/blokir","UserController@blokir");        
        Route::get("/unblokir/{id}","UserController@unblokir");

        // EDIT USER
        Route::get('/{id}','UserController@editUser');        
        Route::post("/{id}","UserController@edit");
    });

    // PRODUCT CONTROLLER
    Route::group(["prefix" => "product"],function(){
        Route::get("/","ProductController@index");

        Route::get("/nonaktif","ProductController@productNonaktif");

        Route::get("/{id}/{status}","ProductController@changeStatus");

        Route::get("/add","ProductController@addProduct");
        Route::post('/add','ProductController@add');

        Route::get("/{id}","ProductController@editProduct");
        Route::post("/{id}","ProductController@edit");    
    });

    // REVIEW PRODUCT CONTROLLER
    Route::group(["prefix" => "review"],function(){
        Route::get("/","ReviewController@index");    
        Route::get("/negatif","ReviewController@reviewNegatif");
        Route::get("/positif","ReviewController@reviewPositif");
        Route::post("/replay","ReviewController@replayReview");
        Route::get("/{id}","ReviewController@deleteReview");
    });

    // MANUAL PAYMENT CONTROLLER
    Route::group(["prefix" => "manual-payment"],function(){
        Route::get("/","ManualPaymentController@index");
        Route::get("/validasi","ManualPaymentController@validasiManualPayment");
        Route::get("/detail/{id}","ManualPaymentController@detailManualPayment");
        Route::get("/success/{id}","ManualPaymentController@successManualPayment");
        Route::post("/failed/{id}","ManualPaymentController@failedManualPayment");
        Route::get("/paid/{id}","ManualPaymentController@paidInvoice");
    });

    // INVOICE CONTROLLER
    Route::group(["prefix" => "invoice"],function(){
        Route::get("/","InvoiceController@index");
        Route::get("/pending","InvoiceController@pending");
        Route::get("/rejected","InvoiceController@rejected");
        Route::get("/completed","InvoiceController@completed");
        Route::get("/canceled","InvoiceController@canceled");        
        Route::get("/expired-invoice","InvoiceController@expiredInvoice");
        Route::get("/expired-payment","InvoiceController@expiredPayment");
        Route::get("/payment","InvoiceController@payment");
        Route::get("/prepare","InvoiceController@prepare");
        Route::get("/in-rent","InvoiceController@inRent");
        Route::get("/backing-stuff","InvoiceController@backingStuff");
        Route::get("/withdrawing-stuff","InvoiceController@withdrawingStuff");

        Route::post("/fine","InvoiceActionController@addFine");
        Route::post("/fine/{id}","InvoiceActionController@editFine");
        
        Route::get("/detail/{id}","InvoiceController@detail");        

        Route::get("/action/payment/{id}","InvoiceActionController@actionPayment");
        Route::get("/action/rejected/{id}","InvoiceActionController@actionRejected");
        Route::get("/action/withdrawing-stuff/{id}","InvoiceActionController@actionWithdrawingStuff");
        Route::get("/action/in-rent/{id}","InvoiceActionController@actionInRent");
        Route::get("/action/backing-stuff/{id}","InvoiceActionController@actionBackingStuff");
        Route::get("/action/completed/{id}","InvoiceActionController@actionCompleted");
    });

    // CRONJOB MANUAL
    Route::group(["prefix" => "cronjob"],function(){
        Route::get("/","CronjobController@index");
        Route::get("/action/backing-stuff","CronjobController@actionBackingStuff");
        Route::get("/action/expired-invoice","CronjobController@actionExpiredInvoice");
        Route::get("/action/expired-payment","CronjobController@actionExpiredPayment");
    });
}); 