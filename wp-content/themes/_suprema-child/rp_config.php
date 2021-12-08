<?php

global $con;

global $databaseHost;

global $databaseName;

global $databaseUsername;

global $databasePassword;


/* test creadiational razorpay*/
/* $keyId = 'rzp_test_Z8ypIl4b5Zf561';
$keySecret = 'ZvbduUzh3rZla4zeT7QFENVI'; */

/* live crediatioal razorpay*/
$keyId = 'rzp_live_vza9eHCOggNrnU';
$keySecret = 'nDv5lLcalgMRsFsyzJl9HAWe';


define("BASE_URL", "https://lighthouserentals.mobilegiz.com/");

define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/");



error_reporting(E_ALL);

ini_set('display_errors', 1);





$databaseHost = 'localhost';

$databaseName = 'lighthouse_db';

$databaseUsername = 'lighthouse_user';

$databasePassword = '@5Bw4fl6';

 

$con = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);



function insert($table_name, $data)  

{  

    $string = "INSERT INTO ".$table_name." (";            

    $string .= implode(",", array_keys($data)) . ') VALUES (';            

    $string .= "'" . implode("','", array_values($data)) . "')";

    if(mysqli_query($GLOBALS['con'], $string))  

    {  

        return true;  

    }  

    else  

    {  

        echo mysqli_error($GLOBALS['con']);  

    }  

} 



function select($table_name)  

{  

    $array = array();  

    $query = "SELECT * FROM ".$table_name."";  

    $result = mysqli_query($GLOBALS['con'], $query);



    if($result){



        while($row = mysqli_fetch_assoc($result))  

        {  

                $array[] = $row;  

        }  

        return $array;



    }else{



        return 0;

    }   

} 



function select_where($table_name, $where_condition)  

{  

    $condition = '';  

    $array = array();  

    foreach($where_condition as $key => $value)  

    {  

        $condition .= $key . " = '".$value."' AND ";  

    }  

    $condition = substr($condition, 0, -5);  

    $query = "SELECT * FROM ".$table_name." WHERE " . $condition;



    $result = mysqli_query($GLOBALS['con'], $query);



    if($result){



        while($row = mysqli_fetch_array($result))  

        {  

                $array[] = $row;  

        }

        return $array;  



    }else{



    return 0;  

    

    }

    

}  

