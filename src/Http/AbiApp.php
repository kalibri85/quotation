<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class AbiApp
{
    public $httpClient;
    public $mokaResponse;
    public $response;
    public $json;

    public function __construct($regNo)
    {
        $this->regNo = regNo;
    }

    public function getAbiResponse($regNo)
    {
        //test data for gatting body from API
        $abis = [22529902, 46545255, 52123803, 62123803];
        $mokaResponse = new MockResponse(json_encode(['abi' => $abis[array_rand($abis, 1)], 'regNo' => $regNo]));
        $httpClient = new MockHttpClient($mokaResponse);
        $response = $httpClient->request('GET', 'https://api.com/'.$regNo);
        if ($response->getStatuscode() === 200) {
            $json = json_decode($response->getContent());

            return $json->abi;
        }
    }
}
