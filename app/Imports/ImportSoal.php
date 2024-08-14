<?php

namespace App\Imports;

use App\Models\admin\MSoal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSoal implements ToModel, WithHeadingRow
{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function model(array $row)
    {
        return new MSoal([
            'id_bank_soal' => $this->request->id_bank,
            'id_jenis_det' => $this->request->id_jenis,
            'nomor_soal' => $row['nomor'],
            'soal' => $row['soal'],
            'opsi_a' => $row['jawaban_a'],
            'opsi_b' => $row['jawaban_b'],
            'opsi_c' => $row['jawaban_c'],
            'opsi_d' => $row['jawaban_d'],
            'opsi_e' => $row['jawaban_e'],
            'jawaban' => $row['jawaban_benar'],
        ]);
    }
}
