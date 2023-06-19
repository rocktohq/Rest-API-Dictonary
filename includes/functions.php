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
*   Encode data submitted by the user
*   This function will encode the data
*/
// Entities Encoding
function __e($data) {
    return htmlspecialchars($data);
}


/* 
*   Decode data
*   This function will decode the data
*/
// Entities Decoding
function __($data) {
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


/* 
*   Get the word's information
*   That user wants
*   Param @word
*/
// Get Word's Translation
function getWord($word) {
    global $con;
    $word = safeInput($word);
    
    // SQL QUERY
    $sql = "SELECT di_english_word, di_persian_word, di_word_description FROM `di_wordlist` WHERE `di_english_word` = '$word' OR `di_persian_word` = '$word'";
	$result = $con->query($sql);

    // If the QUERY is Executed
	if($result) {

        // If has information
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$data = [
				"status"	=> 200,
				"message"	=> "Success",
				"data"		=> [
                    "english_word"  => __e($row['di_english_word']),
                    "persian_word"  => __e($row['di_persian_word']),
                    "word_description"  => __e($row['di_word_description']),

                ]
			];

			header("HTTP/1.0 200 OK");
			return json_encode($data, true);

		}

        // If word not found in the database
		else {
			$data = [
				"status"	=> 404,
				"message"	=> "No Such Word Found!"
			];

			header("HTTP/1.0 404");
			return json_encode($data, true);
		}
	}

    // If the QUERY can't be executed
	else {
		$data = [
				"status"	=> 500,
				"message"	=> "Internal Server Error",
			];

		header("HTTP/1.0 500");
		return json_encode($data, true);
	}
}