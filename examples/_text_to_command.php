<?php

require_once "../OpenAI.php";

$instance = new OpenAI(secretKey: 'Bearer <API_KEY>');

$prompt = "Q: Ask Constance if we need some bread
A: send-msg `find constance` Do we need some bread?
Q: Send a message to Greg to figure out if things are ready for Wednesday.
A: send-msg `find greg` Is everything ready for Wednesday?
Q: Ask Ilya if we're still having our meeting this evening
A: send-msg `find ilya` Are we still having a meeting this evening?
Q: Contact the ski store and figure out if I can get my skis fixed before I leave on Thursday
A: send-msg `find ski store` Would it be possible to get my skis fixed before I leave on Thursday?
Q: Thank Nicolas for lunch
A: send-msg `find nicolas` Thank you for lunch!
Q: Tell Constance that I won't be home before 19:30 tonight — unmovable meeting.
A: send-msg `find constance` I won't be home before 19:30 tonight. I have a meeting I can't move.
Q: ";

header('Content-Type: application/json');
echo $instance->complete(
    $prompt,
    100,
    [
        "stop"              => ["\n"],
        "temperature"       => 0.5,
        "frequency_penalty" => 0.2,
        "start_text"        => "\nA:",
        "restart_text"      => "\nQ:"
    ]
);
