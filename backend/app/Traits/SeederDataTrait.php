<?php


namespace App\Traits;

trait SeederDataTrait
{
    public function settings()
    {
        return [];
    }

    public function replacingChars()
    {
        return [
            ' ',
            ',',
            '.',
            ':',
            '-',
            '`',
            ";",
            "'",
            '"',
        ];
    }

    public function convertToKey(string $value, array $replacingChars = [])
    {
        return trim(strtolower(str_replace($replacingChars, '_', $value)));
    }

}
