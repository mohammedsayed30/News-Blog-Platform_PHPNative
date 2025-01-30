<?php
$data=validation([
    'email'=>'required|string',
    'password'=>'required',
],[
    'email'=>trans('main.email'),
    'password'=>trans('main.password'), 
]);

//var_dump(bcrypt($data['password']));
$login=db_first('users',"where email like'%".$data['email']."%'");

//to check if the user is admin or not and the infos is correct

if(empty($login)  || (!hash_check($data['password'],$login['password'])) || $login['user_type']!='user'){
    //this mean the email not exist or the password is wrong
    session('error_login',trans('admin.login_failed'));
    redirect('user/sign_in');
    
}else{
    session_forget('error_login');
    //this mean the login is valid
    session('user_profile', json_encode($login));
    redirect('profile');
}