<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents('php://input');
    
    if ($jsonData) {
        $file = 'askme.json';

        // Check if the file exists, if not create it
        if (!file_exists($file)) {
            file_put_contents($file, json_encode([]));
        }

        // Decode the existing data
        $existingData = json_decode(file_get_contents($file), true);

        // Merge the new data with existing data
        $newData = json_decode($jsonData, true);
        $mergedData = array_merge_recursive($existingData, $newData);

        // Save the merged data back to the file
        file_put_contents($file, json_encode($mergedData, JSON_PRETTY_PRINT));
    }
}
?>
