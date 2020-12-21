<?php

require_once "../OpenAI.php";

$instance = new OpenAI(secretKey: 'Bearer <API_KEY>');

$prompt = "The following is a conversation with an AI assistant. The assistant is helpful, creative, clever, and very friendly.

Human: Hello, who are you?
AI: I am an AI created by OpenAI. How can I help you today?
Human: ";

$res = $instance->complete(
    $prompt,
    150,
    [
        "stop"              => ["\n"],
        "temperature"       => 0.9,
        "frequency_penalty" => 0.6,
        "start_text"        => "\nAI:",
        "restart_text"      => "\nHuman: "
    ]
);
