<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Exibir a lista de colaboradores.
     */
    public function index()
    {
        $colaboradores = Colaborador::all();
        return view('colaboradores.index', compact('colaboradores'));
    }

    /**
     * Mostrar o formulário de criação de um novo colaborador.
     */
    public function create()
    {
        $setores = ['Tecnologia', 'Administrativo', 'Projeto'];
        $cidades = $this->capitaisBrasil();
        return view('colaboradores.create', compact('setores', 'cidades'));
    }

    /**
     * Armazenar um novo colaborador no banco.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'setor' => 'required|in:Tecnologia,Administrativo,Projeto',
            'cidade' => 'required|string',
            'data_checkin' => 'required|date',
        ]);

        Colaborador::create($request->all());

        return redirect()->route('colaboradores.index')
                         ->with('success', 'Colaborador cadastrado com sucesso!');
    }

    /**
     * Mostrar o formulário de edição de um colaborador.
     */
    public function edit(Colaborador $colaborador)
    {
        $setores = ['Tecnologia', 'Administrativo', 'Projeto'];
        $cidades = $this->capitaisBrasil();
        return view('colaboradores.edit', compact('colaborador', 'setores', 'cidades'));
    }

    /**
     * Atualizar um colaborador existente no banco.
     */
    public function update(Request $request, Colaborador $colaborador)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'setor' => 'required|in:Tecnologia,Administrativo,Projeto',
            'cidade' => 'required|string',
            'data_checkin' => 'required|date',
        ]);

        $colaborador->update($request->all());

        return redirect()->route('colaboradores.index')
                         ->with('success', 'Colaborador atualizado com sucesso!');
    }

    /**
     * Remover um colaborador do banco.
     */
    public function destroy(Colaborador $colaborador)
    {
        $colaborador->delete();

        return redirect()->route('colaboradores.index')
                         ->with('success', 'Colaborador removido com sucesso!');
    }

    /**
     * Lista de todas as capitais do Brasil.
     */
    private function capitaisBrasil()
    {
        return [
            'Aracaju', 'Belém', 'Belo Horizonte', 'Boa Vista', 'Brasília', 'Campo Grande',
            'Cuiabá', 'Curitiba', 'Florianópolis', 'Fortaleza', 'Goiânia', 'João Pessoa',
            'Macapá', 'Maceió', 'Manaus', 'Natal', 'Palmas', 'Porto Alegre', 'Porto Velho',
            'Recife', 'Rio Branco', 'Rio de Janeiro', 'Salvador', 'São Luís', 'São Paulo',
            'Teresina', 'Vitória'
        ];
    }
}
