<?php
declare (strict_types = 1);
namespace App\Lib\ModelTrait;

trait StringCleaner
{
    public function cleanString(string $string): string
    {
        return preg_replace('/[[:^print:]]/', '', trim($string));
    }

    public function removeSpace(string $string): string
    {
      return str_replace(' ', '', $string);
    }

    public function removeWhiteSpace(string $string): string
    {
      return preg_replace('/\s+/', '', $string);
    }

    public function removePunctuation(string $string): string
    {
      return preg_replace(" /[[:punct:]]+/", "", $string);
    }
}
