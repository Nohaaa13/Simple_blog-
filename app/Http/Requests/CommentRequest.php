<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class CommentRequest
{

    public static function rulesOne()
    {
        return [
            'CommentBody' => 'required',
        ];
    }



}
