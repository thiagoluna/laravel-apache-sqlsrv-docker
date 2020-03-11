<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\User;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipes = Equipe::paginate(5);

        $equipe = Equipe::find(4);        
        //$servidores = $equipe->servidores()->get();        
        return view('equipe.index', compact('equipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->_validate($request);
        $dados = $request->all();
        Equipe::create($dados);
        return redirect()->route('equipe.index')->with('message','Equipe cadastrada com sucesso!');
    }

    public function busca(Request $request){
        $criterio = $request->criterio;        
        $equipes = Equipe::where('nome', 'LIKE', '%' . $criterio . '%')->paginate(5);
        return view('equipe.index', compact('equipes', 'criterio'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function show(Equipe $equipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipe $equipe) //Route Model Binding
    {        
        return view('equipe.edit', compact('equipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipe $equipe)
    {
        $this->_validate($request);
        $dados = $request->all();
        $equipe->fill($dados);
        $equipe->save(); //Mass Assigment

        return redirect()->route('equipe.index')->with('message','Equipe atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipe $equipe)
    {
        $equipe->delete();
        return redirect()->route('equipe.index')->with('message','Equipe excluida com sucesso!');
    }

    public function _validate($request)
    {        
        $messages = [
            'required' => 'Campo :attribute obrigatório.',
            'date_equals' => 'As DATAS de Nascimento devem ser iguais.',
            'min' => ['numeric' => 'A idade deve ser a partir de 4 anos.']
        ];

        $this->validate($request, [
            'nome'           =>  'required|max:190',
            //'email'          =>  'required|email|max:190|unique:users',
            //'password'       =>  'required|max:190',
            //'dt_nascimento'  =>  'required|date_format:Y-m-d',
            //'dt_nascimento2' =>  'required|date_format:Y-m-d|date_equals:dt_nascimento',
            //'idade'          =>  'numeric|min:4'
        ], $messages); 
    }
}
