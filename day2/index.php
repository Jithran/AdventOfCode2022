<?php
echo '<pre>';

$input = file_get_contents('input.txt');

$aLines = explode("\r\n", $input);

// build a matrix of possibilities
// A X == Rock
// B Y == Paper
// C Z == Scissors
$matrix = [
    'A X' => 4,
    'A Y' => 8,
    'A Z' => 3,
    'B X' => 1,
    'B Y' => 5,
    'B Z' => 9,
    'C X' => 7,
    'C Y' => 2,
    'C Z' => 6,
];

$sum = 0;
foreach ($aLines as $line) {
    if(empty(trim($line))) {
        continue;
    }

    $sum += $matrix[$line];
}


echo 'Sum: ' . $sum;

/***********************************************************************************************************************
 * PART 2
 **********************************************************************************************************************/

// points for the played hand
$points = [
    'A' => 1,
    'B' => 2,
    'C' => 3,
];

// points for the outcome: lose, tie, win
$outcomePoints = [
    'X' => 0,
    'Y' => 3,
    'Z' => 6,
];

$playMatrix = [
    'A' => [
        'X' => 'C',
        'Y' => 'A',
        'Z' => 'B',
    ],
    'B' => [
        'X' => 'A',
        'Y' => 'B',
        'Z' => 'C',
    ],
    'C' => [
        'X' => 'B',
        'Y' => 'C',
        'Z' => 'A',
    ],
];

$sum = 0;
foreach($aLines as $line) {
    if(empty(trim($line))) {
        continue;
    }

    list($elf, $me) = explode(' ', $line);

    // add the outcome points to the sum
    $sum += $outcomePoints[$me];

    // add the points for the played hand to the sum
    $sum += $points[$playMatrix[$elf][$me]];
}

echo '<br/><br/>Sum for part 2: ' . $sum;


