<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\JobController;
use App\Http\Controllers\Backend\LinkController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\LeaderController;
use App\Http\Controllers\Backend\OptionController;
use App\Http\Controllers\Backend\SurveyController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubMenuController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DocumentController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\PresidentController;
use App\Http\Controllers\Backend\ServiceRequestAdminController;
use App\Http\Controllers\Backend\JobApplicationBackendController;
use App\Http\Controllers\Backend\StaticTranslationController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\SurveyVoteController;
use App\Http\Controllers\Frontend\ServiceRequestController;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\JobApplicationController;

Route::get('/page/4', function () { return redirect('/projects'); });
Route::get('/page/5', function () { return redirect('/services'); });
Route::get('/page/6', function () { return redirect('/frontend/jobs'); });
Route::get('/page/8', function () { return redirect('/news'); });
Route::get('/submenu/1', function () { return redirect('/leaders'); });
Route::get('/page/7', function () { return redirect('/frontend/documents'); });





Route::get('/lang/en', [LanguageController::class, 'enLang'])->name('en.lang');
Route::get('/lang/ru', [LanguageController::class, 'ruLang'])->name('ru.lang');
Route::get('/lang/tj', [LanguageController::class, 'tjLang'])->name('tj.lang');

/// Access FOR ALL
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/news', [IndexController::class, 'filterNews'])->name('frontend.news');
Route::get('/news/details/{id}', [IndexController::class, 'newsDetails'])->name('news_details');

Route::get('/news/category/{id}', [IndexController::class, 'catWiseNews']);
Route::post('/news/search', [IndexController::class, 'newsSearch'])->name('news.search');
Route::get('/gallery/details/{id}', [IndexController::class, 'galleryDetails'])->name('frontend.gallery.detail');
Route::get('/services', [ServiceRequestController::class, 'index'])->name('frontend.services');
Route::post('/service-request', [ServiceRequestController::class, 'store'])->name('frontend.service.request');
Route::get('/projects', [IndexController::class, 'allProjects'])->name('frontend.projects');
Route::get('/projects/{id}', [IndexController::class, 'projectDetail'])->name('frontend.project.detail');
Route::get('/galleries', [IndexController::class, 'allGalleries'])->name('frontend.galleries');
Route::get('/videos', [IndexController::class, 'allVideos'])->name('frontend.videos');
Route::get('/reporter/{id}', [IndexController::class, 'reporterAllNews'])->name('reporter.all.news');
Route::get('/page/{url}/{id}', [IndexController::class, 'pageDetails']);
Route::get('/contact', [SettingController::class, 'contactIndex'])->name('contact');
Route::post('/contact/send-email', [SettingController::class, 'send_email'])->name('contact_form_submit');
Route::get('/page/{menu}', [MenuController::class, 'menuShow'])->name('menu.show');
Route::get('/submenu/{submenu}',  [MenuController::class, 'subMenuShow'])->name('submenu.show');
Route::get('/news/details/{id}', [IndexController::class, 'newsDetails'])->name('news_details');
Route::get('/leaders', [IndexController::class, 'allLeader'])->name('frontend.leader');
Route::get('/leaders/details/{id}', [IndexController::class, 'leaderDetail'])->name('frontend.leader.detail');
Route::get('/prezident/detail/{id}', [IndexController::class, 'prezidentDetail'])->name('prezident_detail');
Route::get('frontend/documents', [IndexController::class, 'documents'])->name('frontend.documents');
Route::get('frontend/documents/download/{id}', [IndexController::class, 'documentDownload'])->name('frontend.documents.download');


Route::get('frontend/jobs', [JobApplicationController::class, 'index'])->name('frontend.jobs.index');
Route::get('frontend/jobs/{slug}', [JobApplicationController::class, 'show'])->name('frontend.jobs.show');
Route::get('frontend/jobs/{slug}/apply', [JobApplicationController::class, 'apply'])->name('frontend.jobs.apply');
Route::post('frontend/jobs/submit', [JobApplicationController::class, 'submitApplication'])->name('frontend.jobs.submit');
Route::get('frontend/jobs/{job}/download/{index}', [JobController::class, 'downloadAttachment'])->name('frontend.jobs.download');



