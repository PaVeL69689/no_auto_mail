<?php
// app/Services/ClickHouseService.php

namespace App\Services;

class ClickHouseService
{
    private $host;
    private $port;
    private $username;
    private $password;
    private $database;

    public function __construct()
    {
        $this->host = env('CLICKHOUSE_HOST', 'localhost');
        $this->port = env('CLICKHOUSE_PORT', '8123');
        $this->username = env('CLICKHOUSE_USERNAME', 'house');
        $this->password = env('CLICKHOUSE_PASSWORD', '5555');
        $this->database = env('CLICKHOUSE_DATABASE', 'clickhouse');
    }

    public function query($sql)
    {
        $url = "http://{$this->host}:{$this->port}/?query=" . urlencode($sql);
        
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_USERPWD => "{$this->username}:{$this->password}",
            CURLOPT_HTTPHEADER => [
                'X-ClickHouse-Database: ' . $this->database,
            ],
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        if ($httpCode !== 200) {
            throw new \Exception("ClickHouse error: {$error} - {$response}");
        }
        
        return $response;
    }
    
    private function parseResponse($response)
    {
        $lines = explode("\n", trim($response));
        $result = [];
        
        if (count($lines) > 1) {
            $headers = explode("\t", $lines[0]);
            
            for ($i = 1; $i < count($lines); $i++) {
                if (empty(trim($lines[$i]))) continue;
                
                $data = explode("\t", $lines[$i]);
                $row = [];
                
                for ($j = 0; $j < count($headers); $j++) {
                    $row[$headers[$j]] = $data[$j] ?? null;
                }
                
                $result[] = $row;
            }
        }
        
        return $result;
    }
}