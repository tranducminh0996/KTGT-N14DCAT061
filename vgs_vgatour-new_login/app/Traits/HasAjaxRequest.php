<?php
namespace App\Traits;

use App\Helpers\Helper;

trait HasAjaxRequest {
    /**
     * Ajax success response.
     *
     * @param null $data
     * @param array $messages
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSuccessResponse($data = null, $messages = [])
    {
        return $this->ajaxResponseRequest(true, $data, $messages, Helper::HTTP_OK);
    }

    /**
     * Ajax error response.
     *
     * @param $responseCode
     * @param array $messages
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxErrorResponse($responseCode, $messages = [], $data = null)
    {
        return $this->ajaxResponseRequest(false, $data, $messages, $responseCode);
    }

    /**
     * Ajax exception error response.
     *
     * @param array $messages
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxExceptionErrorResponse($messages = [], $data = null)
    {
        return $this->ajaxErrorResponse(Helper::HTTP_SERVE_ERROR, $messages, $data);
    }

    /**
     * Ajax invalid request error response.
     *
     * @param array $messages
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxValidateErrorResponse($messages = [])
    {
        $messages = (is_array($messages) ? $messages : [$messages]);
        $resMessages = [];

        foreach ($messages as $field => $fieldMessages) {
            if (is_array($fieldMessages)) {
                $resMessages = array_merge($resMessages, $fieldMessages);
            } else {
                $resMessages[] = $fieldMessages;
            }
        }

        return $this->ajaxErrorResponse(Helper::HTTP_UNPROCESSABLE_ENTITY, $resMessages);
    }

    /**
     * Ajax not found error response.
     *
     * @param array $messages
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxNotFoundErrorResponse($messages = [])
    {
        $messages = (!empty($messages) ? $messages : __("message.http_not_found"));

        return $this->ajaxErrorResponse(Helper::HTTP_NOT_FOUND, $messages);
    }

    /**
     * Ajax not found error response.
     *
     * @param array $messages
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxForbiddenErrorResponse($messages = [])
    {
        $messages = (!empty($messages) ? $messages : __("message.http_forbidden"));

        return $this->ajaxErrorResponse(Helper::HTTP_FORBIDDEN, $messages);
    }

    /**
     * Ajax response.
     *
     * @param bool $code
     * @param null $data
     * @param array $messages
     * @param int $responseCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxResponseRequest(bool $code, $data = null, $messages = [], $responseCode = 200)
    {
        return response()->json([
            'code' => (int)$code,
            'response_code' => $responseCode,
            'data' => $data,
            'message' => is_array($messages) ? $messages : [$messages],
        ]);
    }
}
