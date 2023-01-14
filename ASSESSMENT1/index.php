<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naxum Register Page</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container">
<img src="./images/logo.png" >
  <div class="title">Registration Form </div>
  <?php

  if (isset($_SESSION['message']) && $_SESSION['message']) {
    
    foreach ($_SESSION['message'] as $key => $value) {
        echo "<span style='color:red;'>".$value."</span>" ;
    }
    $_SESSION['message'] = '';


  }
  ?>
  <form action="register.php" method="POST" enctype="multipart/form-data" >
    <div class="user__details">
      <div class="input__box">
        <span class="details">Name</span>
        <input type="text" placeholder="Innocent Ejeh" name="name" >
      </div>
      <div class="input__box">
        <span class="details">Birthdate</span>
        <input type="date" placeholder="" name="dob" >
      </div>
      <div class="input__box">
        <span class="details">  Complete Address</span>
        <textarea name="address" id="" cols="30" rows="3"></textarea>
      </div>
      <div class="input__box">
        <span class="details">Profile Picture</span>
        <input type="file" pattern="" name="profile_picture" placeholder="" >
      </div>
      <div class="input__box">
        <span class="details">Name on Card</span>
        <input type="text" name="card_name" placeholder="Don Ejeh" >
      </div>

    
      <div class="input__box">
        <span class="details">Card Number</span>
        <input type="number"  maxlength="3" placeholder="522223112" name="card_number" >
      </div>



      <div class="gender__details">
        <span class="details">Expire Day</span>
        <select name="card_expire_month" id="" style="width:100px">
            <?php
                for ($i=1; $i <=12 ; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
            ?>
        </select>
        <span class="details">Expire Month</span>

        <select name="card_expire_year" id="" style="width:100px">
            <?php
                $today = date('Y');
                for ($i=$today; $i <=2030 ; $i++) { 
                    echo "<option value='$i'>$i</option>";
                }
            ?>
        </select>
        <span class="details">CVV</span>
        <input type="text" style="width:100px" maxlength="3" name="card_cvv" placeholder="232" >
      </div>
    </div>
    <div class="button">
      <input type="submit" name="register" value="Register">
    </div>
  </form>
</div>
</body>
</html>
</form>
</body>
</html>