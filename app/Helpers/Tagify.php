<?php

namespace App\Helpers;

class Tagify
{
    public static function toArray($input)
    {
        $tags = [];

        $array = json_decode($input, true) ?? [];

        foreach($array as $tag) {
            $tags[] = $tag["value"];
        }

        return $tags;
    }
}