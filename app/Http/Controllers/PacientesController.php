<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Paciente;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::orderBy('id', 'desc')->get();

        return json_encode($pacientes);
    }

    public function indexView()
    {
        return view('pacientes');
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
        $paciente = new Paciente();

        $paciente->nome           = $request->input('nome');
        $paciente->telefone       = $request->input('telefone');
        $paciente->dataNascimento = $request->input('dataNascimento');
        $paciente->sexo           = $request->input('sexo');
        $paciente->altura         = $request->input('altura');
        $paciente->peso           = $request->input('peso');

        $paciente->save();

        return json_encode($paciente);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pac = Paciente::find($id);

        if (isset($pac))
        {
            return json_encode($pac);
        }

        return response('Paciente não encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $pac = Paciente::find($id);

        if (isset($pac))
        {
            $pac->nome           = $request->input('nome');
            $pac->telefone       = $request->input('telefone');
            $pac->sexo           = $request->input('sexo');
            $pac->dataNascimento = $request->input('dataNascimento');
            $pac->altura         = $request->input('altura');
            $pac->peso           = $request->input('peso');

            $pac->save();

            return json_encode($pac);
        }

        return response('Paciente não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pac = Paciente::find($id);

        if (isset($pac))
        {
            $pac->delete();

            return response('OK', 200);
        }

        return response('Paciente não encontrado', 404);
    }
}
