<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\UserRegistrationStep1Request;
use App\Http\Requests\Api\UserRegistrationStep2Request;
use App\Http\Requests\UserCreateRequest;
use App\Models\Image;
use App\Models\Residence;
use App\Models\SmsVerification;
use App\Models\Subject;
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
use Illuminate\Support\Facades\Crypt;
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
     * @var ProxyRequestServices
     */
    private $proxyRequestServices;


    /**
     * AuthController constructor.
     * @param AuthServices $authServices
     * @param ResponseRepository $response
     * @param EmailServices $emailServices
     * @param CryptServices $cryptServices
     * @param ProxyRequestServices $proxyRequestServices
     */
    public function __construct(
        AuthServices $authServices,
        ResponseRepository $response,
        EmailServices $emailServices,
        CryptServices $cryptServices,
        ProxyRequestServices $proxyRequestServices)
    {
        $this->authServices = $authServices;
        $this->response = $response;
        $this->emailServices = $emailServices;
        $this->cryptServices = $cryptServices;
        $this->proxyRequestServices = $proxyRequestServices;
    }

    /**
     * @param UserRegistrationStep1Request $request
     * @return JsonResponse
     */
    public function registerStep1(UserRegistrationStep1Request $request)
    {
        $data = $request->validated();
        $phone = $data['country_code'] . $data['phone'];


        $phoneVerify = SmsVerification::where('phone', $phone)->where('status', 1)->first();
        try {

            if (empty($phoneVerify) || $phoneVerify == null) {
                $message = 'Հեռախոսահամարը հաստատված չէ';
                return $this->response->badRequest([], $message);
            }
            DB::beginTransaction();

            $user = $this->authServices->registerStep1($data);

            $phoneVerify->user_id = $user->id;
            $phoneVerify->save();
            DB::commit();
//            $resp = $this->authServices->smsVerify($user['id'], $data['country_code'] . $data['phone'], 'test');

            return $this->response->success([
                    'user' => $user,
//                'code' => $resp['code'],
                ]
//                $resp['message']
            );

        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return $this->response->badRequest([], $e->getMessage());
        }
    }

    /**
     * @param UserRegistrationStep2Request $request
     * @return JsonResponse
     */
    public function registerStep2(UserRegistrationStep2Request $request)
    {
        $data = $request->validated();
        $userId = $data['user_id'];

        try {

            $user = $this->authServices->registerStep2($userId, $data);

            return $this->response->success([
                    'user' => $user,
                ]
            );

        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return $this->response->badRequest([], $e->getMessage());
        }
    }
    /**
     * @param UserCreateRequest $request
     * @return JsonResponse
     */
//    public function register(UserCreateRequest $request)
//    {
//        $data = $request->validated();
//        try {
//            $user = $this->authServices->register($data);
//            $resp = $this->authServices->smsVerify($user['id'], $data['country_code'] . $data['phone'], 'test');
//
//
//            return $this->response->success([
//                'user' => $user,
//                'code' => $resp['code'],
//            ],
//                $resp['message']
//            );
//
//        } catch (\Throwable $e) {
////            dd($e->getMessage());
//            return $this->response->badRequest([], $e->getMessage());
//        }
//    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function smsVerify(Request $request)
    {
        $data = $request->all();
        $phone = $data['country_code'] . $data['phone'];
        $userId = $data['user_id'] ?? null;

        try {
            $resp = $this->authServices->smsVerify($userId, $phone, 'test');

            return $this->response->success([
                'code' => $resp['code'],
            ],
                $resp['message']
            );

        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return $this->response->badRequest([], $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkCode(Request $request)
    {
        $data = $request->all();
        $phone = $data['country_code'] . $data['phone'];
        $code = $data['code'];

        try {
            $resp = $this->authServices->checkCode($phone, $code);

            return response()->json(['message' => $resp['message']], $resp['status']);

        } catch (\Throwable $e) {
//            dd($e->getMessage());
            return $this->response->badRequest([], $e->getMessage());
        }
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
            ->where('country_code', $data['country_code'])
            ->where('phone', $data['phone'])
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

    /**
     * @return JsonResponse
     */
    public function getUser()
    {
        return response()->json([
            'user' => Auth::user()
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getResidences()
    {
        return response()->json([
            'residences' => Residence::query()->pluck('name', 'id')
        ]);
    }
    public function getSubjects()
    {
        return response()->json([
            'subjects' => Subject::query()->pluck('name', 'id')
        ]);
    }
}


