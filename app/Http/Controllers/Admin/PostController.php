<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $pageTitle = trans('user.page.home.header');


        return view('admin.home', compact( 'pageTitle'));
    }



}
