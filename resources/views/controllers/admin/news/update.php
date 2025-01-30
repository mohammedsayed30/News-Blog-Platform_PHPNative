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
if(!empty($data['image']['tmp_name'])){
    $news= db_find('news',request('id'));
    redirect_if(empty($news),aurl('news'));
    //to delete the previous file first before store the new file
    delete_file($news['image']);
    $data['image']=store_file($data['image'],'news/'.file_ext($data['image'])['hash_name']);
}else{
    unset($data['image']);
}
//$data['user_id']=auth()['id'];
$data['updated_at']=date('Y-m-d h:i:s');
//to inser the values into the databases
db_update('news',$data,request('id'));
session_flash('old');
//create a session for showing the sucess message after updated
session('success',trans('admin.updated'));
//redirect the user to the news page
redirect(aurl('news'));


