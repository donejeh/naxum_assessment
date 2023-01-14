<?php

class User {

    //global variables
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    //creating user function
    public function create($name,$dob,$address,$profile_picture,$card_name,
    $card_expire_month,$card_expire_year,$card_number,$card_cvv){

        try
        {
         $stmt = $this->db->prepare("INSERT INTO users (name,profile_picture,dob,address,card_name,card_number,card_cvv,card_expire_date)
             VALUES(:name, :profile_picture, :dob, :address,  :card_name, :card_number, :card_cvv, :card_expire_date)");

        $card_expire_date = $card_expire_month.'/'.$card_expire_year;

         $stmt->bindparam(":name",$name);
         $stmt->bindparam(":dob",$dob);
         $stmt->bindparam(":address",$address);
         $stmt->bindparam(":profile_picture",$profile_picture);
         $stmt->bindparam(":card_name",$card_name);
         $stmt->bindparam(":card_expire_date",$card_expire_date);
         $stmt->bindparam(":card_number",$card_number);
         $stmt->bindparam(":card_cvv",$card_cvv);
         $stmt->execute();

         return true;
        }
        catch(PDOException $e)
        {
         echo $e->getMessage();
         return false;
        }
    }

}







?>