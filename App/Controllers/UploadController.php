<?php

namespace App\Controllers;

use App\Models\Math;
use App\Helpers\Url;
use App\Helpers\Request;
use App\Models\ImageColor;

class UploadController
{
    private const FILE_INPUT = 'file';
    protected ImageColor $imageColor;
    protected Request $request;

    public function __construct()
    {
        $this->imageColor = new ImageColor();
        $this->request = Request::getInstance();
    }

    /**
     * Execute route resource
     * @return void
     */
    public function index(): void
    {
        if (!$this->request->validateFiles(self::FILE_INPUT)) {
            Url::redirect();
        }

        try {
            $data = $this->imageColor->proceed($this->request->params(self::FILE_INPUT));
            $result = Math::calcPercentage($data['count'], $data['data']);
            Url::redirect($result);
        } catch (\Throwable $exception) {
            Url::redirect([
                'error' => $exception->getCode()
            ]);
        }
    }
}
