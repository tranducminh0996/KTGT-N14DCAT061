<?php
use Illuminate\Support\Facades\Route;

Route::group([
    "middleware" => ['auth:sanctum', 'verified', 'locale'],
    "prefix" => 'cms',
    "namespace" => "Cms\Gallery"
], function () {
    Route::resource("galleries", "GalleryController");

    Route::get("get-tournament", "PublicController@onSearchTournament");
});
