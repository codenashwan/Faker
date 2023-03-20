<?php

namespace Faker\Provider\ar_CKB;

class PhoneNumber extends \Faker\Provider\PhoneNumber

{
    /**
     * @see https://en.wikipedia.org/wiki/Telephone_numbers_in_Iraq
     */
    protected static $formats = [
        '+964 770 ### ####',
        '+964 771 ### ####',
        '+964 773 ### ####',
        '+964 750 ### ####',
        '+964 751 ### ####',
    ];
}
