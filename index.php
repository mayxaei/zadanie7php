<?php
$uczniowie = [
    ["imie" => "Julia",   "punkty" => 96],
    ["imie" => "Bartek",  "punkty" => 73],
    ["imie" => "Natalia", "punkty" => 58],
    ["imie" => "Kuba",    "punkty" => 39],
    ["imie" => "Zosia",   "punkty" => 84]
];

function obliczProcent($punkty)
{
    return $punkty / 100 * 100;
}

function przyznajOcene($punkty)
{
    if ($punkty >= 90) {
        $ocena = 5;
    } elseif ($punkty >= 80) {
        $ocena = 4;
    } elseif ($punkty >= 60) {
        $ocena = 3;
    } elseif ($punkty >= 40) {
        $ocena = 2;
    } else {
        $ocena = 1;
    }
    return $ocena;
}

function czyZdal($punkty)
{
    return $punkty >= 40;
}

$zaliczyli = [];
$niezaliczyli = [];
$wiersze = "";

foreach ($uczniowie as $uczen) {
    $imie = $uczen["imie"];
    $punkty = $uczen["punkty"];

    if (czyZdal($punkty)) {
        $zaliczyli[] = $imie;
        $status = '<td class="zaliczony">ZALICZONY</td>';
    } else {
        $niezaliczyli[] = $imie;
        $status = '<td class="niezaliczony">NIEZALICZONY</td>';
    }

    $wiersze .= "<tr>";
    $wiersze .= "<td>" . $imie . "</td>";
    $wiersze .= "<td>" . $punkty . "</td>";
    $wiersze .= "<td>" . obliczProcent($punkty) . "%</td>";
    $wiersze .= "<td>" . przyznajOcene($punkty) . "</td>";
    $wiersze .= $status;
    $wiersze .= "</tr>\n";
}

$liczbaUczniow = count($uczniowie);
$suma = 0;
for ($i = 0; $i < $liczbaUczniow; $i++) {
    $suma = $suma + $uczniowie[$i]["punkty"];
}
$srednia = $suma / $liczbaUczniow;

switch (true) {
    case $srednia < 40:
        $komentarz = "Bardzo słaby wynik klasy";
        break;
    case $srednia < 60:
        $komentarz = "Wynik klasy jest niezadowalający";
        break;
    case $srednia < 80:
        $komentarz = "Dobry wynik klasy";
        break;
    default:
        $komentarz = "Bardzo dobry wynik klasy";
        break;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadanie 7</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 700px; 
            margin: 30px auto; 
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
        }
        th, td { 
            border: 1px solid black; 
            padding: 8px; 
            text-align: left; 
        }
        .zaliczony { color: green; }
        .niezaliczony { color: red; }
    </style>
</head>
<body>
    <h1>RAPORT WYNIKÓW TESTU</h1>

    <table>
        <tr>
            <th>Imię</th>
            <th>Punkty</th>
            <th>Procent</th>
            <th>Ocena</th>
            <th>Status</th>
        </tr>
        <?= $wiersze ?>
    </table>

    <h2>PODSUMOWANIE KLASY</h2>
    <p>Liczba uczniów: <?= $liczbaUczniow ?></p>
    <p>Suma punktów: <?= $suma ?></p>
    <p>Średnia punktów: <?= $srednia ?></p>
    <p>Zaliczyło: <?= count($zaliczyli) ?> (<?= implode(", ", $zaliczyli) ?>)</p>
    <p>Nie zaliczyło: <?= count($niezaliczyli) ?> (<?= implode(", ", $niezaliczyli) ?>)</p>
    <p><strong>Komentarz: <?= $komentarz ?></strong></p>
</body>
</html>