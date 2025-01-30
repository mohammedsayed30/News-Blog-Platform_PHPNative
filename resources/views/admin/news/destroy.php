<?php
$news= db_find('news',request('id'));
redirect_if(empty($news),aurl('news'));
if(!empty($news['image'])){
    delete_file($news['image']); //to delete the file from the project
}
db_delete('news',request('id'));//to delete the record from the data base
//create a session for showing the sucess message after deleting
session('success',trans('admin.deleted'));
redirect(aurl('news'));//redirect  to the news page 
?>


