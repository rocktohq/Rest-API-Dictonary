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
    
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($siteTitle) ? $siteTitle : SITE_NAME); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head">
                            <h1 class="text-center text-muted">English to Persian Dictionary</h1>
                        </div>
                        <div class="card-body">
                            <form action="" method="GET">
                                <div class="input-group">
                                    <input class="form-control p-3" type="text" name="word" id="word" placeholder="EX: Home" value="<?php echo (isset($_GET['word']) ? $_GET['word'] : ''); ?>" aria-label="Enter a Word" aria-describedby="button-addon2">
                                
                                    <button type="submit" id="button-addon2" class="btn btn-primary p-3">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <h2 class="text-center"><span class="text-muted">Information:</span></h2>
                            <p>
                                <?php   
                                    echo "<pre>";
                                    print_r(json_decode($query, true));
                                    echo "</pre>"; 
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>