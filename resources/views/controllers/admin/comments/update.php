<?php
$data=validation([
    'name'=>'required|string',
    'news_id'=>'required|string|exist:news,id',
    'email'=>'required',
    'comment'=>'required|string',
    'status'=>'required|in:show,hide',
],[
    'name'=>trans('main.name'),
    'email'=>trans('main.email'), 
    'comment'=>trans('main.write_comment'), 
    'news_id'=>trans('main.news_id'), 
    'status'=>trans('main.status'), 
]);


response([
    'status'=>true,
    'message'=>'comment added',
]);
//find the row comment of this id based on id
$comment = db_find('comments',request('id'));
//if comment not exist will redirect to the comments page
redirect_if(empty($comment),aurl('comments'));
//to inser the values into the databases
db_update('comments',$data,request('id'));
//create a session for showing the sucess message after updating
session('success',trans('admin.updated'));
//redirect the user to the comments page
redirect(aurl('comments'));