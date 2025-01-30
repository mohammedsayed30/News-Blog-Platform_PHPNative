<?php


/**
 * Retrieve a translation for the given key based on the application's current locale.
 *
 * This function resolves a translation key by loading the appropriate language file
 * based on the current locale stored in the session or the default configuration.
 * If the key is not found, it returns the key itself as a fallback.
 *
 * @param string|null $key The translation key in the format 'file.property', 
 *                         where 'file' is the language file and 'property' is the key inside the file.
 * @param string|null $default The fallback language code to use if no locale is set in the session. 
 *                             If null, the default or fallback language from the configuration is used.
 * 
 * @return string The translated string or the key if the translation is not found.
 */

if(!function_exists('trans')){
    function trans(string $key=null, string $default=null):string{
        $trans = explode('.', $key);//to make the file in index0 and property in index 1
        //if i set the language will use it if nut will use the default
        if(session_has('locale')){
            $default = session('locale');
        }
        else{
            $default = !empty(config('lang.default'))?config('lang.default'):config('lang.fallback');
        }
        $path = config('lang.path').'/'.$default.'/'.$trans[0].".php";
        if(file_exists($path)  && count($trans) > 0){ //to insure this file exist
            $result = include $path;//return the file
            return isset($result[$trans[1]])?$result[$trans[1]]:$key;//return the property(home) from this file
        }
        return '';

    }
}

/**
 * Sets the desired locale (language) for the application.
 *
 * This function stores the specified language in the session to be used 
 * as the locale for the application. The locale can later be retrieved 
 * from the session for language-based operations.
 *
 * @param string|null $lang The desired language code (e.g., 'en', 'fr'). 
 *                          If null, no locale is set.
 * 
 * @return void
 */

if(!function_exists('set_locale')){
    function set_locale(string $lang=null){
        session('locale',$lang);//set the desire language 
    }
}

