import { authStore } from "~/stores/authStore";
import { appendApiRoute } from "~/utils/appendApiRoute";
import { fetchApi } from "~/utils/fetchApi";
import {appendAuthHeaders} from "~/utils/appendApiHeaders";

export default defineEventHandler(async (event) => {
    return fetchApi(
        appendApiRoute('/user'),
        'get',
        [],
        appendAuthHeaders(event)
    )
});
