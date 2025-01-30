<?php
/**
 * Renders a view to display an image.
 * 
 * This function is used to display an image by rendering a view 
 * template and passing the image URL to it.
 *
 * @param string $url The URL of the image to be displayed.
 * @return void
 */

if(!function_exists('image')){
    function image($url){
        view('admin.actions.view_image',['image'=>$url]);
    }
}
/**
 * Renders a view to confirm the deletion of a record.
 * 
 * This function is used to display a form for confirming the deletion of
 *  a record by rendering a view template and passing the URL for the deletion action.
 *
 * @param string $url The URL for the deletion action.
 * @return void
 */
if(!function_exists('delete_record')){
    function delete_record($url){
        view('admin.actions.destory_form',['url'=>$url]);
    }
}