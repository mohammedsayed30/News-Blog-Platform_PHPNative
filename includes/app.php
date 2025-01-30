<?php
ob_start();
// this just to include files from helpers folder
$helpers = ["bcrypt","request","routing","helper","AES","db","session","auth","mail","trans","validation","api","storage","view","media"];
foreach($helpers as $helper){
  include __DIR__."/../helpers/".$helper.".php";
}

//that is the location of the saved session (in storage/sessions) for more security
session_save_path(config('session.session_save_path'));
//to define and open the probability of session
ini_set('session.gc_probability', 1);
session_start([
  'cookie_lifetime'=>config('session.timeout')
]);

/*connecting with the database using mysqli extention*/
$connect = mysqli_connect(
    config('database_info.servername'),
    config('database_info.username'),
    config('database_info.password'),
    config('database_info.database'),
    config('database_info.port'),
  );
//this if the connection with the database faileds
if(!$connect){
  die("conection faild".mysqli_connect_error());
}




require_once base_path("/routes/web.php");
require_once base_path("/includes/execption_error.php");




