<?php 

require_once "./includes/db.php";
include_once './classes/User.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST' && !isset($_POST['register'])){
 header("Location: index.php");
}

$user = new User($con);

$name = $_POST['name'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$card_name = $_POST['card_name'];
$card_expire_month = $_POST['card_expire_month'];
$card_expire_year = $_POST['card_expire_year'];
$card_number = $_POST['card_number'];
$card_cvv = $_POST['card_cvv'];
$profile_picture = $_FILES['profile_picture']['name'];


$errorMsg = array();

if ($name =='') {
    
    $errorMsg[] = "Name field is empty! <br>";
}

if ($dob =='') {
    
    $errorMsg[] = "Birth date field is empty! <br>";
}

if ($address =='') {
    
    $errorMsg[] = "Address field is empty! <br>";
}

if ($profile_picture =='') {
    
    $errorMsg[] = "Profile field can't empty! <br>";
}

if ($card_name =='') {
    
    $errorMsg[] = "Name field is empty! <br>";
}


if ($card_name =='' || $card_expire_month =='' || $card_expire_year =='' || $card_cvv ==''  ) {
    
    $errorMsg[] = "Please fill card information correctly! <br>";
}

if(!empty($errorMsg)){
    header("location: index.php");
    $_SESSION['message'] = $errorMsg;
    die();
}
   
   // var_dump($errorMsg);
    $profile_picture_temp = $_FILES['profile_picture']['tmp_name'];
    $profile_picture_size = $_FILES['profile_picture']['size'];
    move_uploaded_file($profile_picture_temp, "images/uploads/".$profile_picture);

    if($user->create($name,$dob,$address,$profile_picture,$card_name,
    $card_expire_month,$card_expire_year,$card_number,$card_cvv)){

        $errorMsg[] = "Account created successfully";

        header("location: index.php");
        $_SESSION['message'] =$errorMsg;
    }else{
        $errorMsg[] = "Error creating account try again";
        header("location: index.php");
        $_SESSION['message'] =$errorMsg;

    }


















?>