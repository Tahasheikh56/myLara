<?php

use App\Http\Controllers\regCon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

//home page
Route::get("/", function () {
    return view("welcome");
});

//registration page
Route::get("/registration", function () {
    return view("reg");
})->name("/reg");

//add data in db
Route::post("add", [regCon::class, "addData"])->name("/add");

//Fetch data to db to ui
Route::get("/userData", [regCon::class, "dataFetch"])->name("/userData");

//open edit form
Route::get("/editForm/{id}", [regCon::class, "editForm"])->name("/editForm");

//update data in db
Route::post("/updateData/{id}", [regCon::class, "updateData"])->name("/updateData");

//delete data in db
Route::get("/deleteData/{id}", [regCon::class, "deleteData"])->name("/deleteData");

//login form open
Route::get("/login", function () {
    return view("login");
})->name("/login");

//user login into website
Route::post("/userLogin", [regCon::class, "userLogin"])->name("/userLogin");

//logout user
Route::get("/logout", [regCon::class, "userLogout"])->name("/logout");

//dashboard page open with session check
Route::get("/dashboard", [regCon::class, "sessionCheckDashboard"])->name("/dashboard");

//chat  open with session check
Route::get("/chat", [regCon::class, "sessionCheckChat"])->name("/chat");

//chat person open can chat this person
Route::get("/chatPerson/{id}", [regCon::class, "chatPersonData"])->name("/chatPerson");

//chat msg snder 
Route::post("/msgSend", [regCon::class, "msgSender"])->name("/msgSend");

