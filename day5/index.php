<?php
echo '<pre>';

$input = file_get_contents('input.txt');
$lines = explode("\r\n", $input);

$stack = [];
$lineNr = 0;
foreach ($lines as $lineNr => $line) {
    foreach (str_split($line) as $index => $character) {
        if (!ctype_alpha($character)) {
            continue;
        }

        $characters[($index + 3) / 4][] = $character;
    }

    $stack = $characters;
    ksort($stack);
    if (empty(trim($line))) {
        break;
    }
}

foreach ($stack as $index => $characters) {
    $stack[$index] = array_reverse($characters);
}

$stackPart2 = $stack;

for ($i = $lineNr + 1; $i < count($lines); $i++) {
    preg_match('/move (\d+) from (\d+) to (\d+)/', $lines[$i], $matches);

    $stack      = moveNodes($matches[1], $matches[2], $matches[3], $stack);
    $stackPart2 = moveNodes($matches[1], $matches[2], $matches[3], $stackPart2, false);
}

echo '<pre>' . print_r($stack, true) . '</pre>';
echo '<pre>' . print_r('Part1: ' . getTopNodes($stack), true) . '</pre>';
echo '<pre>' . print_r('Part2: ' . getTopNodes($stackPart2), true) . '</pre>';

/*****************************************************************************************
 * FUNCTIONS
 ****************************************************************************************/

function moveNodes($amount, $from, $to, $stack, $reverse = true)
{
    $temp = array_splice($stack[$from], count($stack[$from]) - $amount, $amount);

    if($reverse) {
        $temp = array_reverse($temp);
    }

    $stack[$to] = array_merge($stack[$to], $temp);

    return $stack;
}

function getTopNodes($stack): string
{
    $topNodes = [];
    foreach ($stack as $index => $nodes) {
        $topNodes[$index] = $nodes[count($nodes) - 1];
    }

    return implode('', $topNodes);
}

