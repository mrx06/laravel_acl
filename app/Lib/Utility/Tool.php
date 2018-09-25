<?php
declare(strict_types = 1);

namespace App\Lib\Utility;

class Tool
{
    private $string = '';
    private static $instance = null;

    public function __construct(string $string = '')
    {
        $this->string = $string;
    }

    public function cleanString(): string
    {
        $this->string = preg_replace('/[[:^print:]]/', '', trim($this->string));
        return $this->string;
    }

    public function removeSpace(): string
    {
        $this->string = str_replace(' ', '', $this->string);
        return $this->string;
    }

    public function removeWhiteSpace(): string
    {
        $this->string = preg_replace('/\s+/', '', $this->string);
        return $this->string;
    }

    public function removePunctuation(): string
    {
        $this->string = preg_replace(" /[[:punct:]]+/", "", $this->string);
        return $this->string;
    }

    public function toString(): string
    {
        return $this->string;
    }
}
