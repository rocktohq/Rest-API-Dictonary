<?php

include_once (__DIR__ . "/config.php");


/* 
*   Sanitize data submitted by the user
*   This function will only excape the data
*/
// Sanitize Input
function safeInput($data, $encoding = true) {
	global $con;
	$data = trim($data);
    if($encoding === true) {
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    }
	$data = mysqli_real_escape_string($con, $data);
	return $data;
}


/* 
*   Encode data submitted by the user
*   This function will encode the data
*/
// Entities Encoding
function safeEntities($data) {
    return htmlentities($data, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
}


/* 
*   Safe printing data from database
*   This function will safely print data from database
*/
// Safe Print
function __($data) {
    return htmlspecialchars($data);
}


/* 
*   Decode data
*   This function will decode the data
*/
// Entities Decoding
function __d($data) {
    return html_entity_decode($data);
}


/* 
*   Validate ID submitted by the user
*   This function will validate ID
*/
// Validate ID
function validateId($id) {
	if(preg_match('/^\\d+$/', $id)) {
		return true;
	}
}