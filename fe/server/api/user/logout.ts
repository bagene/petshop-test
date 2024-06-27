import { appendAuthHeaders } from "~/utils/appendApiHeaders";
import { appendApiRoute } from "~/utils/appendApiRoute";
import { fetchApi } from "~/utils/fetchApi";

export default defineEventHandler(async (event) => {
    await fetchApi(
        appendApiRoute('/user/logout'),
        'delete',
        [],
        appendAuthHeaders(event)
    );

    setCookie(event, 'token', '');
});
