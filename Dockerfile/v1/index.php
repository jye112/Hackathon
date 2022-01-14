<?php
// Force errors to the console
ini_set('log_errors', '1');
// Force hiding of user facing errors
ini_set('display_errors', '0');

// Get environment variable APP_ENVIRONMENT and store it in the variable $environment.
$environment = getenv('APP_ENVIRONMENT', true);
$error_element = '<div class="alert alert-danger" role="alert">The application has failed to start - check the logs for more information!</div>';
$error_log = '';

// If the environment variable has not been set, return an internal server error.
if (!$environment) {
    http_response_code(500);
    $error_log = 'Failed to find an APP_ENVIRONMENT variable';
}
?>

<!doctype html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<div class="container">
<?php

if (http_response_code() != 200) {
    echo $error_element;
    throw new Exception($error_log); 
} else {
    echo 'Currently running in ' . $environment;
    echo '<br />';
    
    // Query our mock database using a hard coded connection string.
    $connection_string = 'https://azure-sprint-aks-functions.azurewebsites.net/api/MockDatabase?code=supersecret';
    $response_data     = file_get_contents($connection_string);
    $response          = json_decode($response_data);
    
    echo 'Retrieving first row from database : <b>' . $response[0]->value . '</b>';    
}
?> 
</div>

</html>