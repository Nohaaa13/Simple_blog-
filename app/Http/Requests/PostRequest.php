<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class PostRequest
{

    public static function rulesOne()
    {
        return [
            'title' => 'required|string|max:255',
            'PostBody' => 'required|string',
        ];
    }



}
