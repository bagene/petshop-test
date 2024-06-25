import { appendApiRoute } from "~/utils/appendApiRoute";
import { fetchApi } from "~/utils/fetchApi";

export default defineEventHandler(async (event) => {
    const { email, password } = await readBody(event);

    const response = await fetchApi(
        appendApiRoute('/user/login'),
        'post',
        { email, password },
    );

    if (response.ok) {
        setCookie(event, 'token', response?.data?.token);
    }

    return response;
});

