<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Furniture;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::all();

        return response()->json([
            'message' => 'Data Transaksi Sukses Dimuat',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $furniture = Furniture::find($request->id_produk);

        $table = new Transaksi();
        $table->id_customer = $request->user()->id;
        $table->id_produk = $request->id_produk;
        $table->tgl_transaksi = date('Y-m-d H:i:s');
        $table->jumlah = $request->jumlah;
        $table->harga = $furniture->harga * $request->jumlah;
        $table->save();

        return response()->json([
            "message" => "Store success",
            "data" => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaksi::find($id);
        if($data){
            return $data;
        }else {
            return ['message' => 'Data Transaksi tidak ditemukan'];
        }
    }

}
