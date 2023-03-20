<?php

namespace Faker\Provider\en_US;

class PhoneNumber extends \Faker\Provider\PhoneNumber

{
    /**
     * @var array<int, string>
     */
    protected static $areaCodeRegexes = [
        2 => '(0[1-35-9]|1[02-9]|2[03-589]|3[149]|4[08]|5[1-46]|6[0279]|7[0269]|8[13])',
        3 => '(0[1-57-9]|1[02-9]|2[0135]|3[0-24679]|4[167]|5[12]|6[014]|8[056])',
        4 => '(0[124-9]|1[02-579]|2[3-5]|3[0245]|4[0235]|58|6[39]|7[0589]|8[04])',
        5 => '(0[1-57-9]|1[0235-8]|20|3[0149]|4[01]|5[19]|6[1-47]|7[013-5]|8[056])',
        6 => '(0[1-35-9]|1[024-9]|2[03689]|[34][016]|5[017]|6[0-279]|78|8[0-29])',
        7 => '(0[1-46-8]|1[2-9]|2[04-7]|3[1247]|4[037]|5[47]|6[02359]|7[02-59]|8[156])',
        8 => '(0[1-68]|1[02-8]|2[08]|3[0-28]|4[3578]|5[046-9]|6[02-5]|7[028])',
        9 => '(0[1346-9]|1[02-9]|2[0589]|3[0146-8]|4[0179]|5[12469]|7[0-389]|8[04-69])',
    ];

    /**
     * @see https://en.wikipedia.org/wiki/Telephone_numbers_in_Iraq
     */
    protected static $formats = [
        // International format
        '+964-{{areaCode}}-{{exchangeCode}}-####',
        '+964 ({{areaCode}}) {{exchangeCode}}-####',
        '+964-{{areaCode}}-{{exchangeCode}}-####',
        '+964.{{areaCode}}.{{exchangeCode}}.####',
        '+964{{areaCode}}{{exchangeCode}}####',

        // Standard formats
        '{{areaCode}}-{{exchangeCode}}-####',
        '({{areaCode}}) {{exchangeCode}}-####',
        '964-{{areaCode}}-{{exchangeCode}}-####',
        '{{areaCode}}.{{exchangeCode}}.####',

        '{{areaCode}}-{{exchangeCode}}-####',
        '({{areaCode}}) {{exchangeCode}}-####',
        '964-{{areaCode}}-{{exchangeCode}}-####',
        '{{areaCode}}.{{exchangeCode}}.####',
    ];

    protected static $formatsWithExtension = [
        '{{areaCode}}-{{exchangeCode}}-#### x###',
        '({{areaCode}}) {{exchangeCode}}-#### x###',
        '964-{{areaCode}}-{{exchangeCode}}-#### x###',
        '{{areaCode}}.{{exchangeCode}}.#### x###',

        '{{areaCode}}-{{exchangeCode}}-#### x####',
        '({{areaCode}}) {{exchangeCode}}-#### x####',
        '964-{{areaCode}}-{{exchangeCode}}-#### x####',
        '{{areaCode}}.{{exchangeCode}}.#### x####',

        '{{areaCode}}-{{exchangeCode}}-#### x#####',
        '({{areaCode}}) {{exchangeCode}}-#### x#####',
        '964-{{areaCode}}-{{exchangeCode}}-#### x#####',
        '{{areaCode}}.{{exchangeCode}}.#### x#####',
    ];

    protected static $e164Formats = [
        '+964{{areaCode}}{{exchangeCode}}####',
    ];

    /**
     * @see https://en.wikipedia.org/wiki/Toll-free_telephone_number#United_States
     */
    protected static $tollFreeAreaCodes = [
        770, 750, 773, 771, 751,
    ];
    protected static $tollFreeFormats = [
        // Standard formats
        '{{tollFreeAreaCode}}-{{exchangeCode}}-####',
        '({{tollFreeAreaCode}}) {{exchangeCode}}-####',
        '964-{{tollFreeAreaCode}}-{{exchangeCode}}-####',
        '{{tollFreeAreaCode}}.{{exchangeCode}}.####',
    ];

    public function tollFreeAreaCode()
    {
        return self::randomElement(static::$tollFreeAreaCodes);
    }

    public function tollFreePhoneNumber()
    {
        $format = self::randomElement(static::$tollFreeFormats);

        return self::numerify($this->generator->parse($format));
    }

    /**
     * @return string
     *
     * @example '555-123-546 x123'
     */
    public function phoneNumberWithExtension()
    {
        return static::numerify($this->generator->parse(static::randomElement(static::$formatsWithExtension)));
    }

    /**
     * NPA-format area code
     *
     * @see https://en.wikipedia.org/wiki/North_American_Numbering_Plan#Numbering_system
     *
     * @return string
     */
    public static function areaCode()
    {
        $firstDigit = self::numberBetween(2, 9);

        return $firstDigit . self::regexify(self::$areaCodeRegexes[$firstDigit]);
    }

    /**
     * NXX-format central office exchange code
     *
     * @see https://en.wikipedia.org/wiki/North_American_Numbering_Plan#Numbering_system
     *
     * @return string
     */
    public static function exchangeCode()
    {
        $digits[] = self::numberBetween(2, 9);
        $digits[] = self::randomDigit();

        if ($digits[1] === 1) {
            $digits[] = self::randomDigitNot(1);
        } else {
            $digits[] = self::randomDigit();
        }

        return implode('', $digits);
    }
}
