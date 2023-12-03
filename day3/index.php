<?php
echo '<pre>';

$input = file_get_contents('input.txt');

$sum = 0;
$sumPart2 = 0;
$group = [];

$aLines = explode("\r\n", $input);

foreach ($aLines as $index => $line) {
    if(empty(trim($line))) {
        continue;
    }

    $sum += calculateLine($line);

    preparePart2($index, $line);
}

echo 'Sum: ' . $sum;


// process part 2
foreach($group as $groupIndex => $groupLines) {
    // determain which character is the same in all 3 lines
    $sameCharacter = null;
    for($i = 0; $i < strlen($groupLines[0]); $i++) {
        if(strpos($groupLines[1], $groupLines[0][$i]) !== false && strpos($groupLines[2], $groupLines[0][$i]) !== false) {
            $sameCharacter = $groupLines[0][$i];
        }
    }

    $sumPart2 += getCharacterPoints($sameCharacter);
}

echo '<br/>Part 2 sum: ' . $sumPart2;


function calculateLine($line) {
    // split the line in half
    $part1 = substr($line, 0, strlen($line) / 2);
    $part2 = substr($line, strlen($line) / 2);

    // which characters are the same in part1 and part 2
    $sameCharacter = null;
    for($i = 0; $i < strlen($part1); $i++) {
        if(strpos($part2, $part1[$i]) !== false) {
            $sameCharacter = $part1[$i];
        }
    }

    // each character has points a-z = 1-26 and A-Z = 27-52
    // calculate the points for the same character and add them to the sum
    return getCharacterPoints($sameCharacter);

}


function preparePart2($index, $line) {
    global $group;
    // we need to group 3 lines together
    // if the index is divisible by 3, we need to start a new group
    // if the index is not divisible by 3, we need to add the line to the current group
    $group[floor($index/3)][] = $line;
}

function getCharacterPoints($character) {
    $points = 0;
    if(ctype_upper($character)) {
        $points = ord($character) - 64 + 26;
    } else {
        $points = ord($character) - 96;
    }

    return $points;
}