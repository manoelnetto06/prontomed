<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Consulta;

class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function view($id)
    {
        $consultas = Consulta::where('paciente_id', $id)->orderBy('id', 'desc')->get();

        return view('consultas', ["id" => $id, "consultas" => $consultas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consulta = new Consulta();

        $consulta->data           = $request->input('data');
        $consulta->atendimento    = $request->input('atendimento');
        $consulta->paciente_id    = $request->input('paciente_id');

        $consulta->save();

        return json_encode($consulta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consultas = Consulta::where('paciente_id', $id)->orderBy('id', 'desc')->get();

        if (isset($consultas))
        {
            return json_encode($consultas);
        }

        return response('Consulta não encontrada', 404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $con = Consulta::find($id);

        if (isset($con))
        {
            return json_encode($con);
        }

        return response('Consulta não encontrada', 404);
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
        $cons = Consulta::find($id);

        if (isset($cons))
        {
            $cons->data        = $request->input('data');
            $cons->atendimento = $request->input('atendimento');
            $cons->paciente_id = $request->input('paciente_id');

            $cons->save();

            return json_encode($cons);
        }

        return response('Consulta não encontrada', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $con = Consulta::find($id);

        if (isset($con))
        {
            $con->delete();

            return response('OK', 200);
        }

        return response('Consulta não encontrada', 404);
    }
}
