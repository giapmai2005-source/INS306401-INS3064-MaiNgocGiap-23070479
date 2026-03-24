<?php
function calculateBMI($kg, $m) {
    $bmi = $kg / ($m * $m);

    if ($bmi < 18.5) {
        $cat = "Under";
    } elseif ($bmi < 25) {
        $cat = "Normal";
    } else {
        $cat = "Over";
    }

    return "BMI: " . round($bmi, 1) . " ($cat)";
}

$weight = 65;
$height = 1.71;

echo calculateBMI($weight, $height);
?>
