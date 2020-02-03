<?php

namespace App\Http\Controllers\App;

use App\Entity\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{

    public function __construct()
    {

    }

    public function auth(Request $request)
    {

        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Wrong credentials!'
            ])->setStatusCode(401);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $user->api_token = rand(10000, 99999);
            $user->save();
            return response()->json([
                'token' =>  $user->api_token ,
            ])->setStatusCode(200);
        }
        else
        return response()->json([
            'error' => true,
            'message' => 'Wrong credentials!'
        ])->setStatusCode(401);

    }

    public function users(Request $request)
    {

        try {
            $this->validate($request, [
                'api_token' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Wrong credentials!'
            ])->setStatusCode(401);
        }
        $api_token = $request->get('api_token');
        $user = User::query()->where('api_token','=', $api_token)->get()->first();
        if ($user) {
            if ($user->isAdmin()) {
                $users = User::all();
                $Ids = array();
                foreach ($users as $user) {
                    if ($user->isAdmin()) {
                        $role = 'Admin';
                    } else
                        $role = 'User';
                    $I = array(
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $role
                    );
                    array_push($Ids, $I);;
                }

                return response()->json(
                    $Ids
                )->setStatusCode(200);
            } else
                return response()->json([
                    'error' => true,
                    'message' => 'You not admin!'
                ])->setStatusCode(403);

        }else
            return response()->json([
                'error' => true,
                'message' => 'Wrong token!'
            ])->setStatusCode(401);
    }

    public function posts(Request $request)
    {
        try {
            $this->validate($request, [
                'api_token' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Wrong credentials!'
            ])->setStatusCode(401);
        }

        $api_token = $request->get('api_token');
        $user = User::query()->where('api_token','=', $api_token)->get()->first();
        $posts = $user->posts()->get();
        $Ids = array();
        foreach ($posts as $post)
        {
            $I =  array(
                'title' => $post->title,
                'body' => $post->body,
                'likes' =>  $post->likes
            );
            array_push($Ids, $I  );
            ;
        }

        return response()->json(
            $Ids
        )->setStatusCode(200);

    }

}

