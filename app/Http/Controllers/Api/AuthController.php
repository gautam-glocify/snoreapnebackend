<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login API",
     *     @OA\Response(response="200", description="Login"),
     *     @OA\Response(response="401", description="Invalid credentials"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     format="email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     security={}
     * )
     */
    public function login()
    {
        $credentials = [
            'email' => request()->get('email'),
            'password' => request()->get('password'),
        ];
        return $this->userRepository->login($credentials);
    }
    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register API",
     *     @OA\Response(response="200", description="Register"),
     *     @OA\Response(response="401", description="Some error occurred"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     format="email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     security={}
     * )
     */
    public function register(UserStoreRequest $request)
    {
        return $this->userRepository->register($request);
    }
    /**
     * @OA\Get(
     *     path="/api/logout",
     *     summary="Logout API",
     *     @OA\Parameter(
     *         name="token",
     *         in="query",
     *         required=true,
     *         description="Authentication token",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Logout"),
     *     @OA\Response(response="401", description="Unauthorized"),
     *     security={}
     * )
     */

    public function logout()
    {
        return $this->userRepository->logout();
    }

}
