<?php
$data=validation([
    'name'=>'required|string',
    'email'=>'required|email',
    'password'=>'required',
    'mobile'=>'required|numeric',
],[
    'name'=>trans('main.name'),
    'email'=>trans('main.email'), 
    'password'=>trans('main.password'), 
    'mobile'=>trans('main.mobile'), 
]);

$data['user_type']='user';
//to insert the users that register  into the users table
db_insert('users',$data);
//create a session after he sign up  to get a user profile
session('user_profile','auth');
//create a session for showing the sucess message after registeration
session('success',trans('admin.registeration'));
redirect('/');

