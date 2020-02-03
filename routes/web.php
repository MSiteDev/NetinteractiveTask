<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view("/", "welcome")->name("welcome");

Route::prefix("users")->name("users.")->group(function () {

    Route::get("", [UserController::class, "index"])->name("list");
    Route::get("show/{user}", [UserController::class, "show"])->name("show")->where("user", "[0-9]+");
    Route::get("form", [UserController::class, "showForm"])->name("form");
    Route::post("form", [UserController::class, "store"])->name("store");

});