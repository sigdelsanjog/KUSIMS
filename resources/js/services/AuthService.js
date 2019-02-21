import Api from "../libs/Api";
import { route } from "../helpers";

/**
 * Class AuthService
 */
class AuthService {
    /**
     * Call the login api.
     * @param {Object} credentials
     */
    async login(credentials) {
        const response = await Api.post(route("api.auth.login"), credentials);

        return response.data;
    }

    /**
     * Call the auth register api.
     * @param {Object} userData
     */
    async register(userData) {
        const response = await Api.post(route("api.auth.register"), userData);

        return response.data;
    }

    async socialLoginProvider(provider) {
        let response = await Api.get(`/api/social/${provider}`);

        return response.data;
    }

    async getCurrentUser() {
        const response = await Api.get(route("api.auth.current-user"));

        return response.data;
    }
}

export default new AuthService();
