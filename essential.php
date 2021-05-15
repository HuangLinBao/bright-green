<?php
function addClass($htmlString = '', $newClass) {
    $pattern = '/class="([^"]*)"/';

    // class attribute set
    if (preg_match($pattern, $htmlString, $matches)) {
        $definedClasses = explode(' ', $matches[1]);
        if (!in_array($newClass, $definedClasses)) {
            $definedClasses[] = $newClass;
            $htmlString = str_replace($matches[0], sprintf('class="%s"', implode(' ', $definedClasses)), $htmlString);
        }
    }

    // class attribute not set
    else {
        $htmlString = preg_replace('/(\<.+\s)/', sprintf('$1class="%s" ', $newClass), $htmlString);
    }

    return $htmlString;
}

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
?>