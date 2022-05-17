<?php

namespace App\Models;

class Counter
{
    const MIN_WORD_LENGHT = 3;
    const TOP_LETTERS_LIMIT = 10;

    protected $wordsByLimit = [];
    protected $fullLettersCount;
    protected $textContent;
    protected $topTenletters = [];
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     *
     * @return void
     */
    private function getWordsBiggerThanThree()
    {
        $content = explode(' ', $this->data);

        foreach ($content as $word) {
            if (strlen($word) > self::MIN_WORD_LENGHT) {
                $this->wordsByLimit[] = $word;
            }
        }
    }

    /**
     * Count letters in words, which lenght is bigger than 3 letters
     *
     * @return void
     */
    private function getCountAllLetters()
    {
        $content = implode('', $this->wordsByLimit);

        $this->fullLettersCount = strlen($content);
    }


    private function getLettersCount()
    {
        $content = implode('', $this->wordsByLimit);

        foreach (str_split($content) as $letter) {
            if (in_array($letter, array_keys($this->topTenletters))) {
                $this->topTenletters[$letter] += 1;
            } else {
                $this->topTenletters[$letter] = 1;
            }
        }
    }

    /**
     * Sort and Limit letters till 10
     *
     * @return void
     */
    public function getTopTenLetters()
    {
        arsort($this->topTenletters);

        return array_slice($this->topTenletters, 0, self::TOP_LETTERS_LIMIT);
    }

    /**
     * Helper function, format result
     *
     * @return array
     */
    public function formatedResult()
    {
        return [
            'letterCount' => "Letter count, using words, which limit is bigger than 10: $this->fullLettersCount",
            'topTen' => $this->getTopTenLetters()
        ];
    }

    /**
     *
     * @return array
     */
    public function getResult()
    {
        $this->getWordsBiggerThanThree();
        $this->getCountAllLetters();
        $this->getLettersCount();

        return $this->formatedResult();
    }
}
