<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Throwable;

class TodoController extends Controller
{

    public readonly Model $model;
    public function __construct()
    {
        $this->model = new Todo();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->except(['_method', '_token']);
        $response = $this->model->create($fields);

        if ($response) {
            return json_encode(['message' => 'Criado com sucesso']);
        }

        return json_encode(['message' => 'Erro ao tentar cadastrar']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $fields = $request->except(['_method', '_token']);

            $response = $this->model->where('id', $id)->update($fields);

            if (!$response) throw new Exception("Item não encontrado, id: $id");

            return json_encode(['message' => 'Atualizado com sucesso', 'data' => $response]);
        } catch (Throwable $e) {
            return json_encode(['message' => $e->getMessage(), 'data' => null]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $response = $this->model->destroy($id);

            if (!$response) throw new Exception("Item não encontrado, id: $id");

            return json_encode(['message' => 'Removido com sucesso', 'data' => $response]);
        } catch (Throwable $e) {
            return json_encode(['message' => $e->getMessage(), 'data' => null]);
        }
    }
}