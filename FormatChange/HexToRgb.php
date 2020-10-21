<?php

namespace FormatChange;

class HexToRgb
{
    public const DEFAULT = 'rgb( 0, 0, 0 )';
    /**
     * Converts Hex color values into rgba format.
     *
     * @param string $hexCode
     * @param bool $opacity
     * @return string
     */
    public function hexCodeToRgbCode($hexCode, $opacity = false)
    {
        $default = 'rgb( 0, 0, 0 )';

        // can be write a validate helper here
        if (empty($hexCode)
            || false === strpos($hexCode, '#')
            || (strlen($hexCode) !== 6 && strlen($hexCode) !== 3)) {
            return $default;
        }

        // remove caret
        if ($hexCode[0] === '#') {
            $hexCode = substr($hexCode, 1);
        }

        // check if short hex code
        if (strlen($hexCode) === 3) {
            $hexCode = $this->extendingShortHexToLongHexCode($hexCode);
        }

        $this->validationHexColor($hexCode);

        $hexCodeArray = str_split($hexCode, 2);

        $hexCodeArray = array_map('hexdec', $hexCodeArray);

        $hexCodeArray['opacity'] = (float)$opacity;

        return "rgb($hexCodeArray[0], $hexCodeArray[1], $hexCodeArray[2], $hexCodeArray[$opacity])";
    }

    /**
     * Validating hex color value by length.
     * @param string $hexCode
     * @throws Error
     */
    public function validationHexColor($hexCode)
    {
        // hex length validation
        if (6 !== strlen($hexCode)) {
            throw new Error('should be 6 digits long!');
        }
    }

    /**
     * Converting into six digits.
     *
     * @param string $hexCode
     * @return string
     */
    public function extendingShortHexToLongHexCode($hexCode): string
    {
        return $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
    }
}