updateBadges($(".todo-container"));
updateText($(".todo-list .todo-row"));

$(document).on("change", ".todo-checkbox", (e) => {
    updateBadges($(e.target).parents(".todo-container"));
    updateText($(e.target).parents(".todo-row"));
    updateDbOnCheck($(e.target));
});

function updateBadges(container) {
    const checkboxes = container.find(".todo-list .todo-checkbox");

    container.find(".todos-all").text(checkboxes.length);
    container
        .find(".todos-pending")
        .text(checkboxes.filter(":not(:checked)").length);
    container
        .find(".todos-conclude")
        .text(checkboxes.filter(":checked").length);
}

function updateText(row) {
    const todoTitle = row.find(".todo-name");

    if (row.find(".todo-checkbox").is(":checked")) {
        todoTitle.addClass("text-decoration-line-through");
        todoTitle.addClass("text-body-secondary");
    } else {
        todoTitle.removeClass("text-decoration-line-through");
        todoTitle.removeClass("text-body-secondary");
    }
}

/**
 * função é executada toda vez que um checkbox é marcado/desmarcado
 * **/
async function updateDbOnCheck(e) {
    debugger;
    const response = await $.ajax({
        url: e.data("route"),
        method: "POST",
        data: {
            _token: $("#_token").val(),
            _method: "PUT",
            completed: +e.is(":checked"),
        },
        error: function (response) {
            console.error(response);

            e.prop("checked", !e.is(":checked"));
            updateText(e.parents(".todo-row"));
            updateBadges(e.parents(".todo-container"));
        },
        success: function (response) {
            console.log(response);
        },
    });
}

$(document).on("click", ".todo-delete-btn", (e) => {
    debugger;
    destroyOnClick($(e.currentTarget));
});

async function destroyOnClick(btn) {
    const response = await $.ajax({
        url: btn.data("route"),
        method: "POST",
        data: {
            _token: $("#_token").val(),
            _method: "DELETE",
        },
        error: function (response) {
            console.error(response);
        },
        success: function (response) {
            console.log(response);

            const container = btn.parents(".todo-container");
            btn.parents(".todo-row").remove();
            updateBadges(container);
        },
    });
}

$(".add-todo-btn").click((e) => {
    console.log($(e.currentTarget));
    insertNewTodo($(e.currentTarget));
});

async function insertNewTodo(btn) {
    const response = await $.ajax({
        url: btn.data("route"),
        method: "POST",
        data: {
            _token: $("#_token").val(),
            name: $("#todo-name-input").val(),
        },
        error: function (response) {
            console.error(response);
        },
        success: function (response) {
            response = JSON.parse(response);

            dataToTodoRow(response.data);
            $("#todo-name-input").val("");
        },
    });
}

function dataToTodoRow(data) {
    const template = $(".todo-template .todo-row").clone();

    debugger;
    //altera as rotas do template
    template.find("[data-route]").each((i, e) => {
        debugger;
        const newRoute = $(e).attr("data-route").slice(0, -1) + data.id;

        $(e).attr("data-route", newRoute);
    });

    //atribui o nome
    template.find(".todo-name").text(data.name);

    //insere na lista
    template.appendTo(".todo-list");

    updateBadges(template.parents(".todo-container"));
}
