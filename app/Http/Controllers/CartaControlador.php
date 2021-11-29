<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CartaControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartas = Carta::all();
        return $cartas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carta = new Carta();
        $carta->nombre = $request->nombre;
        $carta->ref = $request->ref;
        $carta->titulo = $request->titulo;

        $fecha = date('Y-m-d');
        $carta->fecha = $fecha;

        $carta->comentario = $request->comentario;

        $archivo = $request->file('archivo');
        $nombre = date('YmdHis') . '.' . $archivo->getClientOriginalExtension();
        $archivo->move('assets/', $nombre);
        $carta->archivo = $nombre;

        $carta->save();
        return $carta;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carta = Carta::find($id);
        return $carta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carta = Carta::find($id);
        $carta->nombre = $request->nombre;
        $carta->ref = $request->ref;
        $carta->titulo = $request->titulo;
        $carta->comentario = $request->comentario;

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombre = date('YmdHis') . '.' . $archivo->getClientOriginalExtension();
            $archivo->move('assets/', $nombre);

            $path = 'assets/' . $carta->archivo;

            if (File::exists($path)) {
                File::delete($path);
            }

            $carta->archivo = $nombre;
        }

        $carta->save();
        return $carta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carta = Carta::find($id);

        $path = 'assets/' . $carta->archivo;

        if (File::exists($path)) {
            File::delete($path);
        }

        $carta->delete();
        return $id;
    }

    public function obtenerPorRef($ref)
    {
        $cartas = Carta::where('ref', $ref)->get();
        return $cartas;
    }
}
