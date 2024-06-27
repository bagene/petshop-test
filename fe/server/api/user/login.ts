import { appendApiRoute } from "~/utils/appendApiRoute";
import { fetchApi } from "~/utils/fetchApi";
import { defineEventHandler } from 'h3';

export const loginUser = async (email: string, password: string) => {
    return await fetchApi(
        appendApiRoute('/user/login'),
        'post',
        { email, password },
    );
};

export default defineEventHandler(async (event) => {
    const { email, password } = await readBody(event);

    const response = await loginUser(email, password);

    if (response.ok) {
        setCookie(event, 'token', response?.data?.token);
    }

    return response;
});

