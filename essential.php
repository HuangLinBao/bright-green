<?php

$today = date("d /m /Y");

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

function calculateAge($dob)
{
    //explode the date to get month, day and year
    $dob = explode("/", $dob);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $dob[0], $dob[1], $dob[2]))) > date("md")
      ? ((date("Y") - $dob[2]) - 1)
      : (date("Y") - $dob[2]));
   return $age . " Years";

}
?>