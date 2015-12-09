<?php

/**
 * Description of productsModule
 *
 * @author jvicentem 
 */

include_once('../../database/dbFunctions.inc');

$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

$jTableResult = array();

switch ($action) {
    case "productsList":
        $rows = productsList();
        $jTableResult['Result'] = "OK";
        $jTableResult['Records'] = $rows;
        
        break;
    case "addProduct":
        $res = addProduct(
                filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING),
                filter_input(INPUT_POST, "precio", FILTER_SANITIZE_STRING)
                );
        //Return result to jTable
        if ($res) {
            $jTableResult['Result'] = "OK";
            $jTableResult['Record'] = productsList();
        } else {
            $jTableResult['Result'] = "ERROR";
        }
        
        break;
    case "modifyProduct":
        $res = modifyProduct(
                filter_input(INPUT_POST, "IDP", FILTER_SANITIZE_STRING),
                filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING),
                filter_input(INPUT_POST, "precio", FILTER_SANITIZE_STRING)
                );
        //Return result to jTable
        if ($res) {
            $jTableResult['Result'] = "OK";
        } else {
            $jTableResult['Result'] = "ERROR";
        }
        
        break;        
    case "removeProduct": 
        $res = removeProduct(filter_input(INPUT_POST, "IDP", FILTER_SANITIZE_STRING));
   
        if ($res) {
            $jTableResult['Result'] = "OK";
        } else {
            $jTableResult['Result'] = "ERROR";
        }   
        
        break;
}

print json_encode($jTableResult);

