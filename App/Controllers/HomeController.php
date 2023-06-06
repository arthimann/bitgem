<?php

namespace App\Controllers;
use App\Api\ErrorInterface;
use App\Helpers\Request;

class HomeController
{
    private const ERR_PARAM = 'error';
    private const DATA_PARAM = 'data';

    protected Request $request;

    public function __construct()
    {
        $this->request = Request::getInstance();
    }

    /**
     * Show route resource
     * @return array
     */
    public function index(): array
    {
        $data = [
            self::DATA_PARAM => $this->request->params(),
        ];
        if (!empty($this->request->params(self::ERR_PARAM))) {
            $data[self::ERR_PARAM] = $this->getErrorMsg($this->request->params(self::ERR_PARAM));
        }
        return $data;
    }

    /**
     * Get error message by code
     * @param int $code
     * @return string
     */
    private function getErrorMsg(int $code): string
    {
        return match ($code) {
            403 => ErrorInterface::FILE_TYPE,
        };
    }
}