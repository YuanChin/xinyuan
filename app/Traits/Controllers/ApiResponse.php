<?php

namespace App\Traits\Controllers;

trait ApiResponse
{
    /**
     * Store the additional information that will be responsed.
     *
     * @var array
     */
    private $additionalData = [
        'status'  => 0,
        'message' => '',
    ];

    /**
     * Response the successful operation.
     *
     * @param mixed $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = null, string $message = 'OK')
    {
        $this->setSuccessfulMessage($message);

        return response()->json(array_merge($this->additionalData, ['data' => $data]));
    }

    /**
     * Response the failed operation.
     *
     * @param mixed $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function fail($data = null, string $message = 'Service Error')
    {
        $this->setFailedMessage($message);

        return response()->json(array_merge($this->additionalData, ['data' => $data]));
    }

    /**
     * Set the successful message that will be responsed.
     *
     * @param string $message
     * @return void
     */
    private function setSuccessfulMessage(string $message)
    {
        $this->additionalData['message'] = $message;
    }

    /**
     * Set the failed message that will be responsed.
     *
     * @param string $message
     * @return void
     */
    private function setFailedMessage(string $message)
    {
        $this->additionalData['status'] = 1;
        $this->additionalData['message'] = $message;
    }
}