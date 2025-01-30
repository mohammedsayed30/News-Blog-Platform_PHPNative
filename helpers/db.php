<?php


    /**************************************************************************************************
     * the operations CREAT,SELECT, DELETE, INSERT, and UPDATE primarily deal with rows in a table.
     ************************************************************************************************
     *  Inserts a new record into the specified database table and returns the inserted record.
     * 
     * This function dynamically constructs an SQL INSERT query using the provided table name
     * and data. It executes the query, retrieves the inserted record by its ID, and returns
     * the record as an associative array.
     * 
     * @param string $table The name of the database table where the data will be inserted.
     * @param array $data An associative array where keys are column names and values are the 
     *                    corresponding data to insert.
     * @return array The newly inserted record as an associative array with column names as keys.
     */
if(!function_exists('db_insert')){
    function db_insert(string $table,array $data):array{
        //the basic command to insert values into a table
        $sql="INSERT INTO ".$table;   
        $columns = ''; //to construct the columns names
        $values = ''; //to assign the values for these columns
        foreach($data as $key=>$value){
            $columns.=$key.",";           //contact all the columns names
            $values.=" '".$value."',";  //assign the values for these columns
        }
        $columns = rtrim($columns,",");//delete the last ,
        $values = rtrim($values,",");//delete the last ,
        $sql.=" (".$columns.") VALUES (".$values.")";//the final command for insertion
        $query = mysqli_query($GLOBALS['connect'],$sql);//to execute the insertion
        $id=mysqli_insert_id($GLOBALS['connect']);
        $frist=mysqli_query($GLOBALS['connect'],"select * from ".$table." where id=".$id);
        $GLOBALS['query']=$frist;
        return mysqli_fetch_assoc($frist);
    }
}

    /**
     * Updates an existing record in the specified database table and returns the updated record.
     * 
     * This function dynamically constructs an SQL UPDATE query using the provided table name,
     * data, and record ID. It executes the query, retrieves the updated record by its ID, and
     * returns the record as an associative array.
     * 
     * @param string $table The name of the database table where the record will be updated.
     * @param array $data An associative array where keys are column names and values are the 
     *                    corresponding data to update.
     * @param int $id The ID of the record to update.
     * @return array The updated record as an associative array with column names as keys.
     */

if(!function_exists('db_update')){
    function db_update($table,array $data,int $id):array{
        //the basic command to update values into a table
        $sql="UPDATE ".$table." SET ";   
        foreach($data as $key=>$value){
            $sql.=$key."='".$value."' , ";
        }
        $sql = rtrim($sql," , ");
        $sql.=" WHERE id=".$id;//the final command for insertion
        $query = mysqli_query($GLOBALS['connect'],$sql);//to execute the insertion
        $frist=mysqli_query($GLOBALS['connect'],"select * from ".$table." where id=".$id);
        $GLOBALS['query']=$frist;
        return mysqli_fetch_assoc($frist);
    }
}

    /**
     * Deletes a record from the specified database table based on its ID.
     * 
     * This function constructs and executes an SQL DELETE query to remove a record from the
     * specified table using the provided record ID.
     * 
     * @param string $table The name of the database table where the record will be deleted.
     * @param int $id The ID of the record to delete.
     * @return void
     */

if(!function_exists('db_delete')){
    function db_delete($table,int $id){
        //the basic command to delete  values into a table
        $sql="delete from ".$table." where id=".$id;   
        mysqli_query($GLOBALS['connect'],$sql);//to execute the deletion
        $GLOBALS['query']=$sql;
    }
}

    /**
     * Retrieves a record from the specified database table based on its ID.
     * 
     * This function constructs and executes a SQL SELECT query to fetch a single record from
     * the specified table using the provided record ID. It returns the record as an associative
     * array.
     * 
     * @param string $table The name of the database table from which to retrieve the record.
     * @param int $id The ID of the record to retrieve.
     * @return mixed The retrieved record as an associative array, or false if no record is found.
     */

