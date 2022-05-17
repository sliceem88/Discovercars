<?php

namespace App\Helper;

class Uploader
{
    public function __construct()
    {
        $this->file = $_FILES['textFile'];
    }

    /**
     * @return string
     */
    public function getFileContent()
    {
        if ($this->file['error'] == UPLOAD_ERR_OK && is_uploaded_file($this->file['tmp_name'])) {
            return file_get_contents($this->file['tmp_name']);
        }
    }
}
