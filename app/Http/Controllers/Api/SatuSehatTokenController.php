<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Satusehat\Integration\OAuth2Client;

class SatuSehatTokenController extends Controller
{
    public function getToken()
    {
        $client = new OAuth2Client;
        $token = $client->token();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mendapatkan token',
            'data' => $token
        ], 200);
    }
}
