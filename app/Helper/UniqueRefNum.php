<?php

namespace App\Helper;

class UniqueRefNum
{
    public static function generate()
    {
        return uniqid('M1TIX-' . date('Ymd') . '-');
    }
}