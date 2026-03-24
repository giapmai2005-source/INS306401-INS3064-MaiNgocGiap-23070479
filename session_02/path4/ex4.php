<?php
$scores = [60, 80, 90, 70, 75];

$sum = array_sum($scores);
$avg = $sum / count($scores);
$max = max($scores);
$min = min($scores);

$top = [];
foreach ($scores as $s) {
    if ($s > $avg) {
        $top[] = $s;
    }
}

echo "Avg: " . round($avg, 1);
echo ", Top: [" . implode(", ", $top) . "]";
?>
