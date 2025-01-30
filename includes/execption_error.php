<?php
//get the segment(path of uri) of post and get requests
//$POST_ROUTES = isset($routes['POST'])?$routes['POST']:[];
$GET_ROUTES = isset($routes['GET'])?$routes['GET']:[];
/**
 * execption handling url pages
 */
if(!isset($_POST['_method']) && !is_null(segment()) && !in_array(segment(),array_column($GET_ROUTES,'segment'))){ //if the segment found
    // $storage_segment = str_replace('/'.'public'.'/','',segment());
    // if(preg_match('/^storage/i',$storage_segment)){
    //     storage($storage_segment);
    // }else{

    // }
    //to change the status code of this page to 404
    http_response_code(404);
    view('404');
    exit();

}
else{ //if the segment nog found 
    //echo "Page Found";
}



    