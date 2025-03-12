<?php

// Variable
$nama = "Tri Susilowati";
$usia = 21;
echo "nama: " .$nama . "<br>";
echo "usia: " .$usia . "<br>" ; 

// Konstanta
define("SITE_NAME", "Belajar PHP");
echo "Nama Situs: " . SITE_NAME . "<br>";

// Tipe Data Integer
$angka = 100;
echo "angka: " .$angka . "<br>" ; 

// Tipe Data String
$teks = "Hello, World!";
echo "teks: " .$teks . "<br>" ; 

// Tipe Data Float
$desimal = 3.14;
echo "desimal: " .$desimal . "<br>" ; 

// Operator Aritmatika

$a = 10;
$b = 5;

$tambah = $a + $b;
$kurang = $a - $b;
$kali = $a * $b;
$bagi = $a / $b;
$sisa = $a % $b;

echo "Nilai a: $a <br>";
echo "Nilai b: $b <br>";
echo "Hasil Penjumlahan: $tambah <br>";
echo "Hasil Pengurangan: $kurang <br>";
echo "Hasil Perkalian: $kali <br>";
echo "Hasil Pembagian: $bagi <br>";
echo "Sisa Pembagian: $sisa <br>";

// Operator Logika
$x = true;
$y = false;
$hasil_and = $x && $y;
$hasil_or = $x || $y;
$hasil_not = !$x;
echo "Hasil AND: " . ($hasil_and ? "true" : "false") . "<br>";
echo "Hasil OR: " . ($hasil_or ? "true" : "false") . "<br>";
echo "Hasil NOT: " . ($hasil_not ? "true" : "false") . "<br>";

// Struktur Logika IF
if ($usia >= 18) {
    echo "Anda sudah dewasa.<br>";
} else {
    echo "Anda masih anak-anak.<br>";
}

// Struktur Logika Switch
$hari = "Senin";
switch ($hari) {
    case "Senin":
        echo "Hari ini adalah Senin.<br>";
        break;
    case "Selasa":
        echo "Hari ini adalah Selasa.<br>";
        break;
    default:
        echo "Hari tidak diketahui.<br>";
}


// Perulangan For
for ($i = 1; $i <= 5; $i++) {
    echo "Perulangan ke- $i<br>";
}

// Perulangan Foreach
$buah = ["Apel", "Jeruk", "Mangga"];
foreach ($buah as $item) {
    echo "Buah: $item<br>";
}

// Perulangan While
$j = 1;
while ($j <= 3) {
    echo "While ke- $j<br>";
    $j++;
}

// Penulisan Function
function sapa($nama) {
    return "Halo, $nama!<br>";
}

echo sapa("Budi");

?>

