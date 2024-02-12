<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Courier;
            white-space: break-spaces;
        }
    </style>
</head>
<body>

<?php

// Zadanie #1

$keys = [
    '!' => 'a',
    ')' => 'b',
    '"' => 'c',
    '(' => 'd',
    '£' => 'e',
    '*' => 'f',
    '%' => 'g',
    '&' => 'h',
    '>' => 'i',
    '<' => 'j',
    '@' => 'k',
    'a' => 'l',
    'b' => 'm',
    'c' => 'n',
    'd' => 'o',
    'e' => 'p',
    'f' => 'q',
    'g' => 'r',
    'h' => 's',
    'i' => 't',
    'j' => 'u',
    'k' => 'v',
    'l' => 'w',
    'm' => 'x',
    'n' => 'y',
    'o' => 'z'
];

function encryptMessage(string $message, array $keys): string {
    return strtr($message, array_flip($keys));
}

function encodeMessage(string $message, array $keys): string {
    return strtr($message, $keys);
}

echo encodeMessage(')g!ld, j(!ad "> h>£ gdol>!o!" o!(!c>£', $keys);
echo '<hr>';

$additional_message = 'Zażółć, gęślą jaźń.';
$encrypted_message = encryptMessage($additional_message, $keys);
$encoded_message = encodeMessage($encrypted_message, $keys);

echo $additional_message . ' = ' . $encoded_message;
echo 'Czy wiadomość została zakodowana poprawnie? ', $additional_message === $encoded_message ? 'Tak' : 'Nie';
echo '<hr>';

// Zadanie #2

$clock_digits = [
    [
        ' _ ',
        '| |',
        '|_|'
    ],
    [
        '   ',
        '  |',
        '  |'
    ],
    [
        ' _ ',
        ' _|',
        '|_ '
    ],
    [
        ' _ ',
        ' _|',
        ' _|'
    ],
    [
        '   ',
        '|_|',
        '  |'
    ],
    [
        ' _ ',
        '|_ ',
        ' _|'
    ],
    [
        ' _ ',
        '|_ ',
        '|_|'
    ],
    [
        ' _ ',
        '  |',
        '  |'
    ],
    [
        ' _ ',
        '|_|',
        '|_|'
    ],
    [
        ' _ ',
        '|_|',
        ' _|',
    ],
    // for negative numbers
    '-' => [
        '   ',
        ' _ ',
        '   '
    ]
];

function printNumber(string | int $number, array $clock_digits) {
    $digits_to_print = [];
    $final_lines = [];

    if ($number === '') {
        echo 'Podaj przynajmniej jedną cyfrę.';
        return;
    }

    foreach (str_split(strval($number)) as $digit) {
        if (isset($clock_digits[$digit])) {
            $digits_to_print[] = $clock_digits[$digit];
        } else {
            echo "'$digit' Nie jest dozwolonym znakiem.";
            return;
        }
    }

    $maxLines = max(array_map('count', $digits_to_print));

    for ($i = 0; $i < $maxLines; $i++) {
        $line = '';
        foreach ($digits_to_print as $digit) {
            // Append the corresponding character from the digit representation
            // or add whitespace if the digit representation doesn't have a character at this position.
            $line .= isset($digit[$i]) ? $digit[$i] . ' ' : str_repeat(' ', count($digit)) . ' ';
        }
        $final_lines[] = $line;
    }

    echo implode("\r\n", $final_lines);
}

printNumber(5648139072, $clock_digits);

?>

</body>
</html> 
