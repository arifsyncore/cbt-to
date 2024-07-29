<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timestamp = strtotime('2024-07-28 20:00:00');
        $timestamp = $timestamp + (120 * 60);
        $result = date('Y-m-d H:i:s', $timestamp);
        $now = date("Y-m-d H:i:s");
        $timestampNow =  strtotime($now);
        $hasil = ($timestamp - $timestampNow) * 1000;
        $data = [
            'tanggal_mulai' => '2024-07-28 16:00:00',
            'tanggal_selesai' => $result,
            'timestap' => $timestamp,
            'now' => $now,
            'timestapNow' => $timestampNow,
            'hasil' => $hasil,
        ];
        return view('user.ruang-cbt.index', compact('data'));
    }

    public function addUjian(Request $request)
    {
        DB::transaction(function () use ($request) {
        });
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
