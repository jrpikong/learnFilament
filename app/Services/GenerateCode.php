<?php


namespace App\Services;


class GenerateCode
{
    static function create($model, $field, $prefix): string
    {
        $AWAL = $prefix;
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = $model::max($field);
        $no = 1;
        if ($noUrutAkhir) {
            return sprintf("%03s", abs((int)$noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        } else {
            return sprintf("%03s", $no) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        }
    }

}
