<script setup>
import { ref, computed } from "vue";
import TodosServices from "@srv/TodosServices";

const todosServices = new TodosServices();

const todos = ref(null);

async function refreshTodos() {
    const response = await todosServices.read();
    if (!response.error) {
        todos.value = response.data;
    }
}
refreshTodos();

async function del(id) {
    const response = await todosServices.delete(id);
    if (!response.error) {
        todos.value = todos.value.filter((t) => t.id != id);
    }
}

const todosBadges = computed(() => {
    return {
        total: todos.value ? todos.value.length : 0,
        pendent: todos.value
            ? todos.value.filter((t) => !t.completed).length
            : 0,
        completed: todos.value
            ? todos.value.filter((t) => t.completed).length
            : 0,
    };
});

async function complete(id, currentState) {
    const response = await todosServices.update(id, {
        completed: !currentState,
    });

    if (!response.error) {
        toggleCompleted(id);
    }
}

function toggleCompleted(todoId) {
    const todo = todos.value.find((todo) => todo.id === todoId);
    if (todo) {
        todo.completed = !todo.completed;
    }
}

const newTodo = ref(null);

async function store() {
    if (!newTodo.value) return;

    const response = await todosServices.create({
        name: newTodo.value,
    });
    if (!response.error) {
        todos.value.push(response.data);
    }
}
</script>
<template>
    <div class="section-wrapper col-md-6">
        <div class="todo-container">
            <div class="page-header container">
                <div class="float-end">
                    <span
                        class="badge rounded-circle bg-primary"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="Total de tarefas"
                        >{{ todosBadges.total }}</span
                    >

                    <span
                        class="badge rounded-circle bg-warning"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="Total de tarefas"
                        >{{ todosBadges.pendent }}</span
                    >
                    <span
                        class="badge rounded-circle bg-success"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="Total de tarefas"
                        >{{ todosBadges.completed }}</span
                    >
                </div>
                <h4 class="page-header mb-1 text-body-secondary">Tarefas</h4>
            </div>
            <div
                class="col-12 p-2 rounded shadow"
                style="background-color: #f5f5f5"
            >
                <div class="todo-list">
                    <div v-for="todo in todos" class="col-12 mt-1 todo-row">
                        <div class="d-flex">
                            <div
                                class="col-1 d-flex justify-content-center align-items-center"
                            >
                                <input
                                    type="checkbox"
                                    class="form-check-input m-0"
                                    style="width: 16px; height: 16px"
                                    v-model="todo.completed"
                                    @click.prevent="
                                        complete(todo.id, todo.completed)
                                    "
                                />
                            </div>
                            <div class="col-10 d-flex align-items-center">
                                <div
                                    class="fs-6 border-bottom text-truncate todo-name flex-grow-1"
                                >
                                    <span
                                        :class="
                                            todo.completed
                                                ? 'text-decoration-line-through'
                                                : ''
                                        "
                                    >
                                        {{ todo.name }}
                                    </span>
                                </div>
                            </div>
                            <div
                                class="col-1 d-flex justify-content-center align-items-center"
                            >
                                <div style="transform: scale(0.5)">
                                    <button
                                        class="btn btn-outline-danger"
                                        type="button"
                                        @click="del(todo.id)"
                                    >
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add-todo">
                    <div class="col-12 mt-1">
                        <div class="d-flex">
                            <div
                                class="col-1 d-flex justify-content-center align-items-center"
                            ></div>
                            <div class="col-10">
                                <input
                                    type="text"
                                    class="w-100 h-100 form-control form-control-sm"
                                    maxlength="60"
                                    placeholder="Adicionar Tarefa"
                                    name="name"
                                    v-model="newTodo"
                                />
                            </div>
                            <div
                                class="col-1 d-flex justify-content-center align-items-center"
                            >
                                <div style="transform: scale(0.5)">
                                    <button
                                        class="btn btn-success add-todo-btn"
                                        type="button"
                                        @click="store()"
                                    >
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
</template>
