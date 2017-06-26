<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entities\Auth\SteamSession;
use App\Entities\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use \LightOpenID;

class SteamAuthController extends Controller
{
    private $http;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->http = new Client();
    }

    public function getAuthentication() : JsonResponse
    {
        $openID = new LightOpenID(env('FRONTEND_URL'));

        if($openID->mode)
        {
            switch($openID->mode)
            {
                case 'id_res':
                {
                    $openID->validate();
                    $identity = str_replace('http://steamcommunity.com/openid/id/', '', urldecode($openID->identity));
                    return $this->authenticateUser($identity);
                }

                case 'cancel':
                {
                    return response('Login cancelled', 401);
                }
            }
        }
        else
        {
            $openID->identity = 'http://steamcommunity.com/openid';
            $openID->returnUrl = env('FRONTEND_URL') . env('FRONTEND_AUTH_PATH');

            return response()->json(['auth_url' => $openID->authUrl()]);
        }

        return response('Error authenticating', 500);
    }

    private function authenticateUser(string $steamId64) : JsonResponse
    {
        $user = User::where('steamid64', $steamId64)->first();

        if(is_null($user))
            $user = $this->registerUser($steamId64);

        $session = $this->createSession($user);

        return response()->json($session);
    }

    private function registerUser(string $steamId64) : User
    {
        $response = $this->http->get('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . env('STEAM_API_KEY') . '&steamids=' . $steamId64);
        $steamUser = (json_decode($response->getBody())->response->players[0]);
        $user = User::create([
            'username' => $steamUser->personaname,
            'avatar' => $steamUser->avatarfull,
            'steamid64' => $steamId64,
        ]);

        return $user;
    }

    private function createSession(User $user) : SteamSession
    {
        $sessionToken = bin2hex(random_bytes(15));

        $session = [
            'user_id' => $user->id,
            'token' => $sessionToken,
            'expires' => Carbon::now()->addHours(3)->timestamp
        ];

        $steamSession = SteamSession::create($session)->with('user')->first();

        return $steamSession;
    }
}
