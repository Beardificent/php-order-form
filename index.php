<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);


//DISPLAY ERROR HANDLING
ini_set("display_errors", '1');
ini_set("display_startup_errors", '1');
error_reporting(E_ALL);




//we are going to use session variables so we need to enable sessions
session_start();

$emailErr = $streetErr = $streetNumErr = $cityErr = $zipcodeErr = "";
$email = $street = $streetNum = $city = $zipcode = "" ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = check_input($_POST["email"]);
    }

    if (empty($_POST["street"])) {
        $streetErr = "street is required";
    } else {
        $street = check_input($_POST["street"]);
    }

    if (empty($_POST["streetnumber"])) {
        $streetNumErr = "streetnumber is required";
    } else {
        $streetNum = check_input($_POST["streetnumber"]);
    }

    if (empty($_POST["city"])) {
        $cityErr = "city is required";
    } else {
        $city = check_input($_POST["city"]);
    }

    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "zipcode is required";
    } else {
        $zipcode = check_input($_POST["zipcode"]);
    }
}



// define variables and set to empty values
$email = $street = $streetnumber = $city = $zipcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = check_input($_POST["email"]);
    $street = check_input($_POST["street"]);
    $streetnumber = check_input($_POST["streetnumber"]);
    $city = check_input($_POST["city"]);
    $zipcode = check_input($_POST["zipcode"]);
}

function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;

require 'form-view.php';
