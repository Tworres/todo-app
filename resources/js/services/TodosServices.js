import axios from "axios";

export default class TodosServices {
    async create(data) {
        try {
            const response = await axios.post("todo", { ...data });

            if (!response) {
                throw new Error("Não foi possivel realizar a requisição");
            }

            return {
                error: false,
                message: "Realizado com sucesso",
                response: response,
                data: response.data.data,
            };
        } catch (err) {
            console.error(err);
            return {
                error: true,
                message: err.message(),
                response: null,
                data: null,
            };
        }
    }

    async read() {
        try {
            const response = await axios.get("todo");
            response.data.data = response.data.data.map((e) => {
                e.completed = !!e.completed;
                return e;
            });

            if (!response) {
                throw new Error("Não foi possivel realizar a requisição");
            }

            return {
                error: false,
                message: "Realizado com sucesso",
                response: response,
                data: response.data.data,
            };
        } catch (err) {
            console.error(err);
            return {
                error: true,
                message: err.message(),
                response: null,
                data: null,
            };
        }
    }

    async update(id, data) {
        try {
            const response = await axios.post("todo/" + id, {
                _token: $("#_token").val(),
                _method: "put",
                ...data,
            });

            if (!response) {
                throw new Error("Não foi possivel realizar a requisição");
            }

            return {
                error: false,
                message: "Realizado com sucesso",
                response: response,
                data: response.data.data,
            };
        } catch (err) {
            console.error(err);
            return {
                error: true,
                message: err.message(),
                response: null,
                data: null,
            };
        }
    }

    async delete(id) {
        try {
            const response = await axios.post("todo/" + id, {
                _token: $("#_token").val(),
                _method: "delete",
            });

            if (!response) {
                throw new Error("Não foi possivel realizar a requisição");
            }

            return {
                error: false,
                message: "Realizado com sucesso",
                response: response,
                data: response.data.data,
            };
        } catch (err) {
            console.error(err);
            return {
                error: true,
                message: err.message(),
                response: null,
                data: null,
            };
        }
    }
}
