<?php

use PHPUnit\Framework\TestCase;
use FormatChange\HexToRgb;

class HexToRgbTest extends TestCase
{
    public function testHexCodeConvertedToRgb(): void
    {
        $hexToRgb = new HexToRgb();
        self::assertEquals('rgb(139,0,0,0.8)', $hexToRgb->hexCodeToRgbCode('#8b0', '0.8'));
        self::assertEquals('rgb(139,0,0,1)', $hexToRgb->hexCodeToRgbCode('#8b0000', 1));
        self::assertEquals('rgb(139,0,0,0.9)', $hexToRgb->hexCodeToRgbCode('8b0', '.9'));
        self::assertEquals('rgb(139,0,0,1)', $hexToRgb->hexCodeToRgbCode('8b0000', 1));
    }

    public function testHexCodeLengthValidation(): void
    {
        $validation = new HexToRgb();
        $this->expectException(Error::class);
        $validation->hexCodeToRgbCode('8b00000', 1);
    }

    public function testShortHexCodeTurnedIntoLong(): void
    {
        $new = new HexToRgb();
        self::assertEquals('8b0000', $new->extendingShortHexToLongHexCode('8b0)'));
    }

    public function testHexValidation(): void
    {
        $hexValidation = new HexToRgb();
        $this->expectException(Error::class);
        $hexValidation->hexCodeToRgbCode('8b0000');
    }
}