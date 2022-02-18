<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    public function home(){

        $response = Http::get('http://localhost:1337/api/posts?populate=image,tags');
        $posts = [];
    
        if ($response->failed()) {
            if (isset($data['error'])) {
                Log::error('Server error: ' . $data['error']['message']);
            } else {
                Log::error('Request Failed');
            }
        } else {
            //get posts from response
            $posts = $response->json('data');
        }
    
        return view('home', ['posts' => $posts]);
    }
    
}
