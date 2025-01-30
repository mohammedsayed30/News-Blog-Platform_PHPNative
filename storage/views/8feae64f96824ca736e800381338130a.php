<?php
$data=validation([
    'name'=>'required|string',
    'news_id'=>'required|string|exist:news,id',
    'email'=>'required|email',
    'comment'=>'required|string',
],[
    'name'=>trans('main.name'),
    'email'=>trans('main.email'), 
    'comment'=>trans('main.write_comment'), 
    'news_id'=>trans('main.news_id'), 
],'api');

//to insert the comments  into the comments table
db_insert('comments',$data);
response([
    'status'=>true,
    'message'=>'comment added',
]);

