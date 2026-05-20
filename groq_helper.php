<?php
// groq_helper.php
// Optimized Helper functions to interact with Groq API for spam detection.

function check_spam_groq(array $payload, string $model = 'openai/gpt-oss-120b', float $threshold = 0.5): bool {
    $apiKey = getenv('GROQ_API_KEY');
    if (!$apiKey) {
        error_log('GROQ_API_KEY not set in environment.');
        return false; // Fail open - do not block users if API key is missing.
    }

    $url = 'https://api.groq.com/openai/v1/chat/completions';
    
    // Clear and extremely strict prompt to minimize response token size and latency
    $systemPrompt = "You are a spam filter. Evaluate if the form submission is spam. Output JSON: {\"spam_score\": float} (0.0 to 1.0). Output ONLY the raw JSON.";

    $messages = [
        ['role' => 'system', 'content' => $systemPrompt],
        ['role' => 'user', 'content' => json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)]
    ];

    $postData = [
        'model' => $model,
        'messages' => $messages,
        'temperature' => 0.0,
        'max_tokens' => 20, // Keep tokens low for faster response
        'response_format' => ['type' => 'json_object'] // Request JSON mode if supported
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Authorization: Bearer $apiKey",
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_TIMEOUT, 3); // 3-second timeout limit to prevent hanging

    $response = curl_exec($ch);
    $err = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($err) {
        error_log('Groq API curl error: ' . $err);
        return false; // Fail open
    }

    if ($httpCode !== 200) {
        error_log('Groq API returned HTTP status code: ' . $httpCode . ' Response: ' . $response);
        return false; // Fail open
    }

    $decoded = json_decode($response, true);
    if (!isset($decoded['choices'][0]['message']['content'])) {
        error_log('Unexpected Groq API response: ' . $response);
        return false; // Fail open
    }

    $content = trim($decoded['choices'][0]['message']['content']);
    
    // Clean potential markdown wrappers
    if (strpos($content, '```') === 0) {
        $content = preg_replace('/^```(?:json)?\s*|```\s*$/i', '', $content);
    }
    
    $scoreObj = json_decode($content, true);
    if (!isset($scoreObj['spam_score'])) {
        error_log('Failed to parse spam_score from Groq response content: ' . $content);
        return false; // Fail open
    }

    $spamScore = floatval($scoreObj['spam_score']);
    return $spamScore >= $threshold;
}
?>