// Frontend show & voting
Route::get('survey/{survey}', function(\App\Models\Survey $survey){
    $survey->load('questions.options');
    return view('frontend.survey.show', compact('survey'));
})->name('survey.show');

Route::post('survey/{surveyId}/vote', [SurveyVoteController::class,'vote'])->name('survey.vote');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/change/password', [UserController::class, 'changePassword'])->name('change.password');
    Route::post('/user/change/password', [UserController::class, 'userChangePassword'])->name('user.change.password');
});

// Admin Login/Logout Routes (without auth middleware)
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->middleware(RedirectIfAuthenticated::class)->name('admin.login');
Route::get('/admin/logout/page', [AdminController::class, 'adminLogoutPage'])->middleware(RedirectIfAuthenticated::class)->name('admin.logout.page');

// Admin Dashboard Routes (with auth middleware)
Route::middleware(['auth', 'roles:admin'])->group(function () {
    // Admin Dashboard & Profile
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
        Route::get('/admin/logout', 'adminLogout')->name('admin.logout');
        Route::get('/admin/profile', 'adminProfile')->name('admin.profile');
        Route::post('/admin/profile/store', 'adminProfileStore')->name('admin.profile.store');
        Route::get('/admin/change/password', 'adminChangePassword')->name('admin.change.password');
        Route::post('/admin/update/password', 'adminUpdatePassword')->name('admin.update.password');
    });
    Route::controller(CategoryController::class)->group(function () { // Category Route
        Route::get('/all/category', 'allCategory')->name('all.category');
        Route::get('/add/category', 'addCategory')->name('add.category');
        Route::post('/store/category', 'storeCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('/update/category', 'updateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'deleteCategory')->name('delete.category');
    });
    // Surveys Routes
    Route::prefix('admin')->group(function () {
        Route::resource('surveys', SurveyController::class);
        //Route::resource('questions', QuestionController::class)->except(['show']);
        //Route::resource('options', OptionController::class)->except(['show']);
    });


     // Маршруты для статических переводов
    Route::resource('static-translations', StaticTranslationController::class);


    // Admin Users Management
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/admin', 'allAdmin')->name('all.admin');
        Route::get('/add/admin', 'addAdmin')->name('add.admin');
        Route::post('/store/admin', 'storeAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'editAdmin')->name('edit.admin');
        Route::post('/update/admin', 'updateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'deleteAdmin')->name('delete.admin');
        Route::get('/inactive/admin/user/{id}', 'inactiveAdminUser')->name('inactive.admin.user');
        Route::get('/active/admin/user/{id}', 'activeAdminUser')->name('active.admin.user');
    });

   // News Route
    Route::controller(NewsController::class)->group(function () {
        Route::get('/all/news', 'allNews')->name('all.news');
        Route::get('/add/news', 'addNews')->name('add.news');
        Route::post('/store/news', 'storeNews')->name('store.news');
        Route::get('/edit/news/{news}', 'editNews')->name('edit.news');
        Route::put('/update/news/{news}', 'updateNews')->name('update.news');
        Route::delete('/delete/news/{news}', 'deleteNews')->name('delete.news');
        Route::get('/inactive/news/{id}', 'inactiveNews')->name('inactive.news');
        Route::get('/active/news/{id}', 'activeNews')->name('active.news');
        Route::delete('/delete/gallery-image/{id}', 'deleteGalleryImage')->name('delete.gallery.image');
    });

    // Video
    Route::controller(VideoController::class)->group(function () {
        Route::get('/all/video', 'allVideo')->name('all.video');
        Route::get('/add/video', 'addVideo')->name('add.video');
        Route::post('/store/video', 'storeVideo')->name('store.video');
        Route::get('/edit/video/{id}', 'editVideo')->name('edit.video');
        Route::post('/update/video/{video}', 'updateVideo')->name('update.video');
        Route::get('/delete/video/{video}', 'deleteVideo')->name('delete.video');

    });

    // Links
    Route::controller(LinkController::class)->group(function () {
        Route::get('/all/links', 'index')->name('all.links');
        Route::get('/add/links', 'create')->name('add.links');
        Route::post('/store/links', 'store')->name('store.links');
        Route::get('/edit/links/{link}', 'edit')->name('edit.links');
        Route::put('/update/links/{link}', 'update')->name('update.links');
        Route::delete('/delete/links/{id}', 'delete')->name('delete.links');
    });

    // Gallery Routes
    Route::prefix('gallery')->controller(GalleryController::class)->group(function () {
        Route::get('/', 'index')->name('all.gallery');
        Route::get('/create', 'create')->name('add.gallery');
        Route::post('/create', 'store')->name('store.gallery');
        Route::get('/edit/{id}', 'edit')->name('edit.gallery');
        Route::put('/update/{id}', 'update')->name('update.gallery');
        Route::get('/delete/{id}', 'destroy')->name('delete.gallery');
    });
    // Gallery Images Management
    Route::controller(GalleryController::class)->group(function () {
        Route::delete('/deleteimage/{id}', 'deleteImage');
        Route::delete('/deletecover/{id}', 'deletecover');
    });



     // Permission All Route
     Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
    });

    // Roles All Route
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');
        // add role permission
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}', 'AdminRolesEdit')->name('admin.edit.roles');
        Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}', 'AdminRolesDelete')->name('admin.delete.roles');
    });

    // ALL PAGES IN ADMINISTRATOR
    Route::controller(PageController::class)->group(function () {
        Route::get('/all/pages', 'index')->name('all.pages');
        Route::get('/add/pages', 'create')->name('add.pages');
        Route::post('/store/pages', 'store')->name('store.page');
        Route::get('/edit/pages/{id}', 'edit')->name('edit.page');
        Route::post('/update/pages', 'update')->name('update.page');
        Route::get('/delete/pages/{id}', 'delete')->name('delete.page');
        Route::post('/admin/pages/update-status', 'updateStatus');
        Route::post('/admin/pages/delete-image', 'deleteImage')->name('pages.delete.image');
    });

    // SubMenu routes
    Route::controller(SubMenuController::class)->group(function () {
        Route::get('/all/sub_menu', 'index')->name('all.submenu');
        Route::get('/add/submenu', 'create')->name('add.submenu');
        Route::post('/store/submenu', 'store')->name('store.submenu');
        Route::get('/edit/submenu/{id}', 'edit')->name('edit.submenu');
        Route::post('/update/submenu', 'update')->name('update.submenu');
        Route::get('/delete/submenu/{id}', 'delete')->name('delete.submenu');
        Route::post('/admin/submenu/update-status', 'updateStatus');
        Route::post('/admin/submenu/delete-image', 'deleteImage')->name('submenu.delete.image');
     
    });

    // Site Settings
    Route::controller(SettingController::class)->group(function () {
        Route::get('/site/setting', 'siteIndex')->name('setting.index');
        Route::post('/setting/update', 'siteUpdate')->name('setting.update');
    });

    // PRESIDENTS ROUTES
    Route::controller(PresidentController::class)->group(function () {
        Route::get('/all/presidents', 'index')->name('all.presidents');
        Route::get('/add/presidents', 'create')->name('add.presidents');
        Route::post('/store/presidents', 'store')->name('store.presidents');
        Route::get('/edit/presidents/{id}', 'edit')->name('edit.presidents');
        Route::post('/update/presidents', 'update')->name('update.presidents');
        Route::get('/delete/presidents/{id}', 'delete')->name('delete.presidents');
    });

    // PROJECTS ROUTES
    Route::controller(ProjectController::class)->group(function () {
        Route::get('/all/projects', 'index')->name('all.projects');
        Route::get('/add/projects', 'create')->name('add.projects');
        Route::post('/store/projects', 'store')->name('store.projects');
        Route::get('/edit/projects/{id}', 'edit')->name('edit.projects');
        Route::post('/update/projects', 'update')->name('update.projects');
        Route::get('/delete/projects/{id}', 'delete')->name('delete.projects');
        Route::post('/delete/projects/gallery/image', 'deleteGalleryImage')->name('delete.projects.gallery.image');
    });

    // TASKS ROUTES
    Route::controller(TaskController::class)->group(function () {
        Route::get('/all/tasks', 'index')->name('all.tasks');
        Route::get('/add/tasks', 'create')->name('add.tasks');
        Route::post('/store/tasks', 'store')->name('store.tasks');
        Route::get('/edit/tasks/{id}', 'edit')->name('edit.tasks');
        Route::post('/update/tasks', 'update')->name('update.tasks');
        Route::get('/delete/tasks/{id}', 'delete')->name('delete.tasks');
    });

    Route::prefix('documents')->name('documents.')->controller(DocumentController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{document}/edit', 'edit')->name('edit');
        Route::put('/{document}', 'update')->name('update');
        Route::delete('/{document}', 'destroy')->name('destroy');
        Route::get('/{document}/download', 'download')->name('download');
    });


    // SERVICES ROUTES
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/all/services', 'index')->name('all.services');
        Route::get('/add/services', 'create')->name('add.services');
        Route::post('/store/services', 'store')->name('store.services');
        Route::get('/edit/services/{id}', 'edit')->name('edit.services');
        Route::post('/update/services', 'update')->name('update.services');
        Route::get('/delete/services/{id}', 'delete')->name('delete.services');
    });

    Route::controller(ServiceRequestAdminController::class)->group(function () {
        Route::get('/admin/service-requests', 'index')->name('all.service.requests');
        Route::get('/admin/service-requests/delete/{id}', 'delete')->name('delete.service.request');
    });

    Route::get('/admin/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/admin/media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::post('/admin/media/create-folder', [MediaController::class, 'createFolder'])->name('media.createFolder');
    Route::post('/admin/media/delete', [MediaController::class, 'delete'])->name('media.delete');
    Route::post('/admin/media/rename', [MediaController::class, 'rename'])->name('media.rename');


    Route::controller(LeaderController::class)->group(function () {
        Route::get('admin/leaders', 'index')->name('leader.index');
        Route::get('admin/leaders/create', 'create')->name('leader.create');
        Route::post('admin/leaders', 'store')->name('leader.store');
        Route::get('admin/leaders/{id}/edit', 'edit')->name('leader.edit');
        Route::post('admin/leaders/{id}', 'update')->name('leader.update');
        Route::delete('admin/leaders/{id}', 'destroy')->name('leader.destroy');
    });


    Route::prefix('jobs')->name('admin.jobs.')->controller(JobController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{job}/edit', 'edit')->name('edit');
        Route::put('/{job}', 'update')->name('update');
        Route::delete('/{job}', 'destroy')->name('destroy');
        Route::get('/{job}/attachment/{index}', 'downloadAttachment')->name('download.attachment');
    });

    Route::post('/jobs/{job}/delete-attachment', [JobController::class, 'deleteAttachment'])->name('jobs.delete.attachment');

    // Управление заявками на вакансии  
    Route::get('/admin/applications', [JobApplicationBackendController::class, 'index'])->name('backend.applications.index');
    Route::get('/admin/applications/{application}', [JobApplicationBackendController::class, 'show'])->name('backend.applications.show');
    Route::patch('/admin/applications/{application}/status', [JobApplicationBackendController::class, 'updateStatus'])->name('backend.applications.status');
    Route::delete('/admin/applications/{application}', [JobApplicationBackendController::class, 'destroy'])->name('backend.applications.destroy');
    Route::get('/admin/applications/{application}/resume', [JobApplicationBackendController::class, 'downloadResume'])->name('backend.applications.resume');
    Route::get('/admin/applications/{application}/attachment/{index}', [JobApplicationBackendController::class, 'downloadAttachment'])->name('backend.applications.attachment');



    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');


});

/**
 * Route for clearing cache when uploading to Production Server
 */
Route::get('/clear-configuration', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('route:clear');

    return "Everything is clear and system is ready to work.";
});
