<?php
// Get the input file name from command line arguments or use a default file
$infile = 'input.txt';
$data = trim(file_get_contents($infile));
$lines = explode("\n", $data);

$p1 = 0;
$p2 = 0;

foreach ($lines as $line) {
    $line = trim($line);
    list($one, $two) = explode(',', $line);
    list($s1, $e1) = explode('-', $one);
    list($s2, $e2) = explode('-', $two);

    $s1 = intval($s1);
    $e1 = intval($e1);
    $s2 = intval($s2);
    $e2 = intval($e2);

    // (s2,e2) is fully contained in (s1,e1) if s1<=s2 and e2<=e1
    if (($s1 <= $s2 && $e2 <= $e1) || ($s2 <= $s1 && $e1 <= $e2)) {
        $p1++;
    }

    // (s2,e2) overlaps (s1,e1) if it is not completely to the left or completely to the right
    if (!($e1 < $s2 || $s1 > $e2)) {
        $p2++;
    }
}

echo $p1 . "<br/>";
echo $p2 . "<br/>";