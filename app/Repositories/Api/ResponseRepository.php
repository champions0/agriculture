<?php

namespace App\Repositories\Api;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Http\JsonResponse;
//use Your Model

/**
 * Class ResponseRepository.
 */
class ResponseRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    const SUCCESS = 200;
    const NOTFOUND = 404;
    const BADREQUEST = 400;
    const EMPTY = 204;
    const FORBIDDEN = 403;

    /**
     * @param $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function badRequest($data, $message = 'Sorry Something went Wrong.', $status = self::BADREQUEST)
    {
        return $this->_response($data, $message, $status);
    }

    /**
     * @param $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function forEmpty($data, $message = 'Empty Data', $status = self::EMPTY)
    {
        return $this->_response($data, $message, $status);
    }

    /**
     * @param $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function validationMessageForCustomSize($data, $message = 'This custom size is currently not available for this product. Please select a different combination (switch between width and height values) or try selecting another product from the Print Products Menu. Contact us if you have a Custom Order.', $status = self::FORBIDDEN)
    {
        return $this->_response($data, $message, $status);
    }

    /**
     * @param $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function notFound($data, $message = 'Sorry, Resource not found.', $status = self::NOTFOUND)
    {
        return $this->_response($data, $message, $status);
    }

    /**
     * @param $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function success($data, $message = 'Success', $status = self::SUCCESS)
    {
        return $this->_response($data, $message, $status);
    }

    /**
     * @param array $data
     * @param string $message
     * @param $status
     * @return JsonResponse
     */
    private function _response($data = [], $message = '', $status)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
