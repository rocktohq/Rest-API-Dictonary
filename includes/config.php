<?php
	
	/*
	#	Online Dictionary
	#	Design & Developed by Saidul Mursalin
	#	Cell: +8801716-685459
    #   Facebook: fb.me/itzmonir
    #
    #   Configuration
	*/
	
	// Database Credentials
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'dictionray');
	define("DB_USERNAME", 'root');
	define('DB_PASSWORD', '');


    // Website Information
	define('SITE_NAME', 'English to Bengali Dictionary');
	define('SITE_URL', 'http://localhost/projects/dictionary/');
	
	
	// Let's try to Connect
	$con = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

	// If there is any Error
	if($con -> connect_errno)
    {
		// Error Message
	  	echo "Failed to connect the Database: " . $con -> connect_error;

		// Storing the Error Log for Future Investigation
		$errordate = date("F j, Y, g:i a");
		$message = "{$errordate} || {$con -> connect_error}\r\n";
		file_put_contents("error-log.txt", $message, FILE_APPEND);
		exit();
		
	}