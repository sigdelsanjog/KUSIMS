<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\UserProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

/**
 * Undocumented class.
 * @package category
 */
class AuthController extends Controller
{
    /**
     * Login to the system.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }
    public function redirectToProvider($provider)
    {
        return response()->json([
            'redirectUrl' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl()
        ]);
    }
    public function handleLogin($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
    }
    public function handleProviderCallback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();
        if ($userSocial && isset($userSocial->email) && isset($userSocial->id)) {
            $findUser = User::where('email', $userSocial->email)->first();
            if ($findUser) {
                    // $user = auth()->user();
                    $findUser['token'] = $this->generateTokenForUser($findUser);
                    return redirect('/silent')->withCookie(cookie('authentication',
                        json_encode([
                            $findUser
                        ]), 8000, null, null, false, false));
            } else {
                return redirect()->to("/unauthorized");
            }
        } else 
        {
            return redirect('/login')->withCookie(cookie('authentication', json_encode([
                'error' => 'User is unavailable. Try another social account!',
                'redirect' => '/login'
            ]), 8000, null, null, false, false));
        }
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $this->validate($request, [
            'email'    => 'required|email|exists:users',
            'password' => 'required|min:5',
        ]);

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            /** @var User $user */
            $user['token'] = $this->generateTokenForUser($user);

            return response()->json($user);
        } else {
            return response()->json(['success' => 'false', 'message' => 'Authentication failed'], 401);
        }
    }

    /**
     * Generate the token for the user.
     *
     * @param User $user
     * @return string
     */
    private function generateTokenForUser($user): string
    {
        return $user->createToken(config('app.name'))->accessToken;
    }

    /**
     * Register user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $userData = $this->validate($request, [
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'first_name'                  => 'required|string|max:255',
            'last_name'                  => 'required|string|max:255',
            'role_id' =>'required|integer',
            'user_type'=>'required|integer'
        ]);


            $user = app(User::class)->create($userData);
            UserProfile::create([
           
                'first_name' => $request['first_name'],
                'last_name' => $request['first_name'],
                'user_id' => $user->id
            ]);
            $user['token'] = $this->generateTokenForUser($user);

        // try {
        //     $user          = app(User::class)->create($userData);
        //     app(UserProfile::class)->create(['user_id' => $user->id]);

        //     $user['token'] = $this->generateTokenForUser($user);
        // } catch (\Exception $exception) {
            
        // return response()->json($exception);
        //     // logger()->error($exception);

        //     // return response()->json([
        //     //     'success' => false,
        //     //     'message' => 'Unable to create new user.',
        //     // ]);
        // }

        return response()->json($user);
    }

    /**
     * Get current user.
     * @return User
     */
    public function getCurrentUser(): User
    {
        return request()->user()->load('userProfile');
        //->with('userProfile')->find(Auth::id());
        //request()->user();
    }

    /**
     * Logout the user from the system.
     * @return JsonResponse
     */
    public function logOut()
    {
        request()->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
