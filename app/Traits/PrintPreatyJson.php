<?php

namespace App\Traits;

trait PrintPreatyJson
{
    public static function print($jsonData)
    {
        $output = "";

        //Initialize variable for adding space
        $space = 0;
        $flag = false;
        //Using <pre> tag to format alignment and font
        $output .= "<pre>";
        //loop for iterating the full json data
        for ($counter = 0; $counter < strlen($jsonData); $counter++) {
            //Checking ending second and third brackets
            if ($jsonData[$counter] == '}' || $jsonData[$counter] == ']') {
                $space--;
                $output .= "\n";
                $output .= str_repeat(' ', ($space * 2));
            }

            //Checking for double quote(“) and comma (,)
            if ($jsonData[$counter] == '"' && ($jsonData[$counter - 1] == ',' || $jsonData[$counter - 2] == ',')) {
                $output .= "\n";
                $output .= str_repeat(' ', ($space * 2));
            }
            if ($jsonData[$counter] == '"' && !$flag) {
                if ($jsonData[$counter - 1] == ':' || $jsonData[$counter - 2] == ':') {
                    //Add formatting for question and answer
                    $output .= '<span style="color:blue;font-weight:bold">';
                } else {
                    //Add formatting for answer options
                    $output .= '<span style="color:red">';
                }
            }
            $output .= $jsonData[$counter];
            //Checking conditions for adding closing span tag
            if ($jsonData[$counter] == '"' && $flag) {
                $output .= '</span>';
            }
            if ($jsonData[$counter] == '"') {
                $flag = !$flag;
            }
            //Checking starting second and third brackets
            if ($jsonData[$counter] == '{' || $jsonData[$counter] == '[') {
                $space++;
                $output .= "\n";
                $output .= str_repeat(' ', ($space * 2));
            }
        }
        $output .= "</pre>";

        return $output;
    }
}
