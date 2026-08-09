<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::get("/users/{userId}", [UserController::class, "get"]);
Route::get("/messages/{authId}/{userId}", [MessageController::class, "get"]);
Route::post("/messages", [MessageController::class, "save"]);
