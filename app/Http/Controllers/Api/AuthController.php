<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\Image;
use App\Models\User;
use App\Repositories\Api\ResponseRepository;
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
     * @var UserService
     */
    private $userService;
    /**
     * @var EmailServices
     */
    private $emailServices;
    /**
     * @var CryptServices
     */
    private $cryptServices;
    /**
     * @var ProxyRequestServices
     */
    private $proxyRequestServices;
    /**
     * @var FileServices
     */
    private $fileServices;


    /**
     * @param ResponseRepository $response
     * @param UserService $userService
     * @param EmailServices $emailServices
     * @param CryptServices $cryptServices
     * @param ProxyRequestServices $proxyRequestServices
     * @param FileServices $fileServices
     */
    public function __construct(
        ResponseRepository $response,
        UserService $userService,
        EmailServices $emailServices,
        CryptServices $cryptServices,
        ProxyRequestServices $proxyRequestServices,
        FileServices $fileServices)
    {
        $this->response = $response;
        $this->userService = $userService;
        $this->emailServices = $emailServices;
        $this->cryptServices = $cryptServices;
        $this->proxyRequestServices = $proxyRequestServices;
        $this->fileServices = $fileServices;
    }

    /**
     * @param UserCreateRequest $request
     * @return JsonResponse
     */
    public function register(UserCreateRequest $request)
    {
        $data = $request->validated();
        $data['number'] = mt_rand(1000000, 9999999);
        $data['password'] = Hash::make($data['password']);

//        dd($data['avatar']);

        try {
            DB::beginTransaction();
            $user = $this->userService->create($data);
//            dd($user);
            $emailData['hash'] = $this->cryptServices->getResetPasswordHash($user);
            $emailData['user'] = $user;

            if(isset($data['avatar'])){
                $imageFileName = rand(1000000, 99999999999) . Str::slug($data['avatar']->getClientOriginalName(), '.');
                $path = $this->fileServices->savePhoto(500, $data['avatar'], 'avatars/' . $user['id'], $imageFileName);
//                $user['avatar'] = $path;
                $user->update([
                    'avatar' => $path // '/storage/' . $path
                ]);
//                Image::create([
//                    'path' => $path,
//                    'type' => 'avatar',
//                    'imageable_type' => User::class,
//                    'imageable_id' => $user['id'],
//                ]);

            }
            DB::commit();
            $this->emailServices->sendEmail($user, 'emails.registrationVerify', $emailData, config('constants.email_type.registrationVerify'));

            return $this->response->success(['user' => $emailData['user']],
                'User created successful! Check your email'
            );
//            $access_token = $user->createToken('default')->accessToken;

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
            ->where('email', $data['email'])
            ->first();
        try {
            if (!$user) {
                throw new Exception('This combination does not exists.', 403);
            }
//            if (empty($user->email_verified_at) || $user->email_verified_at == null) {
//                throw new Exception('Please verify your email.', 403);
//            }
            if (!Hash::check($data['password'], $user->password)) {
                throw new Exception('This combination does not exists.', 403);
            }
//
              $resp = $this->proxyRequestServices->grantPasswordToken($data['email'], $data['password']);

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


