<?php
class OpenAI{

    function __construct(
        public $secretKey = 'Bearer <API_KEY>',
        public $baseURL = "https://api.openai.com/v1/",
        private $defaultEngine = "davinci" // ada, babbage, "content-filter-alpha-c4, "content-filter-dev, curie, cursing-filter-v6,
    ) {}

    public function setDefaultEngine(string $defaultEngine): void{
        $this->defaultEngine = $defaultEngine;
    }

    public function _curl(string $url, string $type = "POST", string $postFields = ""): array|stdClass|string {
        $url = $this->baseURL . $url;
        $curl = curl_init();
        $curlOpts = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: ' . $this->secretKey
            ],
        ];
        if($type == "POST"){
            $curlOpts[CURLOPT_CUSTOMREQUEST] = "POST";
            $curlOpts[CURLOPT_POSTFIELDS] = $postFields;
        }
        curl_setopt_array($curl, $curlOpts);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $err ? ["error" => "Error #:" . $err ] : json_decode($response);
    }

    private function _removeUnfinishedSentence(string $str):string {
        return preg_replace("/\.[^.]+$/", "", $str) ?? $str;
    }

    public function search(array $documents, $query): array|stdClass|string {

        $request_body = [
            "max_tokens" => 10,
            "temperature" => 0.7,
            "top_p" => 1,
            "presence_penalty" => 0.75,
            "frequency_penalty"=> 0.75,
            "documents" => $documents,
            "query" => $query
        ];

        $postFields = json_encode($request_body);


        return $this->_curl(url: "engines/" . $this->defaultEngine . "/search", postFields: $postFields );
    }

    public function complete(string $prompt, int|string $max_tokens = 5, array|null $parameters = null, bool $returnResult = false, bool $json = false): array|stdClass|string {
        $request_body = [
            "prompt" => $prompt,
            "max_tokens" => $max_tokens,
            "temperature" => 0.7,
            "top_p" => 1,
            "presence_penalty" => 0.75,
            "frequency_penalty"=> 0.75,
            "best_of"=> 1,
            "stream" => false,
        ];

        if(!empty($parameters))
            $request_body = array_merge($request_body, $parameters);

        $postFields = json_encode($request_body);

        $result = $this->_curl(url: "engines/" . $this->defaultEngine . "/completions", postFields: $postFields );
        return $returnResult ? ($json ? json_encode($result) : $result) : $this->_removeUnfinishedSentence($prompt . ($result?->choices[0]?->text ?? ""));

    }
}
