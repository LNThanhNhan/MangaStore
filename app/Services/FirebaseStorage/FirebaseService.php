<?php

namespace App\Services\FirebaseStorage;
use Illuminate\Support\Facades\Http;

class FirebaseService
{
    static public function uploadImage($image)
    {
        $url = env('GO_SERVER_HOST')."/img/create";
        //Send a request to the server to create a new image
        $response = Http::attach(
            'image',
            file_get_contents($image->path()),
            $image->getClientOriginalName()
        )->post($url);
        $response = $response->json();
        if($response['success'] == true)
        {
            return $response['data'];
        }
        dd($response);
    }

    static public function updateImage($image_uuid,$image)
    {
        $url = env('GO_SERVER_HOST')."/img/update";
        //Send a request to the server to create a new image
        $response = Http::attach(
            'image',
            file_get_contents($image->path()),
            $image->getClientOriginalName()
        )->put($url,[
            'id' => $image_uuid,
        ]);
        $response = $response->json();
        if($response['success'] == true)
        {
            return $response['data'];
        }
        dd($response);
    }

    //Has errors: can't send delete request to server
    //because server don't accept delete request with body that contains data
    //(due to http.request library in golang doesn't support delete request with body)
    //r.FormValue("id") will return empty string (because there is no data in body)
    //r.URL.Query().Get("id") will return the id
    //so we have to send delete request with query string
    //https://stackoverflow.com/questions/59011487/body-of-delete-request-is-empty-in-my-rest-api-endpoint
    static public function deleteImage($image_uuid)
    {
        $url = env('GO_SERVER_HOST')."/img/delete";
        $response = Http::delete($url.'?id='.$image_uuid);
        $response = $response->json();
        if($response['success'] == true)
        {
            return;
        }
        dd($response);
    }
}
