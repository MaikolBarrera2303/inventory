<?php

namespace App\Models;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class Api
{
   /**
    * Index
    */
    public function index(string $patch, string|null $page): LengthAwarePaginator
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer ".env("TOKEN_BACKEND")
        ])->get(env("URL_BACKEND").$patch,[
            "page" => $page
        ])->json();

        $response = $response["data"];

        return new LengthAwarePaginator(
            $response["data"],
            $response["total"],
            $response["per_page"],
            $response["current_page"],
            [
                'path' => env("APP_URL")."/".$patch,
                'query' => request()->query(),
            ]
        );
    }

    public function create(string $patch)
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer ".env("TOKEN_BACKEND")
        ])->get(env("URL_BACKEND").$patch,[
            "create" => true
        ])->json();

        return $response["data"];
    }

    public function store(string $patch,array $data) 
    {
        return Http::withHeaders([
            "Authorization" => "Bearer ".env("TOKEN_BACKEND")
        ])->post(env("URL_BACKEND").$patch,[
            "data" => $data
        ])->json();
    }

    public function show(string $patch)
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer ".env("TOKEN_BACKEND")
        ])->get(env("URL_BACKEND").$patch,)->json();

        return (object) $response["data"];
    }

    public function edit(string $patch)
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer ".env("TOKEN_BACKEND")
        ])->get(env("URL_BACKEND").$patch,[
            "edit" => true
        ])->json();

        return (object) [
            "info" => $response["data"]["info"],
            "query" => $response["data"]["query"],
        ];
    }

    public function update(string $patch,array $data)
    {
        return Http::withHeaders([
            "Authorization" => "Bearer ".env("TOKEN_BACKEND")
        ])->patch(env("URL_BACKEND").$patch,[
            "data" => $data
        ])->json();
    }

    public function destroy(string $patch)
    {
        return Http::withHeaders([
            "Authorization" => "Bearer ".env("TOKEN_BACKEND")
        ])->delete(env("URL_BACKEND").$patch)->json();
    }
}