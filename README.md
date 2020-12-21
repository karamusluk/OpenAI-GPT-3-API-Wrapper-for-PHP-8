# OpenAI GPT-3 API Wrapper for PHP 8
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://opensource.org/licenses/MIT)

PHP 8 Wrapper for OpenAI GPT-3 API.

Example usage:

```php
<?php

require_once "../OpenAI.php";

$instance = new OpenAI(secretKey: 'Bearer <API_KEY>');

$prompt = "The following is a conversation with an AI assistant. The assistant is helpful, creative, clever, and very friendly.

Human: Hello, who are you?
AI: I am an AI created by OpenAI. How can I help you today?
Human: ";

$instance->setDefaultEngine("ada"); // by default it is davinci
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

echo $res;
?>
```

Please check all [examples](/examples).

## Requirements
You need to give Open AI API key to the contructor as follows;
```php
$instance = new OpenAI(secretKey: "Bearer <API_KEY>");
```
or
```php
$instance = new OpenAI('Bearer <API_KEY>');
```

If you want to change the engine upon instance initialization;

```php
$instance = new OpenAI(defaultEngine: "ada");
```

## License

OpenAI GPT-3 API Wrapper for PHP 8 is released under the
[MIT License](http://www.opensource.org/licenses/MIT).
