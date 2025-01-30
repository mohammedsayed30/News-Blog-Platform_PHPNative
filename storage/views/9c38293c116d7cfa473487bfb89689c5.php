<?php
$comment= db_find('comments',request('id'));
//redirect the user or admin if this comment not exist anymore
redirect_if(empty($comment),aurl('comments'));
db_delete('comments',request('id'));//to delete the record from the data base
//show the success message after deletion if the deleted operation done
session('success',trans('admin.deleted'));
redirect(aurl('comments'));//redirect  to the comments page 
?>


