<?php

namespace App\Services;
use App\User;
use App\SocialFacebookAccount;

class SocialInstagramAccountService
{
    public function createOrGetUser($code)
    {
        $user_provider = \Instagram::getOAuthToken($code);
        $account = SocialFacebookAccount::where('provider','=', 'instagram')
            ->where('provider_user_id','=', $user_provider->user->id)
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $user_provider->user->id,
                'provider' => 'instagram'
            ]);

            $user = User::where('username','=', $user_provider->user->username)->first();

            if (!$user) {

                $user = User::create([
                    'email' => 'LDSPA@dlasp.com',
                    'name' => $user_provider->user->full_name,
                    'password' => md5(rand(1,10000)),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}