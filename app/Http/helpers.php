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

if (!function_exists('getLanguages')) {
    function getLanguages()
    {
        return \App\Models\Language::where('status', 1)->get();
    }
}

if (!function_exists('translateProp')) {
    function translateProp($modelName, $id, $prop)
    {
        if (isset($_COOKIE['language'])) {
            $modelTranslationPath = '\App\Models\\' . $modelName . 'Translation';
            $translation = $modelTranslationPath::where(strtolower($modelName) . '_id', $id)
                ->where('language_id', $_COOKIE['language'])
                ->first();
        }

        if($translation) {
            return $translation->$prop;
        }

        $modelPath = '\App\Models\\' . $modelName;
        $model = $modelPath::find($id);

        return $model->$prop;
    }
}