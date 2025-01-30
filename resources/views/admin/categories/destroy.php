<?php
$categore= db_find('categories',request('id'));
redirect_if(empty($categore),aurl('categories'));
if(!empty($categore['icon'])){
    delete_file($categore['icon']); //to delete the file from the project
}
db_delete('categories',request('id'));//to delete the record from the data base
session('success',trans('admin.deleted'));
redirect(aurl('categories'));//redirect  to the categories page 
?>


