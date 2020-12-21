<?php

require_once "../OpenAI.php";

$instance = new OpenAI(secretKey: 'Bearer <API_KEY>');

$prompt = "Non-standard English: Please provide me with a short brief of the design you’re looking for and that’d be nice if you could share some examples or project you did before.
Standard American English: Please provide me with a short brief of the design you’re looking for and some examples or previous projects you’ve done would be helpful.

Non-standard English: If I’m stressed out about something, I tend to have problem to fall asleep.
Standard American English: If I’m stressed out about something, I tend to have a problem falling asleep.

Non-standard English: There is plenty of fun things to do in the summer when your able to go outside.
Standard American English: There are plenty of fun things to do in the summer when you are able to go outside.

Non-standard English: She no went to the market.
Standard American English: She didn't go to the market.

Non-standard English: ";

header('Content-Type: application/json');
echo $instance->complete(
    $prompt,
    120,
    [
        "stop"              => ["\n"],
        "temperature"       => 1,
        "frequency_penalty" => 0.7,
        "start_text"        => "\nStandard American English:",
        "restart_text"      => "\n\nNon-standard English:"
    ]
);
