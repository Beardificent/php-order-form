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
$success = "";
$totalValue = 0;


//SESSION (CONFUSED ME) FIRST WE DEFINE THE VARIABLE OF OUR SESSION WHICH CORRESPONDS WITH THE LOCATION IN DOM (CONTINUED DOWN IN IF STATEMENTS)
if (!empty($_SESSION['street'])){
    $street = $_SESSION['street'];
}
if (!empty($_SESSION['streetnumber'])){
    $streetNum = $_SESSION['streetnumber'];
}
if (!empty($_SESSION['city'])){
    $city = $_SESSION['city'];
}
if (!empty($_SESSION['zipcode'])){
    $zipcode = $_SESSION['zipcode'];
}

//ERROR MESSAGING INPUTFIELDS


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if (empty($_POST["street"])) {
        $streetErr = "Street is required";
    } else {
        $street = $_POST["street"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$street)) {
            $streetErr = "Only letters and white space allowed";
        } else {
            //DEFINE SESSION WHICH EQUALS VARIABLE WE CREATED ABOVE
            $_SESSION['street'] = $street;
        }
    }

    if (empty($_POST["streetnumber"])) {
        $streetNumErr = "Streetnumber is required";
    } else {
        $streetNum = $_POST["streetnumber"];
        if(!preg_match("/^[0-9*#+]+$/", $streetNum)){
            $streetNumErr = "Only numeric values allowed";
        } else {
            $_SESSION['streetnumber'] = $streetNum;
        }
    }

    if (empty($_POST["city"])) {
        $cityErr = "City is required";
    } else {
        $city = $_POST["city"];
        if (!preg_match("/^[a-zA-Z-' ]*$/",$city)) {
            $cityErr = "Only letters and white space allowed";
        } else {
            $_SESSION['city'] = $city;
        }
    }

    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "Zipcode is required";
    } else {
        $zipcode = $_POST["zipcode"];
        if(!preg_match("/^[0-9*#+]+$/", $zipcode)){
           $zipcodeErr = "Only numeric values allowed";
        } else {
            $_SESSION['zipcode'] = $zipcode;
        }

    }
    if ($emailErr == "" && $streetErr == "" && $streetNumErr == "" && $cityErr == "" && $zipcodeErr == ""){
        if (isset($_POST['express_delivery']) && $_POST['express_delivery'] == '5') {
            $totalValue += 5;
            $success = '<div class="alert alert-success" role="alert">
        This is a success alert—check it out! Order will be delivered in 45min!
</div>';
        } else {
            $success = '<div class="alert alert-success" role="alert">
        This is a success alert—check it out! Order will be delivered in 2hours!
</div>';
        }
    }

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
$food = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

if (!isset($_SESSION['products'])){
    $products = $food;
}

$drinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];


if (isset($_GET['food'])) {
    if ($_GET['food'] == '1') {
        $products = $food;
    } else {
        $products = $drinks;
    }
}







/*
$totalValue = $food[0]['price'] + $food[1]['price'] + $food[2]['price'] + $food[3]['price'] + $food[4]['price'] + $drinks[0]['price'] + $drinks[1]['price'] + $drinks[2]['price'] + $drinks[3]['price'];
if($totalValue == NAN){
    $totalValue = 0;
}
*/
require 'form-view.php';
