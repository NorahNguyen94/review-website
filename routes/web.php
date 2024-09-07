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


// --- HOME PAGE DISPLAYS LIST OF ALL ITEMS IN THE DB ---
Route::get('/', function() {
    $sql = "select Item.Item_id, Name, Manufacturer, Image, Description, ROUND(AVG(rating),1) AS 'Rating', COUNT(rating) AS 'Total' 
            from Item, Review
            where Item.Item_id = Review.Item_id
            group by Item.Item_id";
    $items = DB::select($sql);
    
    return view('homePage')->with('items', $items);
});


// --- REVIEW PAGE DISPLAYS DETAILS OF ITEM SELECTED AND ITS REVIEWS ---
Route::get('item_detail/{id}', function($id) {
    $item = get_item($id);
    $reviews = DB::select("select * from Review where Item_id = ?", array($id));
    $review_summary = DB::select("select COUNT(rating) AS 'Count', ROUND(AVG(rating),1) AS 'AvgRating' from Review where Item_id = ?", array($id));
    return view('reviewPage')->with('item', $item)->with('reviews', $reviews)->with('reviewSummary', $review_summary[0]);
});


// --- function returns an item based on its id --- 
function get_item($id) {
    $sql = "select * from item where Item_id = ? ";
    $items = DB::select($sql, array($id));
    if(count($items) !== 1)  {
        die("Something has gone wrong, invalid query or result: $sql");
    }
    $item = $items[0];
    return $item;
}

// --- SORT ITEMS IN THE HOME PAGE ---
Route::get('sort/{method}', function($method) {
    if($method == 'high-to-low-review') { $sort = 'Total desc' ;};
    if($method == 'low-to-high-review') { $sort = 'Total' ;};
    if($method == 'high-to-low-rating') { $sort = 'Rating desc' ;};
    if($method == 'low-to-high-rating') { $sort = 'Rating' ;};

    $sql = "select Item.Item_id, Name, Manufacturer, Image, Description, ROUND(AVG(rating),1) AS 'Rating', COUNT(rating) AS 'Total' 
            from Item, Review
            where Item.Item_id = Review.Item_id
            group by Item.Item_id
            order by $sort";
    $items = DB::select($sql);
    
    return view('homePage')->with('items', $items);
});