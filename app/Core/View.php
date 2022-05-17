<?php

namespace App\Core;

class View
{
    /**
     * Get data from Controller, and generate template
     *
     * @param string $file
     * @param array $data
     * @return void
     */
    public static function render($file, $data = [])
    {
        $filePath = __DIR__ . "/../Views/$file.php";

        if (file_exists($filePath)) {
            include($filePath);
        }
    }
}
