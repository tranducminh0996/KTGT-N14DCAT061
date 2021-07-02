<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\AthleticController;
use App\Http\Controllers\Admin\TournamentController;
use App\Http\Controllers\Admin\TournamentAthleticController;

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

Route::middleware('locale')->get('/', 'HomeController@index')->name('home');

Route::middleware('locale')->get('/schedule', 'ScheduleController@index');
Route::middleware('locale')->get('/news', 'NewsController@index');
Route::middleware('locale')->get('/video', 'VideoController@index');
Route::middleware('locale')->get('/leaderboard', 'LeaderBoardController@index');
Route::middleware('locale')->get('/image-library', 'ImageLibraryController@index');
Route::middleware('locale')->get('/livescore', 'LivescoreController@index');

Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('user.change-language');


Route::group([
    'middleware' => ['locale'],
    'prefix' => 'athletic',
], function () {

//    Route::get('search', 'AthleticController@search')->name('athleticSearch');

    Route::get('/', 'AthleticController@index')->name('athletic.index');;

    Route::get('award/{name}', 'AthleticController@awardAthletic')->name('awardAthletic');;
    Route::get('score/{name}', 'AthleticController@scoreTourAthletic')->name('scoreTourAthletic');;
    Route::get('info/{name}', 'AthleticController@infoAthletic')->name('infoAthletic');;
});



Route::group([
    'middleware' => ['auth:sanctum', 'verified', 'locale'],
    'prefix' => 'cms',
], function () {


    ///AJAX
    Route::get('tour/searchFacility', 'SearchController@searchFacility')->name('searchFacility');
    Route::get('tour/searchTour', 'SearchController@searchTour')->name('searchTour');
    Route::get('searchCountry', 'SearchController@searchCountry')->name('searchCountry');

    Route::post('banner_home/updateStatusBanner', 'Cms\BannerHomeController@updateStatusBanner')->name('updateStatusBanner');
    Route::get('banner_home/addViewUpload', 'Cms\BannerHomeController@addViewUpload')->name('addViewUpload');

    Route::get('manage_athletic/addViewTimeline', 'Cms\ManageAthleticController@addViewTimeline')->name('addViewTimeline');

    Route::post('banner_home/delete', 'Cms\BannerHomeController@deleteBannerHome')->name('deleteBannerHome');

//    BANNER
    Route::resource('banner_home', 'Cms\BannerHomeController');

    ////TICKET
    Route::get('manage_schedule_ticket/addViewTicket', 'Cms\ManageScheduleTicketController@addViewTicket')->name('manage_schedule_ticket.addViewTicket');
    Route::resource('manage_schedule_ticket', 'Cms\ManageScheduleTicketController');

    ///ATHLETIC
    Route::get('manage_athletic/approve', 'Cms\ManageAthleticController@approveAthletic')->name('manage_athletic.approve');
    Route::get('manage_athletic/advertise', 'Cms\ManageAthleticController@advertiseAthletic')->name('manage_athletic.advertise');
    Route::get('manage_athletic/remove', 'Cms\ManageAthleticController@removeAthletic')->name('manage_athletic.remove');


    Route::post('manage_athletic/storeTimeline', 'Cms\ManageAthleticController@storeTimeline')->name('manage_athletic.storeTimeline');
    Route::resource('manage_athletic', 'Cms\ManageAthleticController');

    ///TOURNAMENT
    Route::get('manage_tour/addViewUpload', 'Cms\ManageTournamentController@addViewUpload')->name('manage_tour.addViewUpload');
    Route::resource('manage_tour', 'Cms\ManageTournamentController');

    ///VIDEO
    Route::resource('manage_video', 'Cms\ManageVideoController');

});

Route::group([
    'middleware' => ['auth:sanctum', 'verified', 'locale'],
    'prefix' => 'admin',
], function () {
    //Post
    Route::get('post/list', [PostController::class, 'getPosts'])->name('post.list');
    Route::get('post/edit/{id}', [PostController::class, 'show'])->name('post.show');
    Route::post('post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post/create', [PostController::class, 'store'])->name('post.store');
    Route::post('upload-image-post', [PostController::class, 'uploadImage'])->name('upload.image.post');
//    Route::get('post', [PostController::class, 'index'])->name('post.index');
//    Route::post('data', [PostController::class, 'getDataTables'])->name('post.datatable');
//    Route::get('post/edit-add/{id?}', [PostController::class, 'editAdd'])->name('post.editAdd');
//    Route::post('post/storeUpdate/{id?}', [PostController::class, 'storeUpdate'])->name('post.storeUpdate');
    Route::get('post/delete/{id?}', [PostController::class, 'delete'])->name('post.delete');


    //Video
    Route::get('video/list', [VideoController::class, 'index'])->name('video.list');
    Route::get('video/edit/{id}', [VideoController::class, 'showVideo'])->name('video.show');
    Route::post('video/edit/{id}', [VideoController::class, 'edit'])->name('video.edit');
    Route::get('video/create', [VideoController::class, 'create'])->name('video.create');
    Route::post('video/create', [VideoController::class, 'store'])->name('video.store');
    Route::delete('video/delete/{id}', [VideoController::class, 'destroyVideo'])->name('video.delete');

    //Excel
    Route::get('athletic/export/{id?}', [AthleticController::class, 'export'])->name('athletic.excel.export');
    Route::get('ranking', [AthleticController::class, 'createImport'])->name('tournament.ranking');
    Route::post('athletic/import/storeUpdate', [AthleticController::class, 'import'])->name('athletic.excel.import');
    Route::post('athletic/storeUpdate/{id?}', [AthleticController::class, 'storeUpdate'])->name('athletic.storeUpdate');
    Route::get('export/template', [AthleticController::class, 'exportTemplate'])->name('excel.template');
    Route::get('rank/delete/{id?}/{tournamentId?}', [AthleticController::class, 'deleteRank'])->name('tournament.ranking.delete');

    //Tournament
    Route::get('tournament', [TournamentController::class, 'index'])->name('tournament.index');
    Route::post('tournament/data', [TournamentController::class, 'getDataTable'])->name('tournament.datatable');
    Route::get('tournament/edit-add/{id?}', [TournamentController::class, 'editAA'])->name('tournament.editAdd');
    Route::post('tournament/storeUpdate/{id?}', [TournamentController::class, 'storeUpdate'])->name('tournament.storeUpdate');

    //Tournament With Athletic
    Route::get('tournament/athletic/{id?}', [TournamentAthleticController::class, 'getByIdTournament'])->name('tournament.athletic');
});

Route::get('/post/{slug}', [PostController::class, 'getRouteSlug'])->name('post.route.slug');
Route::get('/video/{slug}', [VideoController::class, 'getRouteSlug'])->name('video.route.slug');


