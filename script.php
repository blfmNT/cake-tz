<?php

function is_char_upper($c): bool
{
    return (bool) preg_match('~^[А-Я]+$~u', $c);
}

function is_special_symbol($c): bool
{
    return (bool) preg_match('/\p{P}/u', $c);
}

function mb_ucfirtst($str)
{
    $fc = mb_substr($str, 0, 1, 'utf-8');
    $last_part = mb_substr($str, 1, null, 'utf-8');
    return mb_strtoupper($fc, 'utf-8') . mb_strtolower($last_part);
}

function revertCharacters(string $str): string
{
    $words = array_map(function ($n) {
        $chars = mb_str_split($n, 1, 'utf-8');
        $upperfound = false;

        array_walk($chars, function ($c) use (&$upperfound) {
            if (is_char_upper($c)) {
                $upperfound = true;
            }
        });

        $out = array_reverse($chars);

        if (is_special_symbol($out[0])) {
            $p = $out[0];
            array_shift($out);
            array_push($out, $p);
        }

        $retstring = implode('', $out);

        return $upperfound ? mb_ucfirtst($retstring) : $retstring;

    }, explode(' ', $str));

    return implode(' ', $words);
}
