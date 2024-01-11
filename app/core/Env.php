<?php
namespace App\Core;

class Env {
    public static function get(string $env_name): string {
        $value = getenv($env_name);

        if ($value === false) {
            return '';
        }

        if (is_array($value)) {
            return strval($value[0]);
        }

        return $value;
    }
}