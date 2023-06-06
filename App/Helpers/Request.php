<?php

namespace App\Helpers;

use App\Core\Singleton;

class Request extends Singleton
{
    /**
     * Validate if POST request
     * @param string $name
     * @return bool
     */
    public function validateFiles(string $name = ''): bool
    {
        return !empty($_FILES[$name]);
    }

    /**
     * Get params from request
     * @param string $name
     * @return array|string|null
     */
    public function params(string $name = ''): array|string|null
    {
        $result = array_merge($_POST, $_GET, $_FILES);
        if (!empty($name)) {
            return $result[$name] ?? null;
        }
        return $result;
    }
}