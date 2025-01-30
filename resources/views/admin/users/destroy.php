<?php
$user= db_find('users',request('id'));
redirect_if(empty($user),aurl('users'));

db_delete('users',request('id'));//to delete the record from the data base
//create a session for showing the sucess message after deletion
session('success',trans('admin.deleted'));
redirect(aurl('users'));//redirect  to the users page 
?>


