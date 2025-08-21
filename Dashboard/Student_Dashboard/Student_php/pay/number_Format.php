<?php
function format_NP_Number($number) {
    // Convert to integer to remove decimal part
    $number = (string)(int)$number;

    // Handle last three digits
    $lastThree = substr($number, -3);
    $restUnits = substr($number, 0, -3);

    if ($restUnits != '') {
        $lastThree = ',' . $lastThree;
    }

    // Add commas every 2 digits in the rest of the number
    $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $restUnits);

    return $restUnits . $lastThree;
}
?>
