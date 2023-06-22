<?php

include_once (dirname(__DIR__ , 2) . "/includes/config.php");
include_once (dirname(__DIR__ , 2) . "/includes/functions.php");


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
				"data"		=> [
                    "english_word"  => __($row['di_english_word']),
                    "persian_word"  => __($row['di_persian_word']),
                    "word_description"  => __($row['di_word_description']),

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