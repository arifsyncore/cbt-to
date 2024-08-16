<?php

namespace App\Imports;

use App\Models\admin\MJenisUjianDet;
use App\Models\admin\MNilaiJawaban;
use App\Models\admin\MPembahasan;
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
        $jenis = MJenisUjianDet::where('id', $this->request->id_jenis)->first();
        if ($jenis->type_jenis == 'benar_salah') {
            $soal = MSoal::create([
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

            MPembahasan::create([
                'id_soal' => $soal->id,
                'pembahasan' => $row['pembahasan'],
                'gambar' => '',
                'url_video' => $row['url_video']
            ]);
        } else {
            $soal = MSoal::create([
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

            MNilaiJawaban::create([
                'id_soal' => $soal->id,
                'opsi' => 'A',
                'nilai' => $row['nilai_a'],
            ]);

            MNilaiJawaban::create([
                'id_soal' => $soal->id,
                'opsi' => 'B',
                'nilai' => $row['nilai_b'],
            ]);

            MNilaiJawaban::create([
                'id_soal' => $soal->id,
                'opsi' => 'C',
                'nilai' => $row['nilai_c'],
            ]);

            MNilaiJawaban::create([
                'id_soal' => $soal->id,
                'opsi' => 'D',
                'nilai' => $row['nilai_d'],
            ]);

            MNilaiJawaban::create([
                'id_soal' => $soal->id,
                'opsi' => 'E',
                'nilai' => $row['nilai_e'],
            ]);

            MPembahasan::create([
                'id_soal' => $soal->id,
                'pembahasan' => $row['pembahasan'],
                'gambar' => '',
                'url_video' => $row['url_video']
            ]);
        }

        // return new MSoal([
        //     'id_bank_soal' => $this->request->id_bank,
        //     'id_jenis_det' => $this->request->id_jenis,
        //     'nomor_soal' => $row['nomor'],
        //     'soal' => $row['soal'],
        //     'opsi_a' => $row['jawaban_a'],
        //     'opsi_b' => $row['jawaban_b'],
        //     'opsi_c' => $row['jawaban_c'],
        //     'opsi_d' => $row['jawaban_d'],
        //     'opsi_e' => $row['jawaban_e'],
        //     'jawaban' => $row['jawaban_benar'],
        // ]);
    }
}