if(!function_exists('db_find')){
    function db_find(string $table,int $id):mixed{
        //the basic command to retrieve  values into a table
        $sql="select * from ".$table." where id=".$id;   
        $query=mysqli_query($GLOBALS['connect'],$sql);//to execute the selection
        $GLOBALS['query']=$query;
        return mysqli_fetch_assoc($query);
    }
}

/**
 * Retrieves specific data from the specified database table based on the provided query.
 * 
 * This function constructs and executes a SQL SELECT query to fetch specific columns from
 * the specified table based on the provided selection (`$select`) and additional conditions (`$str_query`).
 * It returns a single record as an associative array.
 * 
 * @param string $select The columns to select (e.g., 'id, name, email').
 * @param string $table The name of the database table from which to retrieve the data.
 * @param string $str_query Additional query conditions (e.g., WHERE clause).
 * @return mixed The retrieved record as an associative array, or false if no record is found.
 */

if(!function_exists('db_first')){
    function db_first(string $table,string $str_query,string $select='*'):mixed{
        //the basic command to retrieve  values into a table
        $sql="select ".$select." from ".$table." ".$str_query;   
        $query=mysqli_query($GLOBALS['connect'],$sql);//to execute the selection
        $GLOBALS['query']=$query;
        /*This function fetches a single row of data from the result set 
        returned by a MySQL query.*/
        return mysqli_fetch_assoc($query);
    }
}

/**
 * Retrieves multiple rows of data from the specified database table based on the provided query.
 * 
 * This function constructs and executes a SQL SELECT query to fetch multiple rows from the specified
 * table based on the provided selection (`$select`) and additional conditions (`$str_query`). It returns
 * the query result and the number of rows retrieved.
 * 
 * @param string $table The name of the database table from which to retrieve the data.
 * @param string $str_query Additional query conditions (e.g., WHERE clause, ORDER BY, etc.).
 * @param string $select The columns to select (default is '*', which selects all columns).
 * @return array An associative array containing:
 *               - 'query': The query result resource.
 *               - 'num': The number of rows retrieved.
 */

if(!function_exists('db_get')){
    function db_get(string $table,string $str_query,string $select='*'):mixed{
        //the basic command to retrieve  multiples rows from a table
        $sql="select ".$select. " from ".$table." ".$str_query;
        $query=mysqli_query($GLOBALS['connect'],$sql);//to execute the selection
        $num=mysqli_num_rows($query);//to get the number of rows
        $GLOBALS['query']=$query;//to free memory after that
        return [
            'query'=>$query,
            'num'=>$num,
        ];
    }
}

/**
 * Generates the HTML for pagination links based on the total number of pages and any additional query parameters.
 * 
 * This function constructs pagination links for navigating between pages. It handles appending 
 * additional query parameters (e.g., filters or search terms) to the pagination URLs and highlights
 * the current page in the pagination links.
 * 
 * @param int $total_pages The total number of pages for pagination.
 * @param array $appends An associative array of additional query parameters to append to the pagination links.
 * @return string The HTML for the pagination links, or an empty string if there are no pages.
 */

if(!function_exists('render_paginate')){
    function render_paginate(int $total_pages,$appends):string{
        $request_str = ' ';
        if(!empty($appends) && count($appends)>0){
            foreach($appends as $k=>$val){
                $request_str .=$k.'='.$val.'&';
            }
            $request_str.='page=';
        }else{
            $request_str.='page=';
        }
 
        $html= '<ul class="pagination justify-content-center" dir="ltr">';
        /*this for previoius button if page==1 disable previos button 
        *if (int)request('page') > 1 reduce the page by one when you press previous button else make it=1
        */
        $p_disabled=empty(request('page')) || request('page')== 1?'disabled':'';
        $p_number=!empty(request('page')) && (int)request('page') > 1?(int)request('page')-1:1;
        $html.='<li class="page-item">
                  <a class="page-link '.$p_disabled.'" href="?'.$request_str.$p_number.'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>';
        for($i=1;$i<=$total_pages;$i++){
            $active=(!empty(request('page')) && request('page')== $i) || ($i==1 && empty(request('page'))) ?'active':'';
            $html.='<li class="page-item'.$active.'"><a href="?'.$request_str.$i.'" class="page-link">'.$i.'</a></li>';
        }
        $n_disabled=!empty(request('page')) && request('page')== $total_pages?'disabled':'';
        $n_number=!empty(request('page')) && (int)request('page') <  $total_pages?(int)request('page')+1:1;
        $html.='<li class="page-item '.$n_disabled.'">
                <a class="page-link" href="?'.$request_str.$n_number.'" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>';
        $html.='</ul>';
        return $total_pages>0 ?$html:'';
    }
}


