<?php

namespace RSAB;

if (! defined('ABSPATH')) exit;
class Sanitization
{
    // Sanitize color fields
    public function sanitize_color($input)
    {
        return sanitize_hex_color($input);
    }

    // Sanitize text fields
    public function sanitize_text($input)
    {
        return sanitize_text_field($input);
    }

    // Sanitize integer fields
    public function sanitize_integer($input)
    {
        return absint($input); // Ensures the value is a positive integer
    }

    // Sanitize checkbox (boolean) fields
    public function sanitize_checkbox($input)
    {
        return $input ? 1 : 0;
    }
}
