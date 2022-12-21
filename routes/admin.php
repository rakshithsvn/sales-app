<?php

use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\HomeController;
use App\Http\Controllers\Back\EventController;
use App\Http\Controllers\Back\PostController;
use App\Http\Controllers\Back\FacultyController;
use App\Http\Controllers\Back\LinkFacultyController;
use App\Http\Controllers\Back\LinkUserController;
use App\Http\Controllers\Back\InnerLinkFacultyController;
use App\Http\Controllers\Back\ExternalLinkController;
use App\Http\Controllers\Back\NotificationController;
use App\Http\Controllers\Back\SliderController;
use App\Http\Controllers\Back\TestimonialController;
use App\Http\Controllers\Back\FeatureController;
use App\Http\Controllers\Back\CareerController;
use App\Http\Controllers\Back\MediaController;
use App\Http\Controllers\Back\MediaPhotosController;
use App\Http\Controllers\Back\GalleryController;
use App\Http\Controllers\Back\DownloadController;
use App\Http\Controllers\Back\ParentMenuController;
use App\Http\Controllers\Back\SubMenuController;
use App\Http\Controllers\Back\ChildMenuController;
use App\Http\Controllers\Back\SubChildMenuController;
use App\Http\Controllers\Back\AddressController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\EventUserController;

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth'])->namespace('App\Http\Controllers\Back')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('home', 'HomeController');

    // Users
    Route::name('event-users.seen')->put('event-users/seen/{user}', [EventUserController::class, 'updateSeen']);
    Route::name('event-users.valid')->put('event-users/valid/{user}', [EventUserController::class, 'updateValid']);

    Route::resource('event-users', 'EventUserController', ['except' => 'show']);

    Route::get('event-users-change-password/{event_user}', [EventUserController::class, 'changePassword'])->name('event-users.changepassword');
    Route::post('event-users-save-password', [EventUserController::class, 'saveChangePassword'])->name('event_users.storepassword');
    Route::post('event-users-verify', [EventUserController::class, 'userVerify'])->name('event_users.verify');

    // Products
    Route::resource('products', 'ProductController');
    Route::name('product-photos.remove')->post('product-photos/removePhoto', 'ProductController@removeGalleryPhoto');

     // Dealers
    Route::resource('dealers', 'DealerController');
    Route::name('dealer-photos.remove')->post('dealer-photos/removePhoto', 'DealerController@removeGalleryPhoto');
    
    // Helps
    Route::resource('help-messages', 'HelpMessageController');
    Route::name('help-photos.remove')->post('help-photos/removePhoto', 'HelpMessageController@removeGalleryPhoto');

    // Purchase List
    Route::name('prospects.graduation-index')->get('purchase-list', [DownloadController::class, 'viewGraduationRegister']);

    Route::name('prospects.graduation-view')->get('prospects/graduation-view/{id}', [DownloadController::class, 'viewFullRegister']);

    Route::post('export-graduation', ['as' => 'prospects.graduation-download', 'uses' => [DownloadController::class, 'getExportGraduationReport']]);

    Route::delete('graduation.destroy/{destroy_id}', [
        'as' => 'graduation.destroy', 'uses' => [DownloadController::class, 'deleteGraduationForm']
    ]);


    

    // Events
    Route::resource('events', 'EventController');
    Route::name('event-photos.remove')->post('event-photos/removePhoto', 'EventController@removeGalleryPhoto');

    // Posts
    Route::name('posts.seen')->put('posts/seen/{post}', [PostController::class, 'updateSeen']);
    Route::name('posts.active')->put('posts/active/{post}/{status?}', [PostController::class, 'updateActive']);


    Route::resource('posts', 'PostController');

    Route::name('post.parentslug')->get('post/parentslug', [PostController::class, 'getParentSlug']);

    Route::name('post.subslug')->get('post/subslug', [PostController::class, 'getSubSlug']);

    Route::name('post.submenus')->get('post/submenus', [PostController::class, 'getSubmenuList']);

    Route::name('post.childmenus')->get('post/childmenus', [PostController::class, 'getChildmenuList']);

    Route::name('post.subchildmenus')->get('post/subchildmenus', [PostController::class, 'getSubChildmenuList']);

    Route::name('post.deleteTabSection')->delete('post/deleteTabSection', [PostController::class, 'deletePostTabSection']);

    Route::name('choose.index')->get('choose-us', [PostController::class, 'viewCounter']);

    Route::name('posts.storeCounter')->post('store/counterdetails', [PostController::class, 'storeCounterDetails']);

    Route::name('roi.index')->get('roi-index', [PostController::class, 'viewROI']);

    Route::name('posts.storeROI')->post('store/storeROI', [PostController::class, 'storeROI']);


    //Faculty details
    Route::resource('faculties', 'FacultyController', ['except' => 'show']);

    Route::name('faculties.active')->put('faculties/active/{faculty}/{status?}', [FacultyController::class, 'updateActive']);

    Route::name('faculties.appointment')->put('faculties/appointment/{faculty}/{status?}', [FacultyController::class, 'updateAppointment']);

    Route::name('faculty.deleteTabSection')->delete('faculty/deleteTabSection', [FacultyController::class, 'deletePostTabSection']);

    Route::name('faculties.subcontent')->get('faculties/subcontent', [FacultyController::class, 'getSubContentList']);

    Route::name('appointment.index')->get('appointment/index', [FacultyController::class, 'appointmentIndex']);
    Route::name('appointment.store')->post('appointment/store', [FacultyController::class, 'appointmentStore']);

    Route::name('schedule.create')->get('schedule/create', [FacultyController::class, 'scheduleCreate']);
    Route::name('schedule.store')->post('schedule/store', [FacultyController::class, 'scheduleStore']);
    Route::delete('schedule/remove', [FacultyController::class, 'scheduleRemove']);
    Route::name('schedule.getData')->get('schedule/getData', [FacultyController::class, 'getSchedule']);
    Route::name('schedule.getDoctor')->get('schedule/getDoctor', [FacultyController::class, 'getDoctor']);

    //Link Faculty
    Route::resource('link-faculties', 'LinkFacultyController', ['except' => 'show']);

    Route::name('link-faculties.active')->put('link-faculties/active/{link_faculty}/{status?}', [LinkFacultyController::class, 'updateActive']);

    //Link User
    Route::resource('link-users', 'LinkUserController', ['except' => 'show']);

    Route::name('link-users.active')->put('link-users/active/{link_user}/{status?}', [LinkUserController::class, 'updateActive']);

    //Inner link Faculty
    Route::resource('post-link-faculties', 'InnerLinkFacultyController', ['except' => 'show']);

    Route::name('post-link-faculties.active')->put('post-link-faculties/active/{post_link_faculty}/{status?}', [InnerLinkFacultyController::class, 'updateActive']);

    Route::name('linkfaculties.subcontent')->get('linkfaculties/subcontent', [InnerLinkFacultyController::class, 'getInnerPageList']);

    //External Link
    Route::resource('post-link-pages', 'ExternalLinkController', ['except' => 'show']);

    Route::name('post-link-pages.active')->put('post-link-pages/active/{post_link_page}/{status?}', [ExternalLinkController::class, 'updateActive']);


    Route::name('post-link-pages.link')->get('copy-link', [ExternalLinkController::class, 'copyLink']);

    Route::name('link.deleteTabSection')->delete('link/deleteTabSection', [ExternalLinkController::class, 'deletePostTabSection']);

    // Notifications
    Route::name('notifications.index')->get('notifications/{user?}', [NotificationController::class, 'index']);
    Route::name('notifications.update')->put('notifications/{notification?}', [NotificationController::class, 'update']);

    Route::name('notifications.destroy')->post('notifications/destroy', [NotificationController::class, 'deleteNotification']);


    // Medias
    Route::view('medias', 'back.medias')->name('medias.index');

    //Sliders
    Route::resource('sliders', 'SliderController', ['except' => 'show']);
    Route::name('sliders.active')->put('sliders/active/{slider}/{status?}', [SliderController::class, 'updateActive']);

    //Testimonials
    Route::resource('testimonials', 'TestimonialController', ['except' => 'show']);

    Route::name('testimonials.active')->put('testimonials/active/{testimonial}/{status?}', [TestimonialController::class, 'updateActive']);

    // Features
    Route::resource('features', 'FeatureController', ['except' => 'show']);

    Route::name('features.active')->put('features/active/{feature}/{status?}', [FeatureController::class, 'updateActive']);

    // Careers
    Route::resource('careers', 'CareerController', ['except' => 'show']);

    Route::name('careers.active')->put('careers/active/{career}/{status?}', [CareerController::class, 'updateActive']);

    Route::name('placement.create')->get('placement/create', [CareerController::class, 'careerCreate']);
    Route::name('placement.store')->post('placement/store', [CareerController::class, 'careerStore']);
    Route::delete('placement/remove', [CareerController::class, 'careerRemove']);
    Route::name('placement.getData')->get('placement/getData', [CareerController::class, 'getCareer']);
    Route::name('placement.getDept')->get('placement/getDept', [CareerController::class, 'getDept']);

    //Albums
    // Route::name('albums.index')->get('albums',  [MediaController::class, 'index']);
    Route::resource('albums', 'MediaController', ['except' => 'show']);
    Route::resource('media-photos', 'MediaPhotosController', ['except' => 'show']);

    Route::name('albums.active')->put('albums/active/{album}/{status?}',  [MediaController::class, 'updateActive']);

    Route::name('albums.upload-photos')->get('albums/upload-photos/{album?}',  [MediaController::class, 'uploadPhoto']);
    Route::name('media-photos.storeAlbum')->post('media-photos/storeAlbum/{album?}', [MediaController::class, 'imageUpload']);
    Route::name('media-photos.remove')->post('media-photos/removePhoto', [MediaController::class, 'removePhoto']);

    //Videos
    Route::name('videos.upload-video')->get('videos/upload-video',  [MediaController::class, 'uploadVideo']);
    Route::name('videos.store')->post('videos/store',  [MediaController::class, 'storeVideo']);
    Route::name('media-videos.remove')->post('media-videos/remove-video', [MediaController::class, 'removeVideo']);

    Route::resource('gallery', 'GalleryController', ['except' => 'show']);

    Route::name('gallery.subcontent')->get('gallery/subcontent', [GalleryController::class, 'getSubContentList']);

    Route::name('gallery.deleteTabSections')->post('gallery/deleteTabSections', [GalleryController::class, 'deletePostTabSection']);

    //Prospect Downloads
    Route::resource('prospects', 'DownloadController', ['except' => 'show']);

    Route::name('prospects.active')->put('prospects/active/{prospect}/{status?}', [DownloadController::class, 'updateActive']);

    // Route::name('prospects.graduation-index')->get('graduation-registration', [DownloadController::class, 'viewGraduationRegister']);

    // Route::name('prospects.graduation-view')->get('prospects/graduation-view/{id}', [DownloadController::class, 'viewFullRegister']);

    // Route::post('export-graduation', ['as' => 'prospects.graduation-download', 'uses' => [DownloadController::class, 'getExportGraduationReport']]);

    // Route::delete('graduation.destroy/{destroy_id}', [
    //     'as' => 'graduation.destroy', 'uses' => [DownloadController::class, 'deleteGraduationForm']
    // ]);

    //Online Application

    Route::get('datatable/getposts', ['as' => 'datatable.getposts', 'uses' => [DownloadController::class, 'getPosts']]);

    Route::name('prospects.application-index')->get('application-registration', [DownloadController::class, 'viewApplication']);

    Route::name('prospects.post-application-index')->post('post-application-registration', [DownloadController::class, 'getExportApplicationReport']);

    Route::name('dept.getDoctor')->get('dept/getDoctor', [DownloadController::class, 'getDoctor']);

    Route::get('prospects/application-view/{id}', [
        'as' => 'prospects.application-view', 'uses' => [DownloadController::class, 'viewFullApplication']
    ]);

    Route::post('prospects/application-update', [
        'as' => 'prospects.application-update', 'uses' => [DownloadController::class, 'updateAppointment']
    ]);

    Route::get('prospects/confirm/{id}', [
        'as' => 'prospects.confirm', 'uses' => [DownloadController::class, 'confirmAppointment']
    ]);

    Route::match(array('GET', 'POST'), 'prospects/review/{id?}', [
        'as' => 'prospects.review', 'uses' => [DownloadController::class, 'reviewAppointment']
    ]);

    Route::post('export-application', ['as' => 'prospects.application-download', 'uses' => [DownloadController::class, 'getExportApplicationReport']]);

    Route::get('prospects/application-destroy/{destroy_id}', [
        'as' => 'prospects.application-destroy', 'uses' => [DownloadController::class, 'deleteApplicationForm']
    ]);

    // SMS Report

    Route::name('prospects.sms-index')->get('sms-index', 'DownloadController@viewSMSReport');

    Route::name('prospects.post-sms-index')->post('post-sms-index', 'DownloadController@getExportSMSReport');

    Route::get('datatable/getsms', ['as' => 'datatable.getsms', 'uses' => 'DownloadController@getSMSReport']);

    Route::match(array('GET', 'POST'), 'prospects/resend/{id?}', ['as' => 'prospects.resend', 'uses' => 'DownloadController@resendSMS']);

    // Route::name('prospects.graduation-index')->get('graduation-registration', [DownloadController::class, 'viewGraduationRegister');

    //  Route::get('prospects.graduation-view/{id}', [
    // 'as' => 'prospects.graduation-view', 'uses' => [DownloadController::class, 'viewFullRegister']);
    //  Route::delete('graduation.destroy/{destroy_id}', [
    // 'as' => 'graduation.destroy', 'uses' => [DownloadController::class, 'deleteGraduationForm']);
    //  Route::post('export-graduation', ['as' => 'prospects.graduation-download','uses' => [DownloadController::class, 'getExportGraduationReport']);

    // Parent Menu

    Route::resource('parent-menus', 'ParentMenuController', ['except' => 'show']);

    Route::name('parent-menus.active')->put('parent-menus/active/{parentmenu}/{status?}', [ParentMenuController::class, 'updateActive']);

    Route::name('parentmenu.hierarchy')->get('parentmenu/hierarchy', [ParentMenuController::class, 'gethierarchy']);

    Route::name('parentmenu.checkhierarchy')->post('parentmenu/checkhierarchy', [ParentMenuController::class, 'checkHierarchy']);

    Route::name('parentmenu.checkPosthierarchy')->post('parentmenu/checkPosthierarchy', [ParentMenuController::class, 'checkPostHierarchy']);

    // Sub Menu
    Route::resource('sub-menus', 'SubMenuController', ['except' => 'show']);

    Route::name('sub-menus.active')->put('sub-menus/active/{submenu}/{status?}', [SubMenuController::class, 'updateActive']);

    Route::name('submenu.hierarchy')->get('submenu/hierarchy', [SubMenuController::class, 'gethierarchy']);

    Route::name('submenu.checkhierarchy')->post('submenu/checkhierarchy', [SubMenuController::class, 'checkHierarchy']);

    Route::name('submenu.checkPosthierarchy')->post('submenu/checkPosthierarchy', [SubMenuController::class, 'checkPostHierarchy']);

    // Child menu
    Route::resource('child-menus', 'ChildMenuController', ['except' => 'show']);

    Route::name('child-menus.active')->put('child-menus/active/{childmenu}/{status?}', [ChildMenuController::class, 'updateActive']);

    Route::name('childmenu.hierarchy')->get('childmenu/hierarchy', [ChildMenuController::class, 'gethierarchy']);

    Route::name('childmenu.checkhierarchy')->post('childmenu/checkhierarchy', [ChildMenuController::class, 'checkHierarchy']);

    Route::name('childmenu.checkPosthierarchy')->post('childmenu/checkPosthierarchy', [ChildMenuController::class, 'checkPostHierarchy']);

    // Sub Child Menu
    Route::resource('sub-child-menus', 'SubChildMenuController', ['except' => 'show']);

    Route::name('sub-child-menus.active')->put('sub-child-menus/active/{childmenu}/{status?}', [SubChildMenuController::class, 'updateActive']);

    Route::name('subchildmenu.hierarchy')->get('subchildmenu/hierarchy', [SubChildMenuController::class, 'gethierarchy']);

    Route::name('subchildmenu.checkhierarchy')->post('subchildmenu/checkhierarchy', [SubChildMenuController::class, 'checkHierarchy']);

    Route::name('subchildmenu.checkPosthierarchy')->post('subchildmenu/checkPosthierarchy', [SubChildMenuController::class, 'checkPostHierarchy']);

    //Address

    Route::resource('address', 'AddressController', ['except' => 'show']);

    // Route::name('address.index')->get('address/index', 'AddressController@index');

    // Route::name('address.create')->get('address/create', 'AddressController@create');

    // Route::name('address.store')->post('address/store', 'AddressController@store');

    // Route::name('address.edit')->get('address/edit/{slug}', 'AddressController@edit');

    // Route::name('address.update')->get('address/update/{id}', 'AddressController@update');

    // Route::name('address.destroy')->get('address/destroy/{id}', [AddressController::class, 'destroy']);

});


