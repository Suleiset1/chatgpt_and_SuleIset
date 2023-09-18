<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $api_key = "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";
    $prompt = $_POST['prompt'];

    $stop = array(" Human:", " AI:");
    $data = array(
        "model" => "text-davinci-003",
        "prompt" => $prompt,
        "temperature" => 0.9,
        "max_tokens" => 500,
        "top_p" => 1,
        "frequency_penalty" => 0,
        "presence_penalty" => 0.6,
        "stop" => $stop
    );

    $payload = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/engines/davinci/completions'); // Endpoint'i güncelledik
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    ));
    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);
    echo json_encode($response);
}
?>