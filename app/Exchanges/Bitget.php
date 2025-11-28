<?php

namespace App\Exchanges;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Bitget
{
    private string $apiKey;
    private string $secretKey;
    private string $passphrase;
    private string $baseUrl;
    private Client $http;

    public function __construct(
        string $apiKey,
        string $secretKey,
        string $passphrase,
        string $baseUrl = 'https://api.bitget.com'
    ) {
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
        $this->passphrase = $passphrase;
        $this->baseUrl = rtrim($baseUrl, '/');

        $this->http = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 10,
        ]);
    }

    /**
     * 測試連線
     *
     * @return bool
     */
    public function check(): bool
    {
        $response = $this->request('GET', '/api/v2/spot/account/info');

        if (($response['code'] ?? null) !== '00000') {
            throw new \RuntimeException('Bitget API error: ' . ($response['msg'] ?? 'unknown'));
        }

        return true;
    }

    /**
     * 共用底層 Request
     *
     * @throws \RuntimeException
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $method    = strtoupper($method);
        $timestamp = (string) intval(microtime(true) * 1000); // 官方要求毫秒時間戳:contentReference[oaicite:3]{index=3}

        $queryString = http_build_query($query, '', '&', PHP_QUERY_RFC3986);
        $bodyString  = $body ? json_encode($body, JSON_UNESCAPED_SLASHES) : '';

        // 符合官方簽名規則：
        // timestamp + method.toUpperCase() + requestPath [+ "?" + queryString] + body:contentReference[oaicite:4]{index=4}
        $signPayload = $timestamp . $method . $path;
        if ($queryString !== '') {
            $signPayload .= '?' . $queryString;
        }
        $signPayload .= $bodyString;

        $signature = base64_encode(
            hash_hmac('sha256', $signPayload, $this->secretKey, true)
        );

        $headers = [
            'ACCESS-KEY' => $this->apiKey,
            'ACCESS-SIGN' => $signature,
            'ACCESS-TIMESTAMP' => $timestamp,
            'ACCESS-PASSPHRASE' => $this->passphrase,
            'Content-Type' => 'application/json',
            'locale' => 'en-US',
        ];

        $options = [
            'headers' => $headers,
        ];

        if ($queryString !== '') {
            $options['query'] = $query;
        }

        if ($bodyString !== '') {
            $options['body'] = $bodyString;
        }

        try {
            $response = $this->http->request($method, $path, $options);
        } catch (GuzzleException $e) {
            throw new \RuntimeException('Bitget HTTP error: ' . $e->getMessage(), 0, $e);
        }

        $contents = (string) $response->getBody();
        $json     = json_decode($contents, true);

        if (!is_array($json)) {
            throw new \RuntimeException('Bitget API invalid JSON: ' . $contents);
        }

        return $json;
    }
}
