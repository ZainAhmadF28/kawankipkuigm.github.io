<?php
// Get the existing data from the JSON file
$jsonData = file_get_contents('askme.json');
$dataArray = json_decode($jsonData, true);

// Get the POST data sent by the JavaScript
$postData = json_decode(file_get_contents('php://input'), true);

// Add the new data to the existing array
$dataArray[] = $postData;

// Save the updated array back to the JSON file
file_put_contents('askme.json', json_encode($dataArray, JSON_PRETTY_PRINT));

// Return a success response
echo json_encode(['status' => 'success']);
?>
