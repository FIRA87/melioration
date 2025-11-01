<?php

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
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
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

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');
});

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->middleware(RedirectIfAuthenticated::class)->name('admin.login');
Route::get('/admin/logout/page', [AdminController::class, 'adminLogoutPage'])->middleware(RedirectIfAuthenticated::class)->name('admin.logout.page');

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::controller(CategoryController::class)->group(function () { // Category Route
        Route::get('/all/category', 'allCategory')->name('all.category');
        Route::get('/add/category', 'addCategory')->name('add.category');
        Route::post('/store/category', 'storeCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('/update/category', 'updateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'deleteCategory')->name('delete.category');
    });

		Route::get('admin/surveys', [SurveyController::class, 'index'])->name('admin.surveys.index');
    Route::post('admin/surveys', [SurveyController::class, 'store'])->name('admin.surveys.store');
    Route::get('admin/surveys/{survey}', [SurveyController::class, 'show'])->name('admin.surveys.show');
    Route::get('admin/surveys/{survey}/edit', [SurveyController::class, 'edit'])->name('admin.surveys.edit');
    Route::put('admin/surveys/{survey}', [SurveyController::class, 'update'])->name('admin.surveys.update');
    Route::delete('admin/surveys/{survey}', [SurveyController::class, 'destroy'])->name('admin.surveys.destroy');

		

    //Admin User All Route
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
        Route::get('/all/news/post', 'allNewsPost')->name('all.news.post');
        Route::get('/add/news/post', 'addNewsPost')->name('add.news.post');
        Route::post('/store/news/post', 'storeNewsPost')->name('store.news.post');
        Route::get('/edit/news/post/{id}', 'editNewsPost')->name('edit.news.post');
        Route::post('/update/news/post', 'updateNewsPost')->name('update.news.post');
        Route::get('/delete/news/post/{id}', 'deleteNewsPost')->name('delete.news.post');
        Route::get('/inactive/news/post/{id}', 'inactiveNewsPost')->name('inactive.news.post');
        Route::get('/active/news/post/{id}', 'activeNewsPost')->name('active.news.post');
    });

    // Video
    Route::controller(VideoController::class)->group(function () {
        Route::get('/all/video', 'allVideo')->name('all.video');
        Route::get('/add/video', 'addVideo')->name('add.video');
        Route::post('/store/video', 'storeVideo')->name('store.video');
        Route::get('/edit/video/{id}', 'editVideo')->name('edit.video');
        Route::post('/update/video', 'updateVideo')->name('update.video');
        Route::get('/delete/video/{id}', 'deleteVideo')->name('delete.video');
    });

    // Links
    Route::controller(LinkController::class)->group(function () {
        Route::get('/all/links', 'index')->name('all.links');
        Route::get('/add/links', 'create')->name('add.links');
        Route::post('/store/links', 'store')->name('store.links');
        Route::get('/edit/links/{id}', 'edit')->name('edit.links');
        Route::post('/update/links', 'update')->name('update.links');
        Route::get('/delete/links/{id}', 'delete')->name('delete.links');
    });

    // GALLERY WITH IMAGES
    Route::get('/gallery', [GalleryController::class, 'index'])->name('all.gallery');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('add.gallery');
    Route::post('/gallery/create', [GalleryController::class, 'store'])->name('store.gallery');
    Route::get('/gallery/edit/{id}', [GalleryController::class, 'edit'])->name('edit.gallery');
    Route::put('/gallery/update/{id}', [GalleryController::class, 'update'])->name('update.gallery');
    Route::get('/gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('delete.gallery');
    // Delete cover image AND Delete images from the gallery
    Route::delete('/deleteimage/{id}', [GalleryController::class, 'deleteImage']);
    Route::delete('/deletecover/{id}', [GalleryController::class, 'deletecover']);


    // Permissions
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'allPermission')->name('all.permission');
        Route::get('/add/permission', 'addPermission')->name('add.permission');
        Route::post('/store/permission', 'storePermission')->name('store.permission');
        Route::get('/add/permission/{id}', 'editPermission')->name('edit.permission');
        Route::post('/update/permission', 'updatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'deletePermission')->name('delete.permission');
    });

    // Roles
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'allRole')->name('all.roles');
        Route::get('/add/roles', 'addRole')->name('add.roles');
        Route::post('/store/roles', 'storeRole')->name('store.roles');
        Route::get('/add/roles/{id}', 'editRole')->name('edit.roles');
        Route::post('/update/roles', 'updateRole')->name('update.roles');
        Route::get('/delete/roles/{id}', 'deleteRole')->name('delete.roles');

        Route::get('/create/roles/permission', 'addRolePermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'rolePermissionStore')->name('role.permission.store');
        Route::get('/all/role/permission', 'allRolePermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}', 'adminEditRoles')->name('admin.edit.roles');
        Route::get('/admin/delete/roles/{id}', 'adminDeleteRoles')->name('admin.delete.roles');
        Route::post('/role/permission/update/{id}', 'rolePermissionUpdate')->name('role.permission.update');
        Route::get('/admin/delete/roles/{id}', 'adminDeleteRoles')->name('admin.delete.roles');
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


    // SETTINGS SITE
    Route::controller(SettingController::class)->group(function () {
        Route::get('site/setting', 'siteIndex')->name('siteIndex');
        Route::post('/setting/update', 'siteUpdate')->name('update');
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::fallback(function () {    return view('frontend.errors.404');});