Route::prefix('admin')->middleware(['auth'])->namespace('App\Http\Controllers\Back')->group(function () {

    // Users
    Route::name('users.seen')->put('users/seen/{user}', [UserController::class, 'updateSeen']);
    Route::name('users.valid')->put('users/valid/{user}', [UserController::class, 'updateValid']);

    Route::resource('users', 'UserController', ['only' => ['index', 'edit', 'update', 'destroy', 'create', 'store']]);

    Route::get('change-password', [UserController::class, 'changePassword'])->name('users.changepassword');
    Route::post('save-password', [UserController::class, 'saveChangePassword'])->name('users.storepassword');

    // Categories
    Route::resource('categories', 'CategoryController', ['except' => 'show']);

    // Contacts
    Route::name('contacts.seen')->put('contacts/seen/{contact}', 'ContactController@updateSeen');
    Route::resource('contacts', 'ContactController', ['only' => [
        'index', 'destroy'
    ]]);

    // Comments
    Route::name('comments.seen')->put('comments/seen/{comment}', 'CommentController@updateSeen');
    Route::resource('comments', 'CommentController', ['only' => [
        'index', 'destroy'
    ]]);

    // Settings
    Route::name('settings.edit')->get('settings', 'AdminController@settingsEdit');
    Route::name('settings.update')->put('settings', 'AdminController@settingsUpdate');

    // Logs
    Route::name('settings.logs')->get('logview', 'AdminController@getLogView');
    Route::name('settings.ajaxlogs')->get('ajaxlogview', 'AdminController@getAjaxLogView');
});
