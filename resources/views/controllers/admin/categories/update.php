<?php
$data=validation([
    'name'=>'required|string',
    'icon'=>'image',
    'description'=>'required',
],[
    'name'=>trans('cat.name'),
    'icon'=>trans('cat.icon'), 
    'description'=>trans('cat.desc'), 
]);
if(!empty($data['icon']['tmp_name'])){
    $categore= db_find('categories',request('id'));
    redirect_if(empty($categore),aurl('categories'));
        //to delete the previous file first before store the new file
    delete_file($categore['icon']);
    $data['icon']=store_file($data['icon'],'categories/'.file_ext($data['icon'])['hash_name']);
}else{
    unset($data['icon']);
}
//to inser the values into the databases
db_update('categories',$data,request('id'));
//create a session for showing the sucess message after updating
session('success',trans('admin.updated'));
//redirect the user to the categories page
redirect(aurl('categories'));