<?php

include (__DIR__ . "/includes/functions.php");


// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');


// Request Method
$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET")
{

	if (isset($_REQUEST['word']) AND !empty($_REQUEST['word'])) {
		$word = $_REQUEST['word'];
		echo getWord($word);

	} else {
		$data = [
				"status"	=> 400,
				"message"	=> "Bad Request"
			];

		header("HTTP/1.0 400");
		echo json_encode($data, true);
	}

}
else
{
	$data = [
		"status"	=> 405,
		"message"	=> $requestMethod." Method Not Allowed"
	];

	header("HTTP/1.0 405");
	echo json_encode($data, true);
}
