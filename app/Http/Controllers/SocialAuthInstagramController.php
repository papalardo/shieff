<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\SocialInstagramAccountService;

class SocialAuthInstagramController extends Controller
{
    public function redirect()
    {
    	return redirect(\Instagram::getLoginUrl());
    }

    public function callback()
    {
    	$service = new SocialInstagramAccountService;
	   	$user = $service->createOrGetUser( $_GET['code'] );
	    auth()->login($user);
	    return redirect()->to('/home');
    }
}
