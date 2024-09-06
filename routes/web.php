<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return view('homePage');
});


Route::get('/test', function() {
    $sql = "select * from Item";
    $items = DB::select($sql);
    // dd($items);
    return view('homePage')->with('items', $items);
});

Route::get('item_detail/{id}', function($id) {
    $item = get_item($id);
    return view('reviewPage')->with('item', $item);
});

function get_item($id) {
    $sql = "select * from item where Item_id = ? ";
    $items = DB::select($sql, array($id));
    if(count($items) !== 1)  {
        die("Something has gone wrong, invalid query or result: $sql");
    }
    $item = $items[0];
    return $item;
}