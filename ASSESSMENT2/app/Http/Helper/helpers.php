<?php

use Illuminate\Support\Facades\DB;

//Get user Distributor
function getDistributor($id) {
    $user = DB::table('users')->join('user_category', 'users.id', '=', 'user_category.user_id')->where('users.id', $id)->first();

    if(!is_null($user) && $user->category_id ==1){
        $parent = DB::table('users')->where('id',$user->id)->first();

        if(!is_null($parent)){

            return "$parent->first_name $parent->last_name";
        }else{

            return "";
        }
    }else{
    return "";
    }
  }

  // get Distributor Count helper function
  function getTotalDistributorCount($id){
    $user = DB::table('users')->join('user_category', 'users.id', '=', 'user_category.user_id')->where('id', $id)->first();
   
    if(!is_null($user) && $user->category_id ==1){
        $count = DB::table('users')->where('referred_by',$user->user_id)->count();

     return $count;
   
    }else{
    return 0;
    }
  }


  // this helper function getPercentage
  function getPercentage($id){
     
    $users = DB::table('users')->where('referred_by',$id)->get();

      $count= 0;
      if(!is_null($users)){
          
          foreach ($users as $key => $user) {
            $user = DB::table('user_category')->where('user_id', $user->id)->first(); 
            if($user->category_id==2){
                $count = $count +1;
            }
        }
 
     if ($count==0) {
        return 5;
     }else if($count >=5 && $count <=10 ){
        return 10;
    
    }else if($count >=11 && $count <=20 ){
        return 15;
    
    }else if($count >=21 && $count <=30 ){
        return 20;
     }else if($count >=31 ){
        
        return 30;

     }
   
    }else{
    return 0;
    }
  
  }

  // for pagination 
  function getPaginate($paginate = 5)
  {
      return $paginate;
  }