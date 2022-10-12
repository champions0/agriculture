<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Repositories\Api\ResponseRepository;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * AuthController constructor.
     * @param ResponseRepository $response
     * @param UserService $userService
     */
    public function __construct(ResponseRepository $response,
                                UserService $userService)
    {
        $this->response = $response;
        $this->userService = $userService;
    }

    /**
     * @param UserCreateRequest $request
     * @return JsonResponse
     */
    public function register(UserCreateRequest $request)
    {
        $data = $request->validated();
        try {
            $response = $this->userService->create($data);

            return $this->response->success(['user' => $response],
//                'A verification link has been sent to your email address'
                'User created successful!'
            );

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }
}
