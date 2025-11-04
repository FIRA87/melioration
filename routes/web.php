<?php

use App\Http\Controllers\Backend\ServiceRequestAdminController;
use App\Http\Controllers\Backend\SurveyController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\LinkController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\SubMenuController;
use App\Http\Controllers\Backend\PresidentController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\ServiceRequestController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;


/// Access FOR ALL
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/lang/en', [LanguageController::class, 'enLang'])->name('en.lang');
Route::get('/lang/ru', [LanguageController::class, 'ruLang'])->name('ru.lang');
Route::get('/lang/tj', [LanguageController::class, 'tjLang'])->name('tj.lang');

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
        Route::get('surveys', [SurveyController::class, 'index'])->name('admin.surveys.index');
        Route::post('surveys', [SurveyController::class, 'store'])->name('admin.surveys.store');
        Route::get('surveys/{survey}', [SurveyController::class, 'show'])->name('admin.surveys.show');
        Route::get('surveys/{survey}/edit', [SurveyController::class, 'edit'])->name('admin.surveys.edit');
        Route::put('surveys/{survey}', [SurveyController::class, 'update'])->name('admin.surveys.update');
        Route::delete('surveys/{survey}', [SurveyController::class, 'destroy'])->name('admin.surveys.destroy');
    });

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

    // Permissions
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'allPermission')->name('all.permission');
        Route::get('/add/permission', 'addPermission')->name('add.permission');
        Route::post('/store/permission', 'storePermission')->name('store.permission');
        Route::get('/add/permission/{id}', 'editPermission')->name('edit.permission');
        Route::post('/update/permission', 'updatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'deletePermission')->name('delete.permission');
    });

    // Roles Management
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'allRole')->name('all.roles');
        Route::get('/add/roles', 'addRole')->name('add.roles');
        Route::post('/store/roles', 'storeRole')->name('store.roles');
        Route::get('/add/roles/{id}', 'editRole')->name('edit.roles');
        Route::post('/update/roles', 'updateRole')->name('update.roles');
        Route::get('/delete/roles/{id}', 'deleteRole')->name('delete.roles');
    });

    // Roles & Permissions Management
    Route::controller(RoleController::class)->group(function () {
        Route::get('/create/roles/permission', 'addRolePermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'rolePermissionStore')->name('role.permission.store');
        Route::get('/all/role/permission', 'allRolePermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}', 'adminEditRoles')->name('admin.edit.roles');
        Route::get('/admin/delete/roles/{id}', 'adminDeleteRoles')->name('admin.delete.roles');
        Route::post('/role/permission/update/{id}', 'rolePermissionUpdate')->name('role.permission.update');
    });

    // ALL PAGES IN ADMINISTRATOR
    Route::controller(PageController::class)->group(function () {
        Route::get('/all/pages', 'index')->name('all.pages');
        Route::get('/add/pages', 'create')->name('add.pages');
        Route::post('/store/pages', 'store')->name('store.pages');
        Route::get('/edit/pages/{id}', 'edit')->name('edit.pages');
        Route::post('/update/pages', 'update')->name('update.pages');
        Route::get('/delete/pages/{id}', 'delete')->name('delete.pages');
        Route::post('/admin/pages/update-status', 'updateStatus');
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

    Route::controller(MediaController::class)->prefix('admin/media')->group(function () {
        Route::get('/', 'index')->name('media.index');
        Route::post('/upload', 'upload')->name('media.upload');
        Route::post('/create-folder', 'createFolder')->name('media.createFolder');
        Route::delete('/delete', 'delete')->name('media.delete');
        Route::post('/rename', 'rename')->name('media.rename'); // ← новое
    });

});
