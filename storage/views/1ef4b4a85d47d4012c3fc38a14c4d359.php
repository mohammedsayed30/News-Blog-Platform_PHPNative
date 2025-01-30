<?php
$data=validation([
    'email'=>'required|email',
    'password'=>'required',
    'remember_me'=>'',
],[
    'email'=>trans('admin.email'),
    'password'=>trans('admin.password'), 
]);

//var_dump(bcrypt($data['password']));
$login=db_first('users',"where email like'%".$data['email']."%'");

//to check if the user is admin or not and the infos is correct

if(empty($login)  || (!hash_check($data['password'],$login['password'])) || $login['user_type']!='admin'){
    //this mean the email not exist or the password is wrong
    session('error_login',trans('admin.login_failed'));
    redirect(ADMIN.'/login');
    
}else{
    //this mean the login is valid
    session('admin', json_encode($login));
    redirect(ADMIN);
}
