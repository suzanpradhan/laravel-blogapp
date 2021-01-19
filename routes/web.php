<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//static routes
Route::get("/about", [PagesController::class, "about"]);
Route::get("/", [PagesController::class, "index"]);

// dynamic routes
// Route::get("/users/{id}", function($id){
//     return "User id is".$id;
// });

//resources
Route::resource("posts", PostsController::class);

//Auth Routes
Auth::routes();

// Main User Dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

/*
    Route middleware may be used to only allow verified users to access a given route. Laravel ships with a verified middleware, which references the Illuminate\Auth\Middleware\EnsureEmailIsVerified class. Since this middleware is already registered in your application's HTTP kernel, all you need to do is attach the middleware to a route definition:

    ->middleware(['auth', 'verified']);
*/


// Email Verification Route
Route::get('/email/verify',function(){
    return view("auth.verify");
} )->middleware("auth")->name("verification.notice");

//Email User Verify Route
Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request){
    $request.fullfill();
    return redirect("/welcome");
} )->middleware(['auth', 'signed'])->name('verificaiton.verify');

//Resend Email Verification Link Route
Route::get('email/verification-resend', function(Request $request){
    $request -> user() ->sendEmailVerificationNotification();
    return back()->with("success", "Verification Link Sent!");
    // throttle 6 requests per minute
})->middleware(['auth', 'throttle:6,1'])->name("verification.send");

Auth::routes(['verify' => true]);