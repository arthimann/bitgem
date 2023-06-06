<?php

namespace App\Helpers;

class Url
{
    /**
     * Redirect to path.
     * @default homepage
     * @param array $params
     * @return void
     */
    public static function redirect(array $params = []): void
    {
        $res = [];
        foreach ($params as $key => $val) {
            $res[] = $key . '=' . $val;
        }
        $path = !empty($res) ? '?' . implode('&', $res) : '';
        header("Location: /{$path}");
        exit();
    }
}