<?php

namespace App\Models;

class Validator
{
    const VALID_FILE_TIPE = 'text/plain';

    public function validate()
    {
        $fileType = $_FILES['textFile']['type'];

        // echo '<pre>';
        // var_dump($_FILES);
        // echo '</pre>';

        return self::VALID_FILE_TIPE === $fileType;
    }
}
