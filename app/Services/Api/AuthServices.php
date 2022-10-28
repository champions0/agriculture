<?php

namespace App\Services\Api;

use App\Models\User;
use App\Services\CryptServices;
use App\Services\EmailServices;
use App\Services\FileServices;
use App\Services\ProxyRequestServices;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mockery\Exception;

/**
 * Class AuthServices
 * @package App\Services
 */
class AuthServices
{

    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var EmailServices
     */
    private $emailServices;
    /**
     * @var FileServices
     */
    private $fileServices;
    /**
     * @var CryptServices
     */
    private $cryptServices;
    /**
     * @var ProxyRequestServices
     */
    private $proxyRequestServices;

    /**
     * AuthServices constructor.
     * @param UserService $userService
     * @param EmailServices $emailServices
     * @param CryptServices $cryptServices
     * @param FileServices $fileServices
     * @param ProxyRequestServices $proxyRequestServices
     */
    public function __construct(
        UserService $userService,
        EmailServices $emailServices,
        CryptServices $cryptServices,
        FileServices $fileServices,
        ProxyRequestServices $proxyRequestServices)
    {
        $this->userService = $userService;
        $this->emailServices = $emailServices;
        $this->cryptServices = $cryptServices;
        $this->fileServices = $fileServices;
        $this->proxyRequestServices = $proxyRequestServices;
    }

    /**
     * @param $data
     * @return array
     */
    public function register($data)
    {
        $data['number'] = mt_rand(1000000, 9999999);
        $data['password'] = Hash::make($data['password']);
        DB::beginTransaction();
        $user = $this->userService->create($data);
        $emailData['hash'] = $this->cryptServices->getResetPasswordHash($user);
        $emailData['user'] = $user;

        if(isset($data['avatar'])){
            $imageFileName = rand(1000000, 99999999999) . Str::slug($data['avatar']->getClientOriginalName(), '.');
            $path = $this->fileServices->savePhoto(500, $data['avatar'], 'avatars/' . $user['id'], $imageFileName);
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
//        $this->emailServices->sendEmail($user, 'emails.registrationVerify', $emailData, config('constants.email_type.registrationVerify'));

        return $user;
    }

    /**
     * @param $data
     * @param $user
     * @return mixed
     */
    public function login($data, $user)
    {
        if (!$user) {
            throw new Exception('This combination does not exists.', 403);
        }
//            if (empty($user->email_verified_at) || $user->email_verified_at == null) {
//                throw new Exception('Please verify your email.', 403);
//            }
        if (!Hash::check($data['password'], $user->password)) {
            throw new Exception('This combination does not exists.', 403);
        }
        return $this->proxyRequestServices->grantPasswordToken($data['email'], $data['password']);
    }
}
