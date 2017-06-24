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
        $openID = new LightOpenID('csgocallouts.win');

        if(!$openID->mode)
        {
            $openID->identity = 'http://steamcommunity.com/openid';
            $openID->returnUrl = env('FRONTEND_URL') . 'auth';
            return response()->json(['auth_url' => $openID->authUrl()]);
        }
        elseif($openID->mode == 'cancel')
        {
            return response('Login cancelled', 401);
        }
        else
        {
            if($openID->validate())
                return $this->authenticateUser($openID->identity);
        }
    }

    private function authenticateUser(string $steamId64) : JsonResponse
    {
        $user = User::where('steamid64', $steamId64);

        if(is_null($user))
            $user = $this->registerUser($steamId64);

        $session = $this->createSession($user);

        return response()->json($session);
    }

    private function registerUser(string $steamId64) : User
    {
        $response = $this->http->get('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . env('STEAM_API_KEY') . '&steamids=' . $steamId64);

        $steamUser = json_decode($response->getBody())['response']['players'][0];

        $user = User::create([
            'username' => $steamUser['personaname'],
            'avatar' => $steamUser['avatarfull'],
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

        $steamSession = SteamSession::create($session)->with('user');

        return $steamSession;
    }
}
