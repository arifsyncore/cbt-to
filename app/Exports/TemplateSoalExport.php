<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TemplateSoalExport implements FromView
{
    public function view(): View
    {
        return view('admin.bank-soal.components.template-import-soal');
    }
}
