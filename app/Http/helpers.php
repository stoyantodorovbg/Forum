<?php

if (!function_exists('label')) {
    function label($systemName)
    {
        $label = \App\Models\Label::where('system_name', $systemName)->first();

        if($label) {
            if(isset($_COOKIE['language']) && $translation = $label->getTranslation($_COOKIE['language'])) {
                return $translation;
            }

            return $label->default_content;
        }

        return $systemName;
    }
}