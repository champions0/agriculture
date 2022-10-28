<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\Image;
use App\Models\User;
use App\Repositories\Api\ResponseRepository;
use App\Services\Api\AuthServices;
use App\Services\CryptServices;
use App\Services\EmailServices;
use App\Services\FileServices;
use App\Services\ProxyRequestServices;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mockery\Exception;

class AuthController extends Controller
{
    /**
     * @var ResponseRepository
     */
    protected $response;
    /**
     * @var EmailServices
     */
    private $emailServices;
    /**
     * @var CryptServices
     */
    private $cryptServices;
    /**
     * @var AuthServices
     */
    private $authServices;


    /**
     * AuthController constructor.
     * @param AuthServices $authServices
     * @param ResponseRepository $response
     * @param EmailServices $emailServices
     * @param CryptServices $cryptServices
     */
    public function __construct(
        AuthServices $authServices,
        ResponseRepository $response,
        EmailServices $emailServices,
        CryptServices $cryptServices)
    {
        $this->authServices = $authServices;
        $this->response = $response;
        $this->emailServices = $emailServices;
        $this->cryptServices = $cryptServices;
    }

    /**
     * @param UserCreateRequest $request
     * @return JsonResponse
     */
    public function register(UserCreateRequest $request)
    {
        $data = $request->validated();
        try {
            $user = $this->authServices->register($data);
            return $this->response->success(['user' => $user],
                'User created successful!'
            );

        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return $this->response->badRequest([], $e->getMessage());
        }
    }

    public function smsVerify()
    {
        $phone = "+37496574750";
        $url = '';
//        $sendData = [
//            "messages" => [
//                "template" =>,
//                "recipient" =>,
//                "message-id" =>,
//                "variables" => [
//                    "NAME" =>,
//                    "SURNAME" =>,
//                ],
//            ]
//        ];


        //{
        //"messages":
        //[
        //{
        //"template-id": "111",
        //"recipient": "79990009900",
        //"message-id": "2016-11-07-18-29-32",
        //"variables": {"NAME":"IVAN", "SURNAME":"IVANOV"}
        //}
        //]
        //}
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function emailVerify(Request $request)
    {
        $data = $this->cryptServices->decrypt($request->get('hash'));
        try {

            $user = User::query()->find($data['user_id']);

            if ($user) {
                $user->email_verified_at = date('Y-m-d h:i:s');
                $user->save();
                Auth::loginUsingId($data['user_id'], $remember = true);
                $access_token = $user->createToken('default')->accessToken;

                return $this->response->success([
                    'user' => $user,
                    'access_token' => $access_token
                ],
//                'A verification link has been sent to your email address'
                    'User created successful! Check your email'
                );
            }


        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return $this->response->badRequest([], $e->getMessage());
        }

    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::query()
            ->where('email', $data['email'])
            ->first();

        try {

            $resp = $this->authServices->login($data, $user);

            return $this->response->success([
                'access_token' => $resp->access_token,
                'expires_in' => $resp->expires_in,
                'refresh_token' => $resp->refresh_token,
                "user" => $user,
            ],
                'You have been logged in.'
            );

        } catch (\Exception $e) {
//            dd($e->getMessage(), $e->getLine());
            return $this->response->badRequest([], $e->getMessage(), 400);
        }
    }
}


