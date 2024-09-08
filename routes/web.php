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


// --- Home page displays list of all items in the db --- //
Route::get('/', function () {
    $sql = "select Item.Item_id, Name, Manufacturer, Image, Description, ROUND(AVG(rating),1) AS 'Rating', COUNT(rating) AS 'Total' 
            from Item left join Review on Item.Item_id = Review.Item_id
            group by Item.Item_id";
    $items = DB::select($sql);

    return view('homePage')->with('items', $items);
});


// --- Review page displays details of item selected and its reviews --- //
Route::get('item_detail/{id}', function ($id) {
    $item = get_item($id);
    $reviews = DB::select("select * from Review where Item_id = ?", array($id));
    $review_summary = DB::select("select COUNT(rating) AS 'Count', ROUND(AVG(rating),1) AS 'AvgRating' from Review where Item_id = ?", array($id));
    return view('reviewPage')->with('item', $item)->with('reviews', $reviews)->with('reviewSummary', $review_summary[0]);
});


// --- Sort item in the home page based on selected method --- //
Route::get('sort/{method}', function ($method) {
    if ($method == 'high-to-low-review') {
        $sort = 'Total desc';
    };
    if ($method == 'low-to-high-review') {
        $sort = 'Total';
    };
    if ($method == 'high-to-low-rating') {
        $sort = 'Rating desc';
    };
    if ($method == 'low-to-high-rating') {
        $sort = 'Rating';
    };

    $sql = "select Item.Item_id, Name, Manufacturer, Image, Description, ROUND(AVG(rating),1) AS 'Rating', COUNT(rating) AS 'Total' 
            from Item left join Review on Item.Item_id = Review.Item_id
            group by Item.Item_id
            order by $sort";
    $items = DB::select($sql);

    return view('homePage')->with('items', $items);
});

// --- Adding item into database --- //
Route::post('add_item', function() {
    $name = request('item_name');
    $manufacturer = request('manufacturer');
    $image = request('image');
    $description = request('description');

    // Validate inputs
    $item_name_error = validateInput($name, "Item name");
    $manufacturer_name_error = validateInput($manufacturer, "Manufacturer name");
    if(!empty($item_name_error) || !empty($manufacturer_name_error)) {
        return redirect("/")->with('item_name_error', $item_name_error)->with('manufacturer_name_error', $manufacturer_name_error);
    }

    $sql = "insert into Item values (null, ?, ?, ?, ?)";
    DB::insert($sql, array($name, $manufacturer, $description, $image));

    return redirect("/")->with('message', "Item added successfully!");
});

// --- Adding review to an item and return to the item detail page including recently added review --- //
Route::post('{id}/add_review', function ($id) {
    $username = request('username');
    $rating = request('rating');
    $reviewText = request('reviewText');
    $date = date('Y-m-d');
    $old_name = '';

    $usernameError = validateInput($username, "Username"); // check if the username has error or nor
    if(!empty($usernameError)) { // if it has error, display the
        return redirect("item_detail/$id")->with('username_error', $usernameError);
    }

    // Remove odd number in the username 
    $alteredUsername = remove_odd_number($username);
    if($alteredUsername !== $username) { // if the new username is different, copy and store the old name
        $old_name = $username;
        $username = $alteredUsername;
    }
    else {
        $old_name = $alteredUsername;
    }

    // Store username in session by using global "session" helper
    session(['username'=>$username]);

    $check = check_user_not_made_review($username, $id); // check if the user have made a review yet
    if(!$check) {
        return redirect("item_detail/$id")->with('message', "Error! You have already made a review for this item.");
    }

    $sql = "insert into Review values (null, ?, ?, ?, ?, ?)";
    DB::insert($sql, array($username, $rating, $date, $reviewText, $id));
    if($old_name !== $username) {
        return redirect("item_detail/$id")->with('message', "Your username has been changed from ".$old_name." to ".$alteredUsername." due to our regulation. Review added successfully!");
    } else {
        return redirect()->back()->with('message', "Review added successfully!");
    }
});


// --- Editting review --- //
Route::post('{id}/update_review', function ($id) {
    $review_id = request('review_id');
    $username = request('username');
    $rating = request('rating');
    $reviewText = request('reviewText');
    $date = date('Y-m-d');

    $editUsernameError = validateInput($username, "Username"); // check if the username has error or nor
    if(!empty($editUsernameError)) { // if it has error, display the
        return redirect("item_detail/$id")->with('edit_username_error', $editUsernameError);
    }

    //Update sql statement
    $sql = "update Review set Username = ?, Rating = ?, date = ?, reviewText = ? where Review_id = ?";
    DB::update($sql, array($username, $rating, $date, $reviewText, $review_id));
    return redirect("item_detail/$id")->with("message", "Review updated successfully!");
});

// --- Delete item --- //
Route::get('{id}/delete', function($id) {
    DB::delete("delete from Review where Item_id = ?", array($id));
    DB::delete("delete from Item where Item_id = ?", array($id));
    return redirect("/")->with('message', "Item deleted successfully!");
});

// --- List all manufacturers --- //
Route::get('manufacturer', function() {
    $sql = "select Manufacturer, ROUND(AVG(ItemAvgrating), 1) AS 'ManufacturerAvgRating' 
    from (select Item.Item_id, Item.Manufacturer, ROUND(AVG(rating), 1) AS ItemAvgRating 
        from Item left join Review on Item.Item_id = Review.Item_id 
        group by Item.Item_id)
    group by manufacturer;";
    $manufacturers = DB::select($sql);
    return view('manufacturer')->with('manufacturers', $manufacturers);
});

// --- List all items belonging to the manufacturer --- //
Route::get('{manufacturer}', function($manufacturer) {
    $sql = "select Item.Item_id, Name, Manufacturer, Image, Description, ROUND(AVG(rating),1) AS 'Rating', COUNT(rating) AS 'Total' 
            from Item left join Review on Item.Item_id = Review.Item_id where Manufacturer = ?
            group by Item.Item_id";
    $items = DB::select($sql, array($manufacturer));
    return view('manufacturer-item-list')->with('items', $items)->with('manufacturer', $manufacturer);
});


// --- function returns an item based on its id --- //
function get_item($id)
{
    $sql = "select * from item where Item_id = ? ";
    $items = DB::select($sql, array($id));
    if (count($items) !== 1) {
        die("Something has gone wrong, invalid query or result: $sql");
    }
    $item = $items[0];
    return $item;
}

/* --- function checks if a user has made a review for the item yet ---
-> Return true if they have not made any comments
-> Return false if they have already made review
*/
function check_user_not_made_review($username, $id)
{
    $sql = "select count(*) as 'count' from review where username = ? and Item_id = ?;";
    $count = DB::select($sql, array($username, $id));
    $check = $count[0]->count !== 0; 
    if ($check) {
        return false;
    } else {
        return true;
    }
}

// --- function validates input fields --- // 
function validateInput($string, $field) {
    $error = '';
    // check the input text has more than 2 chars
    if(strlen($string) <= 2) {
        $error = $field." must be more than 2 characters";
    }
    // check the input text does not contain any special chars including -, +, _, ".
    if(preg_match('/[-_+"]/', $string)) {
        $error = $field." cannot contain special symbols.";
    }

    return $error;
}

// --- function removing the odd number in the username --- //
function remove_odd_number($username) {
    $pattern = '/(\d*[13579])/';
    // Remove odd numbers
    $alteredUsername = preg_replace($pattern, '', $username);
    return $alteredUsername;
}