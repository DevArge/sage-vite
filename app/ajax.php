<?php

namespace Branch\Ajax;

function example_ajax_func()
{
    // Protect against no ajaxt request
    if (! DOING_AJAX ) return return_json('error');

    // Get the post id from the request
    $name = $_POST['name'];
  
    // Return the response as json
    return_json(['greetings'=> 'Hello ' . $name]);

    wp_die();
}

function return_json( $status )
{
    // Add the Json content type header
    header("Content-Type: application/json");

    // Return the response as json
    // echo json_encode( $status );
    echo json_encode($status) . "\n\n";
}


