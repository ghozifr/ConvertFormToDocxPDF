<?php

function terbilang($number) {
    $words = array(
        '',
        'satu',
        'dua',
        'tiga',
        'empat',
        'lima',
        'enam',
        'tujuh',
        'delapan',
        'sembilan',
        'sepuluh',
        'sebelas'
    );

    if ($number < 12) {
        return $words[$number];
    } elseif ($number < 20) {
        return $words[$number - 10] . ' belas';
    } elseif ($number < 100) {
        return terbilang(floor($number / 10)) . ' puluh' . ($number % 10 > 0 ? ' ' . terbilang($number % 10) : '');
    } elseif ($number < 200) {
        return 'seratus' . ($number > 100 ? ' ' . terbilang($number % 100) : '');
    } elseif ($number < 1000) {
        return terbilang(floor($number / 100)) . ' ratus' . ($number % 100 > 0 ? ' ' . terbilang($number % 100) : '');
    } elseif ($number < 2000) {
        return 'seribu' . ($number > 1000 ? ' ' . terbilang($number % 1000) : '');
    } else {
        return terbilang(floor($number / 1000)) . ' ribu' . ($number % 1000 > 0 ? ' ' . terbilang($number % 1000) : '');
    }
}
