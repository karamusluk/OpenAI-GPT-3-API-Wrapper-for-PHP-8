<?php

require_once "../OpenAI.php";

$instance = new OpenAI(secretKey: 'Bearer <API_KEY>');

$prompt = "English: I do not speak French.
French: Je ne parle pas français.

English: See you later!
French: À tout à l'heure!

English: Where is a good restaurant?
French: Où est un bon restaurant?

English: What rooms do you have available?
French: Quelles chambres avez-vous de disponible?

English: ";

header('Content-Type: application/json');
echo $instance->complete(
    $prompt,
    100,
    [
        "stop"              => ["\n"],
        "temperature"       => 0.5,
        "start_text"        => "\nFrench:",
        "restart_text"      => "\n\nEnglish: "
    ]
);
