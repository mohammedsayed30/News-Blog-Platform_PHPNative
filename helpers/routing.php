<?php
/**
 * this file used to recieved path and based on this path redirect the user 
 * to another path to handle not exist paths or restricted paths.
 * (mapping a URL segment to a corresponding view)
 */

//this  hold  all post and get requests
$routes = [];

/**
 * Registers a GET route with a specified URL segment and view.
 * 
 * This function adds a GET route definition to the global `$routes` array, 
 * mapping a URL segment to a corresponding view. The segment is 
 * automatically prefixed with the 'public' directory path.
 *
 * @param string $segment The URL segment for the route.
 * @param string|null $view The view associated with the route. Defaults to null.
 * @return void
 */
if(!function_exists('route_get')){
    function route_get($segment,$view=null){
        global $routes;
        $routes['GET'][] = [
            'view'=>$view,
            'segment'=>'/'.'public'.'/'.ltrim($segment,'/'),
        ];
    }
}

/**
 * Registers a POST route with a specified URL segment and optional view.
 *
 * This function adds a new POST route definition to the global `$routes` array. 
 * Each route maps a URL segment to an optional view. 
 * The URL segment is prefixed with the 'public' directory path.
 *
 * @param string $segment The URL segment for the route.
 * @param string|null $view The view associated with the route, or null if no view is specified.
 * @return void
 */
if(!function_exists('route_post')){
    function route_post($segment,$view=null){
        global $routes;
        $routes['POST'][] = [
            'view'=>$view,
            'segment'=>'/'.'public'.'/'.ltrim($segment,'/'),
        ];
    }
}

/**
 * Initializes and processes the registered GET and POST routes.
 *
 * This function checks the current request method 
 * (`GET` or `POST`) and the requested URL segment.
 * It then matches the segment with the defined routes in 
 * the `$routes` global array and triggers the appropriate view. 
 * If no matching route is found for a POST request, 
 * it sets the HTTP status code to 404.
 * 
 * For GET requests, it matches the segment and renders the associated view.
 * For POST requests, it checks if the `_method` POST parameter is set to 'post'
 *  and processes the corresponding routes.
 * 
 * If the segment is not found in any POST routes, it returns a 404 error page.
 * 
 * @return void
 */

if(!function_exists('route_init')){
    function route_init(){
        global $routes;
        $GET_ROUTES = isset($routes['GET'])?$routes['GET']:[];
        $POST_ROUTES = isset($routes['POST'])?$routes['POST']:[];
        if(!isset($_POST['_method'])){//for get requests
            /**there is for because there is manty get requests in  the  $GET_ROUTES 
             * but you  want only the current requst to mapping a URL segment to 
             * a corresponding view
             * */
            foreach($GET_ROUTES as $rget){
                if(segment() == $rget['segment']){
                    view($rget['view']);   //to check for existence of a file
                }
            }
        }


        if(isset($_POST) && isset($_POST['_method']) && count($_POST) > 0 && strtolower($_POST['_method'])=='post'){
            foreach($POST_ROUTES as $rpost){//post requests
                if(segment() == $rpost['segment']){
                    view($rpost['view']);   //to check for existence of a file
                }
            }
            //If the segment is not found in any POST routes, it returns a 404 error page.
            if( !is_null(segment()) && !in_array(segment(),array_column($POST_ROUTES,'segment'))){ //if the segment found
               //to change the status code of this page to 404
                http_response_code(404);
                view('404');
                exit();
            } 
        }
    }
}

/**
 * Redirects the user to a specified URL.
 *
 * This function checks whether the provided `$path` is a complete URL (i.e., it contains both a scheme and a host).
 * If it is a complete URL, the user will be redirected to the specified URL directly.
 * If it's a relative path, the function will prepend the base URL to the path before redirecting.
 * 
 * @param string $path The URL or relative path to redirect to.
 * @return void
 */

if(!function_exists('redirect')){
    function redirect($path){
        /**
         * The parse_url() function in PHP is used to parse a URL and 
         * return its components as an associative array. 
         * It splits the given URL into its parts like the scheme,
         *  host, port, path, query, and fragment
         */
        $check_path=parse_url($path);
        if(isset($check_path['scheme']) && isset($check_path['host'])){
            header('Location: '.$path);
        }else{
            //this mean the url not full url is relative url so this url function get the absolute url 
            header('Location: '.url($path));
        }
        exit();
    }

}


