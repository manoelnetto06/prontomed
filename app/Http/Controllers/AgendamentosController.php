<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Agendamento;
use App\Paciente;

class AgendamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendamentos = Agendamento::with('Paciente')->orderBy('id', 'desc')->get();

        return json_encode($agendamentos);
    }

    public function indexView()
    {
        return view('agendamentos');
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
        $agenda = new Agendamento();

        if (isset($agenda))
        {
            $pac = Paciente::find($request->input('paciente_id'));

            $agenda->data        = $request->input('data');
            $agenda->paciente_id = $request->input('paciente_id');

            $agenda->paciente()->associate($pac);

            $agenda->save();

            return json_encode($agenda);
        }

        return response('Erro ao criar o agendamento', 404);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agend = Agendamento::where('paciente_id', $id)->get();

        if (isset($agend))
        {
            return json_encode($agend);
        }

        return response('Agendamento não encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agend = Agendamento::find($id);

        if (isset($agend))
        {
            return json_encode($agend);
        }

        return response('Agendamento não encontrado', 404);
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
        $agend = Agendamento::find($id);

        if (isset($agend))
        {
            $pac = Paciente::find($request->input('paciente_id'));

            $agend->data        = $request->input('data');
            $agend->paciente_id = $request->input('paciente_id');

            $agend->paciente()->associate($pac);

            $agend->save();

            return json_encode($agend);
        }

        return response('Agendamento não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agend = Agendamento::find($id);

        if (isset($agend))
        {
            $agend->delete();

            return response('OK', 200);
        }

        return response('Agendamento não encontrado', 404);
    }
}
