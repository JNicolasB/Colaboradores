<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Listar todas as tarefas
    public function index()
    {
        return Task::all();
    }

    // Criar uma nova tarefa
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_done' => 'boolean'
        ]);

        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    // Exibir uma tarefa específica
    public function show(Task $task)
    {
        return $task;
    }

    // Atualizar uma tarefa
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_done' => 'boolean'
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    // Deletar uma tarefa
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}