/**
 * Redirects the user to a specified URL if the given condition is true.
 *
 * This function checks the provided `$statement` (a boolean condition). 
 * If the condition evaluates to `true`,
 * it performs a redirect to the specified `$url`. If the condition is `false`, no action is taken.
 * 
 * @param bool $statement The condition to evaluate. If `true`, the user will be redirected.
 * @param string $url The URL to redirect the user to if the condition is `true`.
 * @return void
 */
if(!function_exists('redirect_if')){
    function redirect_if(bool $statement,string $url){
        if($statement){
            redirect($url);
        }
    }

}

/**
 * Redirects the user to the previous page.
 *
 * This function uses the `HTTP_REFERER` server variable, which typically contains 
 * the URL of the previous page from which the request was made.
 *  If the `HTTP_REFERER` is not available, this may not work as expected.
 * 
 * @return void
 */

if(!function_exists('back')){
    function back(){
        //HTTP_REFERER--->holds the previous  page
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    }
}


/**
 * Generates a full URL based on the provided segment.
 *
 * This function constructs a URL by checking if the connection is secure (HTTPS) or not (HTTP),
 * and then appends the provided segment to the base URL (usually the public directory of the application).
 *
 * @param string $segment The URL segment to append to the base URL.
 * 
 * @return string The full URL with the given segment.
 */
if(!function_exists('url')){
    function url($segment){
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on'?'https://':'http://';
        /**
         * $_SERVER['HTTP_HOST'] in PHP is a server-side superglobal variable that contains
         *  the hostname of the current request eg. 
         * If you visit a URL like https://www.example.com/path,
         *  this will output-->www.example.com
         */
        $url .= $_SERVER['HTTP_HOST'];
        $url.='/php/'.'public'.'/'.ltrim($segment,'/');
        return $url;
    }

}

/**
 * Generates a full URL based on the provided segment to 
 * access anything outside public directory or inside the php(project) directory.
 *
 * This function constructs a URL by checking if the connection is secure (HTTPS) or not (HTTP),
 * and then appends the provided segment to the base URL 
 * (which includes the '/php/' path prefix).
 *
 * @param string $segment The URL segment to append to the base URL.
 * 
 * @return string The full URL with the given segment.
 */
if(!function_exists('php_url')){
    function php_url($segment){
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on'?'https://':'http://';
        $url .= $_SERVER['HTTP_HOST'];
        $url.='/php/'.ltrim($segment,'/');
        return $url;

    }

}

/**
 * Generates a full URL based on the provided segment, including the 'admin' directory.
 *
 * This function constructs a URL by checking if the connection is secure (HTTPS) or not (HTTP),
 * and then appends the provided segment to the base URL with the '/php/public/{ADMIN}/' path prefix.
 *
 * @param string $segment The URL segment to append to the base URL (typically admin-related paths).
 * 
 * @return string The full URL with the given segment appended.
 */

if(!function_exists('aurl')){
    function aurl($segment){
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on'?'https://':'http://';
        $url .= $_SERVER['HTTP_HOST'];
        $url.='/php/'.'public'.'/'.ADMIN.'/'.ltrim($segment,'/');
        return $url;
    }
}

/**
 * Retrieves the current request URI segment excluding any query parameters.
 *
 * This function extracts the URI of the current request, removes any query parameters,
 * and formats it to return only the path segment. The segment is prefixed with '/p' for non-empty segments.
 * If the URI is empty or invalid, it returns '/'.
 *
 * @return string The path segment of the current request URI, formatted with a leading '/p' or '/' if empty.
 */

if(!function_exists('segment')){
    function segment(){
        /***
         * $_SERVER['REQUEST_URI'] is a PHP superglobal that contains the URI (Uniform Resource Identifier) 
         * of the current request. It is the part of the URL that comes after the domain name or IP address
         * eg.If the URL is: https://www.example.com/some/path?name=value&id=123
         * $_SERVER['REQUEST_URI'] would be-->/some/path?name=value&id=123
         */
        /*to get the full request URI without php page */
        $segment= ltrim($_SERVER['REQUEST_URI'],'/php');
        $removequeryParm = explode('?', $segment)[0]; //to remove special chars
        /*p for "p"ublic)*/
        return !empty($segment)?'/p'.$removequeryParm:'/';  //return the current request
    }
}