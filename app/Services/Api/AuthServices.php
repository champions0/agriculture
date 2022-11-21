<?php

namespace App\Services\Api;

use App\Models\SmsVerification;
use App\Models\User;
use App\Repositories\Api\ResponseRepository;
use App\Services\CryptServices;
use App\Services\EmailServices;
use App\Services\FileServices;
use App\Services\ProxyRequestServices;
use App\Services\UserService;
use Illuminate\Http\Request;
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
     * @var ResponseRepository
     */
    private $response;
    /**
     * @var SmsServices
     */
    private $smsServices;

    /**
     * @param UserService $userService
     * @param EmailServices $emailServices
     * @param CryptServices $cryptServices
     * @param FileServices $fileServices
     * @param ProxyRequestServices $proxyRequestServices
     * @param ResponseRepository $response
     * @param SmsServices $smsServices
     */
    public function __construct(
        UserService $userService,
        EmailServices $emailServices,
        CryptServices $cryptServices,
        FileServices $fileServices,
        ProxyRequestServices $proxyRequestServices,
        ResponseRepository $response,
        SmsServices $smsServices)
    {
        $this->userService = $userService;
        $this->emailServices = $emailServices;
        $this->cryptServices = $cryptServices;
        $this->fileServices = $fileServices;
        $this->proxyRequestServices = $proxyRequestServices;
        $this->response = $response;
        $this->smsServices = $smsServices;
    }

    /**
     * @param $data
     * @return array
     */
    public function registerStep1($data)
    {
        $data['sms_verified_at'] = now();
        $data['password'] = Hash::make($data['password']);
        $data['status'] = User::DRAFT;

        if (empty($data['email']) || $data['email'] == null) {
            $data['email'] = $data['country_code'] . $data['phone'];
        }
        return $this->userService->create($data);
    }

    /**
     * @param $userId
     * @param $data
     * @return mixed
     */
    public function registerStep2($userId, $data)
    {
        $data['soc_number'] = $this->cryptServices->encrypt($data['soc_number']);
        return $this->userService->update($userId, $data);
    }

    /**
     * @param $data
     * @param $user
     * @return mixed
     */
    public function login($data, $user)
    {
        if (!$user) {
            throw new Exception('Օգտատերը չի գտնվել', 403);
        }
        if (empty($user->sms_verified_at) || $user->sms_verified_at == null) {
            throw new Exception('Հոռախոսահամարը նույնականացված չէ', 403);
        }
        if (!Hash::check($data['password'], $user->password)) {
            throw new Exception('Տվյալները չեն համընկնում', 403);
        }
        return $this->proxyRequestServices->grantPasswordToken($user['email'], $data['password']);
    }

    /**
     * @param $userId
     * @param $phone
     * @param string $title
     * @return mixed
     */
    public function smsVerify($userId, $phone, $title = 'test')
    {
        $count = 1;
        $resp['code'] = rand(1000, 9999);
        $resp['message'] = 'Մուտքագրեք Ձեր համարին ուղարկված գաղտնաբառը';

        $smsVerify = SmsVerification::updateOrCreate([
            'phone' => $phone,
        ], [
            'user_id' => $userId,
            'code' => $resp['code'],
            'status' => 0,
            'count' => $count,
            'last_send' => now(),
        ]);

        $resp['status'] = $this->smsServices->sendSms($phone, $resp['code'], $smsVerify->id);

        return $resp;
    }

    /**
     * @param $phone
     * @param $code
     * @return mixed
     */
    public function checkCode($phone, $code)
    {
        $resp['message'] = "success";
        $resp['status'] = 200;

//        dd($code);
        $smsVerify = SmsVerification::where('phone', $phone)->first();

//        status = 1 is success
        if (isset($smsVerify) && $smsVerify->code == $code) {

//            $smsVerify->user->update([
//                'sms_verified_at' => now()
//            ]);
            $smsVerify->status = 1;
            $smsVerify->save();
            return $resp;
        }


        $resp['message'] = "Մուտքագրված ծածկագիրը սխալ է!";
        $resp['status'] = 400;
        return $resp;
    }
}