/**
 * Retrieves a paginated set of records from a specified database table.
 * 
 * This function constructs and executes a SQL query to fetch a specific number of records from
 * a table, based on the current page and the specified limit. It also handles pagination by
 * calculating the total number of pages and rendering the pagination links.
 * 
 * @param string $table The name of the database table from which to retrieve the data.
 * @param string $str_query Additional query conditions (e.g., WHERE clause, ORDER BY, etc.).
 * @param int $limit The number of records to retrieve per page (default is 5).
 * @param string $orderby The order in which to retrieve records, either 'asc' or 'desc' (default is 'asc').
 * @param string $select The columns to select (default is '*', which selects all columns).
 * @param array|null $appends Additional query parameters to append to the pagination links.
 * @return array An associative array containing:
 *               - 'query': The query result resource.
 *               - 'num': The number of rows retrieved.
 *               - 'render': The HTML for the pagination links.
 *               - 'curent_page': The current page number (zero-indexed).
 *               - 'limit': The number of records per page.
 */

if(!function_exists('db_paginate')){
    function db_paginate(string $table,string $str_query,int $limit=5,string $orderby='asc',string $select='*',array $appends
=null):array{
        //to ensure that page is valid
        if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0){
            $current_page=$_GET['page']-1;
        }
        else{
            $current_page=0;
        } 

        //to get the number of the records
        /**
         * The result of a SELECT COUNT() query is not 
         * returned directly as a single value. Instead, it is returned as a row
         */
        $query_count=mysqli_query($GLOBALS['connect'],"select COUNT(".$table.".id) from ".$table." ".$str_query);
        /*mysqli_fetch_row turns the query result into an indexed array where the first (and only) 
        value is the count.*/
        $count_array=mysqli_fetch_row($query_count);
        $total_records=$count_array[0];//to get only the number of records
        //to get the start
        $start = $current_page * $limit;
        $total_pages=ceil($total_records / $limit);//no of pages
        //to handle invalid pages
        if($current_page >= $total_pages){
            $start=0;
        }
        //the basic command to retrieve  multiples rows from a table
        $sql="select ".$select." from ".$table." ".$str_query." order by ".$table.".id ".$orderby." LIMIT {$start},{$limit}";   
        $query=mysqli_query($GLOBALS['connect'],$sql);//to execute the selection
        $num=mysqli_num_rows($query);//to get the number of rows
        $GLOBALS['query']=$query;//to free memory after that
        return [
            'query'=>$query,
            'num'=>$num,
            'render'=>render_paginate($total_pages,$appends),
            'curent_page'=>$current_page,
            'limit'=>$limit
        ];
    }
}

/**
 * Disables the SQL strict mode `ONLY_FULL_GROUP_BY` for the MySQL connection.
 * 
 * This function executes a query to modify the global SQL mode and removes the `ONLY_FULL_GROUP_BY`
 * restriction, allowing queries with GROUP BY clauses to work without the strict requirement of 
 * grouping by all non-aggregated columns.
 * 
 * @return void
 */

if(!function_exists('db_setting_strict')){
    function db_setting_strict(){
        mysqli_query($GLOBALS['connect'],"SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");//to execute the deletion    
    }
}

