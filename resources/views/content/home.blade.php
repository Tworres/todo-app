@extends('layout/master')

@section('content')
    @php
        $center = 'd-flex justify-content-center align-items-center';
        
        $todos = [(object) ['id' => 1, 'completed' => false, 'name' => 'teste1'], (object) ['id' => 2, 'completed' => false, 'name' => 'teste2'], (object) ['id' => 3, 'completed' => true, 'name' => 'teste3']];
    @endphp
    <div class="section-wrapper col-md-6">
        <div class="page-header container">
            <div class="float-end">
                <span class="badge rounded-circle bg-primary">3</span>
                <span class="badge rounded-circle bg-success">0</span>
            </div>
            <h4 class="page-header mb-1 text-body-secondary">Tarefas</h4>
        </div>
        <div class="col-md-12 p-2 rounded shadow" style="background-color: #f5f5f5">
            <div class="list">
                @foreach ($todos as $todo)
                    <div class="col-md-12 mt-1" id="todo-{{ $todo->id }}">
                        <div class="d-flex">
                            <div class="col-md-1 {{ $center }}">
                                <input type="checkbox" class="form-check-input m-0" style="width:16px; height:16px;">
                            </div>
                            <div class="col-md-10">
                                <div class="fs-6 border-bottom">{{ $todo->name }}</div>
                            </div>
                            <div class="col-md-1 {{ $center }}">
                                <button class="btn btn-outline-danger p-0" style="width:18px; height:18px;" type="button">
                                    <div class="w-100 h-100 {{ $center }}" style="font-size: 0.7em">x</div>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="add-todo mt-1">
                <div class="col-md-12">
                    <div class="d-flex">
                        <div class="col-md-1 {{ $center }}">
                            <input type="checkbox" class="form-check-input m-0 visually-hidden"
                                style="width:16px; height:16px;">
                        </div>
                        <div class="col-md-10">
                            <input type="text"class=" w-100 h-100 form-control form-control-sm">
                        </div>
                        <div class="col-md-1 {{ $center }}">
                            <button class="btn btn-success p-0" style="width:18px; height:18px;" type="button">
                                <div class="w-100 h-100 {{ $center }}" style="font-size: 0.8em">+</div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
