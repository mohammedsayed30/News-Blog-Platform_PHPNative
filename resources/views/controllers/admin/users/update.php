<?php
$data=validation([
    'name'=>'required|string',
    'password'=>'',
    'email'=>'required|unique:users,email,'.request('id'),
    'mobile'=>'required|unique:users,mobile,'.request('id'),
    'user_type'=>'required|string|in:user,admin',
],[
    'name'=>trans('users.name'),
    'password'=>trans('users.password'), 
    'email'=>trans('users.email'), 
    'mobile'=>trans('users.mobile'), 
    'user_type'=>trans('users.user_type'), 
]);

if(!empty($data['password'])){
    $data['password']=bcrypt($data['password']);
}else{
    unset($data['password']);
}
db_update('users',$data,request('id'));
session_forget('old');

//create a session for showing the sucess message after updated
session('success',trans('admin.updated'));
//redirect the user to the news page
redirect(aurl('users'));


