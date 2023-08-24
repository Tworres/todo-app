import "./bootstrap";
import { createApp } from "vue";
// import example from "@cmp/example.vue";
import TodoList from "@cmp/TodoList.vue";

const app = createApp();

app.component("todo-list", TodoList);

app.mount("#app");
