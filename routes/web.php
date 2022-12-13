<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PaymentController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Frontend Routes

Route::name('home')->get('/', [PostController::class, 'index']);

// Route::get('resources/blogs', [PostController::class, 'getAllNews'])->name('blogs');

// Route::get('resources/case-studies', [PostController::class, 'getAllNews'])->name('case-studies');

// Route::get('resources/blogs/category/{category_id?}', [PostController::class, 'getAllNewsFilter'])->name('blog-filter');

// Route::get('resources/blogs/{news_slug}', [PostController::class, 'getNewsInDetail'])->name('blog');

// Route::get('resources/case-studies/{slug}', [PostController::class, 'getCaseInDetail'])->name('case-study');


// Route::get('contact-us', [PostController::class, 'contactUs'])->name('contact-us');

// Route::post('contact', [PostController::class, 'postContact'])->name('contact');

// Route::post('calculator', [PostController::class, 'postCalculate'])->name('calculator');

// Route::get('services', [PostController::class, 'getServiceDetail'])->name('service-detail');

// Route::get('products', [PostController::class, 'getProductDetail'])->name('product-detail');

// // Route::get('sample-payment', [PaymentController::class, 'getPaymentPage'])->name('sample-payment');

// Route::get('falcon-payment/pay-online', [PostController::class, 'samplePayment'])->name('falcon-pay-online');
// Route::post('falcon-payment/pay-online', [PostController::class, 'samplePaymentPost'])->name('post-falcon-pay-online');

// Route::get('falcon-payment/falconpaygatewaylink-generate', [PostController::class, 'generateSamplePaymentLink'])->name('generate-falconpaygateway-link');

// Route::get("sitemap.xml" , function () { return \Illuminate\Support\Facades\Redirect::to('sitemap.xml'); });  

// // Route::get('academics/faculty', [PostController::class, 'getFaculty'])->name('faculty');

// // Route::get('faculty/{team_slug}', [PostController::class, 'getTeamDetails'])->name('faculty-detail');
// // Route::get('facility/{sub_slug}', [PostController::class, 'getFacilityDetail'])->name('facility-detail');

// // Route::get('get-quote/{id?}', [PostController::class, 'getQuote'])->name('get-quote');

// // Route::post('application', [PostController::class, 'postApplication'])->name('application');

// // Route::get('testimonials', [PostController::class, 'testimonial'])->name('testimonials');

// Route::get('thank-you', [PostController::class, 'thankYou']);
// Route::get('campaign', function () { return view('front.campaign'); });
// Route::get('campaign/thank-you', function () { return view('front.thank-you'); });

// Backend Routes

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';

require __DIR__.'/api.php';

Route::get('errorpage',function(){
    return view('errors.404');
});

Route::get('{parent_slug?}/{sub_slug?}/{child_slug?}/{sub_child_slug?}',  [PostController::class, 'getDynamicContent'])->name('dynamicpage');

