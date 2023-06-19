<?php

include __DIR__. '/includes/functions.php';


// If the form is submitted
if(isset($_GET['word'])) {
    
    $word = safeInput($_GET['word']);
    $siteTitle = ucfirst($word);
    $apiUrl = SITE_URL."api/?word=".$word;
    
    $curl_handle=curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $apiUrl);
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
    $query = curl_exec($curl_handle);
    $response = curl_getinfo($curl_handle);
    curl_close($curl_handle);

    echo "<pre>";
    print_r(json_decode($query, true));
    echo "</pre>";
    
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($siteTitle) ? $siteTitle : SITE_NAME); ?></title>
</head>
<body>

    <form action="" method="get">
        <input type="text" name="word" id="word" placeholder="EX: Home">
        <button type="submit">Search</button>
    </form>
    
</body>
</html>