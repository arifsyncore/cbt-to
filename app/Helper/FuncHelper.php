<?php

namespace App\Helpers;

use App\Models\SysLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FuncHelper
{
    public static function test()
    {
        return "test";
    }

    public static function dxInsert(object $table, $param = [], &$newId = 0)
    {
        DB::enableQueryLog();

        $param['user_create'] = Auth::user()->id;
        $isCreated = $table::create($param);

        $query = DB::getQueryLog();
        $query = end($query);

        if ($isCreated) {

            $newId = $isCreated->id;

            //buat log di tabel
            SysLog::create([
                'action' => 'Create',
                'model' => $table->getTable(),
                'data' => json_encode($query),
                'user_create' => Auth::user()->id
            ]);
        }

        return $isCreated;
    }

    public static function dxUpdate(object $table, $where = [], $param = [])
    {
        DB::enableQueryLog();

        $param['user_update'] = Auth::user()->id;

        $updatedRows  = $table::where($where)->update($param);
        $query = DB::getQueryLog();
        $query = end($query);

        if ($updatedRows > 0) {

            //buat log di tabel
            SysLog::create([
                'action' => 'Update',
                'model' => $table->getTable(),
                'data' => json_encode($query)
            ]);
        }

        return $updatedRows;
    }

    public static function dxDelete(object $table, $param = [])
    {
        DB::enableQueryLog();

        $field = isset($param['field']) ? $param['field'] : 'id';

        $table::where($param)->update(['user_delete' => Auth::user()->id]);
        $deletedRows = $table::where($param)->delete();

        $query = DB::getQueryLog();
        $query = end($query);

        if ($deletedRows > 0) {

            //buat log di tabel
            SysLog::create([
                'action' => 'Delete',
                'model' => $table->getTable(),
                'data' => json_encode($query)
            ]);
        }

        return  $deletedRows;
    }

    public static function getNextNo($nomor)
    {
        $hasil         = "";
        $Text         = $nomor;
        $txt         = trim($Text);
        $strLen     = strlen($txt);
        $afterChar     = true;

        for ($i = 0; $i < $strLen; $i++) {

            $karakter = substr($txt, $i, 1);

            if (is_numeric($karakter)) {

                if ($afterChar) {

                    $idx = $i;

                    $hasil = $karakter;
                } else {

                    $hasil = $hasil . $karakter;
                }

                $afterChar = false;
            } else {
                $afterChar = true;
            } //if  (is_int($karakter))

        } //for ($i=1;$i<$strLen;$i++)

        if ($hasil <> "") {
            $akhiran = substr($txt, $idx + strlen($hasil), strlen($txt));

            $strLen = strlen($hasil);

            $hasil = (int)($hasil) + 1;

            if ($strLen > 1) {

                $hasil = str_pad($hasil, $strLen, "0", STR_PAD_LEFT);
            }

            $hasil = substr($txt, 0, $idx) . $hasil . $akhiran;
        } else {
            $hasil = $Text;
        } //if ($hasil <> "")

        return $hasil;
    }
}
