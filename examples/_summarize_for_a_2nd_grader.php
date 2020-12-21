<?php

require_once "../OpenAI.php";

$instance = new OpenAI(secretKey: 'Bearer <API_KEY>');

$prompt = "My second grader asked me what this passage means:
\"\"\"
";

header('Content-Type: application/json');
echo $instance->complete(
    $prompt,
    100,
    [
        "stop"              => ["\n"],
        "temperature"       => 0.5,
        "frequency_penalty" => 0.2,
        "start_text"        => "\n\"\"\"\nI rephrased it for him, in plain language a second grader can understand:\n\"\"\"\n",
    ]
);
