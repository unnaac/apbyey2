<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class FirebaseAuthController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function verifyToken(Request $request)
    {
        $idToken = $request->bearerToken();

        if (!$idToken) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            $verifiedToken = $this->auth->verifyIdToken($idToken);
            $uid = $verifiedToken->claims()->get('sub');
            $user = $this->auth->getUser($uid);

            return response()->json([
                'uid' => $user->uid,
                'email' => $user->email,
                'name' => $user->displayName,
            ]);
        } catch (FailedToVerifyToken $e) {
            return response()->json(['error' => 'Invalid token: ' . $e->getMessage()], 401);
        }
    }
}
