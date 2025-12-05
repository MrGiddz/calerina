<?php

namespace App\Services\Search;

use App\Helpers\Classes\Helper;
use App\Services\Contracts\BaseSearchService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\SettingTwo;

class SerperDev implements BaseSearchService
{
    public $url = "https://google.serper.dev/search";
    public $apiKey = "";

    public function __construct()
    {
        $settings2 = SettingTwo::first();
        $this->apiKey = $settings2->serper_api_key;
    }

    public function search($keyword)
    {
        $client = new Client();
        $headers = [
            'X-API-KEY' => $this->apiKey,
            'Content-Type' => 'application/json',
        ];
        $body = [
            'q' => $keyword,
        ];
        $response = $client->post($this->url, [
            'headers' => $headers,
            'json' => $body,
        ]);
        $searchResult = $response->getBody()->getContents();
        try {
            $searchResult = json_decode($searchResult);
        } catch (\Throwable $th) {}

        return $searchResult;
    }

    public function getTopTitles($keyword)
    {
        $searchResult = $this->search($keyword);
        try {
            $organics = $searchResult->organic;
        } catch (\Throwable $th) {
            try {
                $organics = $searchResult['organic'];
            } catch (\Throwable $th) {
                $organics = [];
            }
        }
        $titles = collect($organics)->pluck('title')->toArray();
        return $titles;
    }

    public function getKeywords($keyword)
    {
        $searchResult = $this->search($keyword);
        try {
            $keywords = $searchResult->relatedSearches;
        } catch (\Throwable $th) {
            try {
                $keywords = $searchResult['relatedSearches'];
            } catch (\Throwable $th) {
                $keywords = [];
            }
        }
        $keywords = collect($keywords)->pluck('query')->toArray();
        return $keywords;
    }

    public function getTopStories($keyword)
    {
        $searchResult = $this->search($keyword);
        return $searchResult;
        try {
            $topStories = $searchResult->topStories;
        } catch (\Throwable $th) {
            try {
                $topStories = $searchResult['topStories'];
            } catch (\Throwable $th) {
                $topStories = [];
            }
        }
        $titles = collect($topStories)->pluck('title')->toArray();
        return $titles;
    }

    public function getPeopleAlsoAsks($keyword)
    {
        $searchResult = $this->search($keyword);
        try {
            $peopleAlsoAsk = $searchResult->peopleAlsoAsk;
        } catch (\Throwable $th) {
            try {
                $peopleAlsoAsk = $searchResult['peopleAlsoAsk'];
            } catch (\Throwable $th) {
                $peopleAlsoAsk = [];
            }
        }
        $questions = collect($peopleAlsoAsk)->pluck('question')->toArray();
        return $questions;
    }

}