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
     * 查看餘額
     *
     * - 不帶參數：回傳全部非 0 資產陣列（Bitget `assets` 整包）
     * - 帶 coin：回傳單一幣別的資訊（找不到就回傳空陣列）
     *
     * @param string|null $coin 例如 'USDT', 'BTC'
     * @return array
     */
    public function getBalance(?string $coin = null): array
    {
        // 這裡用的是 Unified Trading Account 的 Get Account Assets
        // GET /api/v3/account/assets :contentReference[oaicite:2]{index=2}
        $response = $this->request('GET', '/api/v3/account/assets');

        if (($response['code'] ?? null) !== '00000') {
            throw new \RuntimeException('Bitget API error: ' . ($response['msg'] ?? 'unknown'));
        }

        $assets = $response['data']['assets'] ?? [];

        if ($coin === null) {
            // 直接回傳所有資產
            return $assets;
        }

        $coin = strtoupper($coin);

        foreach ($assets as $asset) {
            if (($asset['coin'] ?? null) === $coin) {
                return $asset;
            }
        }

        // 找不到指定幣別就回空陣列
        return [];
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
