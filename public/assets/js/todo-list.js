$(".todo-checkbox")
    .change((e) => {
        e = $(e.currentTarget);
        updateBadges(e.parents(".todo-container"));
        updateText(e.parents(".todo-row"));
    })
    .trigger("change");

function updateBadges(container) {
    const checkboxes = container.find(".todo-checkbox");

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

$(".todo-checkbox").change((e) => {
    updateDbOnCheck($(e.currentTarget));
});

//!!! SEM TRIGGER
/**
 * função é executada toda vez que um checkbox é marcado/desmarcado
 * **/
async function updateDbOnCheck(e) {
    response = await $.ajax({
        url: e.parents(".todo-row").data("route"),
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
    });
}

$(".todo-delete-btn").click((e) => {
    destroyOnClick($(e.currentTarget).parents(".todo-row"));
});

async function destroyOnClick(row) {
    response = await $.ajax({
        url: row.data("route"),
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

            const container = row.parents(".todo-container");
            row.remove();
            updateBadges(container);
        },
    });
}
