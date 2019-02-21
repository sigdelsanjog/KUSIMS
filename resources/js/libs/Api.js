import Http from "axios";
import Store from "./../stores";

Http.interceptors.request.use(config => {
    debugger;
    const currentUser = Store.getters["global/currentUser"];
    const isLoggedIn = Store.getters["global/isLoggedIn"];

    if (isLoggedIn) {
        config.headers.Authorization = `Bearer ${JSON.parse(currentUser).token}`;
    }

    return config;
});

class Api {
    async get(url, params = {}) {
        const options = {
            params
        };

        const response = await Http.get(url, options);

        return response;
    }

    /**
     *
     * @param {String} url
     * @param {*} data
     * @param {*} header
     */
    async post(url, data) {
        const response = await Http.post(url, data);

        return response;
    }
}

export default new Api();
