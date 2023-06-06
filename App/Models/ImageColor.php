<?php

namespace App\Models;

class ImageColor
{
    /**
     * Run the process
     * This function was partially inspired by this solution, since I never tried to get colors from image.
     * @url https://stackoverflow.com/questions/7727843/detecting-colors-for-an-image-using-php
     * And this documentation ref.
     * @url https://www.php.net/manual/en/function.imagecolorat.php
     * @param array $file
     * @return array
     * @throws \Exception
     */
    public function proceed(array $file): array
    {
        $data = $this->genImage($file);

        $imageWidth = imagesx($data);
        $imageHeight = imagesy($data);

        $frequency = [];
        $total = 1;
        for ($x = 0; $x < $imageWidth; $x++) {
            for ($y = 0; $y < $imageHeight; $y++) {
                $rgb = imagecolorat($data, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $key = "{$r},{$g},{$b}";

                if (isset($frequency[$key])) {
                    $frequency[$key]++;
                    $total++;
                } else {
                    $frequency[$key] = 1;
                }
            }
        }

        arsort($frequency);
        return [
            'count' => $total,
            'data' => array_slice($frequency, 0, 5, true)
        ];
    }

    /**
     * @param string $file
     * @return \GdImage|bool
     * @throws \Exception
     */
    private function genImage(array $file): \GdImage|bool
    {
        return match ($file['type']) {
            'image/png' => imagecreatefrompng($file['tmp_name']),
            'image/jpg', 'image/jpeg' => imagecreatefromjpeg($file['tmp_name']),
            default => throw new \Exception(code: 403),
        };
    }
}