<?php
echo '<pre>';

$input = file_get_contents('input.txt');
$aLines = explode("\r\n", $input);

$elvesOnShelves = [1 => 0];

$i = 1;
foreach($aLines AS $line) {
    if((int)$line > 0) {
        $elvesOnShelves[$i] += (int)$line;
    } else {
        $i++;
        $elvesOnShelves[$i] = 0;
    }
}

$highestValue = max($elvesOnShelves);
echo 'Highest value: ' . $highestValue . '<br/>';

arsort($elvesOnShelves);

$sum = 0;
for($i = 0; $i < 3; $i++) {
    $sum += array_values($elvesOnShelves)[$i];
}

echo 'Sum of the top 3 values for part 2: ' . $sum . '<br/>';

echo '<pre>'.print_r($elvesOnShelves, true).'</pre>';
exit;
