<?php
$data=validation([
    'title'=>'required|string',
    'category_id'=>'required',
    'image'=>'image',
    'description'=>'',
    'content'=>'required',
],[
    'title'=>trans('news.title'),
    'image'=>trans('news.image'), 
    'description'=>trans('news.description'), 
    'content'=>trans('news.content'), 
    'category_id'=>trans('news.category_id'), 
]);

$file_info=file_ext($data['image']);
if(!empty($data['image']['tmp_name'])){
    $data['image']=store_file($data['image'],'news/'.$file_info['hash_name']);
}else{
    unset($data['image']);
}
//$data['user_id']=auth()['id'];
$data['user_id']=auth()['id'];
$data['created_at']=date('Y-m-d h:i:s');
$data['updated_at']=date('Y-m-d h:i:s');
//to inser the values into the databases
db_insert('news',$data);
session_flash('old');
//create a session for showing the sucess message after creating
session('success',trans('admin.added'));
//redirect the user to the news page
redirect(aurl('news'));