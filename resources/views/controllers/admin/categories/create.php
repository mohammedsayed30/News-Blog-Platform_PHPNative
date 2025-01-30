<?php
$data=validation([
    'name'=>'required|string',
    'icon'=>'required|image',
    'description'=>'required',
],[
    'name'=>trans('cat.name'),
    'icon'=>trans('cat.icon'), 
    'description'=>trans('cat.desc'), 
]);

$file_info=file_ext($data['icon']);

$data['icon']=store_file($data['icon'],'categories/'.$file_info['hash_name']);
//var_dump($data['icon']);
//to inser the values into the databases
db_insert('categories',$data);
session_flash('old');
//create a session for showing the sucess message after creation
session('success',trans('admin.added'));
//redirect the user to the categories page
redirect(aurl('categories'));