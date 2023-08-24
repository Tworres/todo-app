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

    public function get()
    {
        try {
            $response = $this->model->all();

            return json_encode(['message' => 'Requisitado com sucesso', 'data' => $response]);
        } catch (Throwable $e) {
            return json_encode(['message' => $e->getMessage(), 'data' => null]);
        }
    }

    /**
     * Guarda uma tarefa no banco de dados
     * 
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        try {
            $fields = $request->except(['_method', '_token']);

            $response = $this->model->create($fields);

            return json_encode(['message' => 'Armazenado com sucesso', 'data' => $response]);
        } catch (Throwable $e) {
            return json_encode(['message' => $e->getMessage(), 'data' => null]);
        }
    }


    /**
     * Atualiza uma tarefa no banco de dados
     * 
     * @param Request $request
     * @param string $id
     * @return string
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
     * remove uma tarefa no banco de dados
     * 
     * @param string $id
     * @return string
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
