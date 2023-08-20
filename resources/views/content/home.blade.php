@extends('layout/master')

@section('scripts')
    <script src="{{ asset('assets/js/todo-list.js') }}"></script>
    <script></script>
@endsection

@section('content')
    @php
        $center = 'd-flex justify-content-center align-items-center';
    @endphp
    <div class="section-wrapper col-md-6">
        <div class="todo-container">
            <div class="page-header container">
                <div class="float-end">
                    <span class="badge rounded-circle bg-primary todos-all"></span>
                    <span class="badge rounded-circle bg-warning todos-pending"></span>
                    <span class="badge rounded-circle bg-success todos-conclude"></span>
                </div>
                <h4 class="page-header mb-1 text-body-secondary">Tarefas</h4>
            </div>
            <div class="col-sm-12 p-2 rounded shadow" style="background-color: #f5f5f5">
                <div class="todo-list">
                    @foreach ($todos as $todo)
                        <div class="col-sm-12 mt-1 todo-row" data-route="{{ route('todo.update', ['todo' => $todo->id]) }}">
                            <div class="d-flex">
                                <div class="col-sm-1 {{ $center }}">
                                    <input type="checkbox" class="form-check-input m-0 todo-checkbox"
                                        style="width:16px; height:16px;" {{ $todo->completed ? 'checked' : '' }}>
                                </div>
                                <div class="col-sm-10">
                                    <div class="fs-6 border-bottom text-truncate todo-name"
                                        title="{{ strlen($todo->name) > 60 ? $todo->name : '' }}">{{ $todo->name }}
                                    </div>
                                </div>
                                <div class="col-sm-1 {{ $center }}">
                                    <button class="btn btn-outline-danger p-0 todo-delete-btn" type="button"
                                        style="width:18px; height:18px;" type="button">
                                        <div class="w-100 h-100 {{ $center }}" style="font-size: 0.7em">x</div>
                                    </button>
                                    </form>
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
                                <input type="text"class=" w-100 h-100 form-control form-control-sm" maxlength="60"
                                    placeholder="Adicionar Tarefa" name="name">
                            </div>
                            <div class="col-md-1 {{ $center }}">
                                <button class="btn btn-success p-0" style="width:18px; height:18px;" type="submit">
                                    <div class="w-100 h-100 {{ $center }}" style="font-size: 0.8em">+</div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
