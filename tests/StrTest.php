<?php

use PHPUnit\Framework\TestCase;
use Seffeng\StrHelper\Str;

class StrTest extends TestCase
{
    private $value = 6;

    public function testGenerateChatCode()
    {
        var_dump(Str::generateChatCode($this->value));
    }

    public function testGenerateNumberCode()
    {
        var_dump(Str::generateNumberCode($this->value));
    }

    public function testGenerateStringCode()
    {
        var_dump(Str::generateStringCode($this->value, true));
    }

    public function testFloatToString()
    {
        var_dump(Str::floatToString('50,000.12'));
    }

    public function testBasename()
    {
        $path = 'https://www.1kmi.com/view/2.php';
        var_dump(Str::basename($path));
    }

    public function testToArray()
    {
        $value = 'a,342 , c,  def,';
        print_r(Str::toArray($value, ',', ' '));
    }
}