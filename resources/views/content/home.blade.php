@extends('layout/master')

@section('scripts')
    <script src="{{ asset('assets/js/todo-list.js') }}"></script>
    <script></script>
@endsection

@section('content')
    @php
        $center = '';
    @endphp

    <?php 
    /**
     * Template da linha da tarefa
     * */
    function todoRow($id = 0, $checked = false, $title = ''){ ?>
    <div class="col-sm-12 mt-1 todo-row">
        <div class="d-flex">
            <div class="col-sm-1 d-flex justify-content-center align-items-center">
                <input type="checkbox" class="form-check-input m-0 todo-checkbox" style="width:16px; height:16px;"
                    {{ $checked ? 'checked' : '' }} data-route="{{ route('todo.update', ['todo' => $id]) }}">
            </div>
            <div class="col-sm-10 d-flex align-items-center">
                <div class="fs-6 border-bottom text-truncate todo-name flex-grow-1"
                    title="{{ strlen($title) > 60 ? $title : '' }}">
                    {{ $title }}
                </div>
            </div>
            <div class="col-sm-1 d-flex justify-content-center align-items-center">
                <div style="transform: scale(0.5);">
                    <button class="btn btn-outline-danger todo-delete-btn" type="button"type="button"
                        data-route="{{ route('todo.destroy', ['todo' => $id]) }}">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="section-wrapper col-md-6">
        <div class="todo-container">
            <div class="page-header container">
                <div class="float-end">
                    <span class="badge rounded-circle bg-primary todos-all" data-toggle="tooltip" data-placement="bottom"
                        title="Total de tarefas"></span>
                    <span class="badge rounded-circle bg-warning todos-pending" data-toggle="tooltip"
                        data-placement="bottom" title="Tarefas pendentes"></span>
                    <span class="badge rounded-circle bg-success todos-conclude" data-toggle="tooltip"
                        data-placement="bottom" title="Tarefas concluidas"></span>
                </div>
                <h4 class="page-header mb-1 text-body-secondary">Tarefas</h4>
            </div>
            <div class="col-sm-12 p-2 rounded shadow" style="background-color: #f5f5f5">
                <div style="position: relative"></div>
                <div class="todo-template" style="display: none"> {{-- UTILIZADO PELO JS PARA CAPTURAR A FORMTAÇÃO DA LINHA --}}
                    @php
                        todoRow();
                    @endphp
                </div>
                <div class="todo-list">
                    @foreach ($todos as $todo)
                        @php
                            todoRow($todo->id, $todo->completed, $todo->name);
                        @endphp
                    @endforeach
                </div>
                <div class="add-todo">
                    <div class="col-sm-12 mt-1">
                        <div class="d-flex">
                            <div class="col-sm-1  d-flex justify-content-center align-items-center">
                            </div>
                            <div class="col-sm-10">
                                <input type="text"class=" w-100 h-100 form-control form-control-sm" maxlength="60"
                                    placeholder="Adicionar Tarefa" name="name" id="todo-name-input">
                            </div>
                            <div class="col-sm-1  d-flex justify-content-center align-items-center">
                                <div style="transform: scale(0.5)">
                                    <button class="btn btn-success add-todo-btn" type="button"
                                        data-route={{ route('todo.store') }}>
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
