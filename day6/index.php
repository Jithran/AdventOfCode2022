<?php
echo '<pre>';

$input = file_get_contents('input.txt');

// Part 1
$buffer = '';
for ($i = 0; $i < strlen($input); $i++) {
    $character = $input[$i];

    $buffer = processPacketMarker($buffer, $character, $i, 4);

    if ($buffer === true) {
        break;
    }
}

// Part 2
$buffer = '';
for ($i = 0; $i < strlen($input); $i++) {
    $character = $input[$i];

    $buffer = processPacketMarker($buffer, $character, $i, 14);

    if ($buffer === true) {
        break;
    }
}
function processPacketMarker($buffer, $character, $i, $length): true|string
{
    $buffer .= $character;

    // if buffer is longer than $length characters, remove the first character
    if (strlen($buffer) > $length) {
        $buffer = substr($buffer, 1);
    }

    if (strlen($buffer) == $length) {
        if (checkUnique($buffer)) {

            echo $buffer . ' is unique' . PHP_EOL;
            echo 'Index at: ' . ($i + 1) . PHP_EOL . PHP_EOL;
            return true;
        }
        return $buffer;
    }
    return $buffer;
}


function checkUnique($string): bool
{
    $characters = str_split($string);
    $uniqueCharacters = array_unique($characters);
    return count($characters) == count($uniqueCharacters);
}