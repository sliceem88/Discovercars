<?php

namespace App\Controllers;

use App\Helper\Uploader;
use App\Core\View;
use App\Models\Counter;
use App\Models\Validator;

class Parser
{
    public function index($data = [])
    {
        View::render('homepage', $data);
    }

    public function execute()
    {
        $file = new Uploader();

        if (!$this->validateType()) {
            $this->index(['error' => 'Wrong file type']);
            return;
        }

        $fileContent = $this->getRemoveSymbols($file->getFileContent());
        $processedData = new Counter($fileContent);
        $result = $processedData->getResult();

        $this->index($result);
    }

    /**
     * @param string $content
     * @return string
     */
    public function getRemoveSymbols($content)
    {
        return preg_replace('/[^A-Za-z\s\-]/', '', $content);
    }

    /**
     * Validate file type
     *
     * @return bool
     */
    public function validateType()
    {
        $validator = new Validator();

        return $validator->validate();
    }
}
