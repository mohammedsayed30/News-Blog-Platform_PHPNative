<?php
$data=validation([
    'name'=>'required|string',
    'password'=>'required|string',
    'email'=>'required|email|unique:users,email',
    'mobile'=>'required|unique:users',
    'user_type'=>'required|string|in:user,admin',
],[
    'name'=>trans('users.name'),
    'password'=>trans('users.password'), 
    'email'=>trans('users.email'), 
    'mobile'=>trans('users.mobile'), 
    'user_type'=>trans('users.user_type'), 
]);



//to encrypt this password before insert it into the database
$data['password']=bcrypt($data['password']);
//to inser the values into the databases
db_insert('users',$data);
session_forget('old');
//create a session for showing the sucess message after creating
session('success',trans('admin.added'));
//redirect the user to the users page
redirect(aurl('users'));