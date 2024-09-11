<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $recipient = $data['untuk'] ?? '';
    $question = $data['question'] ?? '';
    $timestamp = $data['timestamp'] ?? '';

    // Save data to a JSON file
    $file = 'askme.json';
    if (file_exists($file)) {
        $json = json_decode(file_get_contents($file), true);
    } else {
        $json = [];
    }

    if (!isset($json[$recipient])) {
        $json[$recipient] = [];
    }

    $json[$recipient][] = [
        'question' => $question,
        'timestamp' => $timestamp
    ];

    file_put_contents($file, json_encode($json, JSON_PRETTY_PRINT));
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
