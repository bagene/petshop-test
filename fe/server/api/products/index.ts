import { appendAuthHeaders } from "~/utils/appendApiHeaders";
import { appendApiRoute } from "~/utils/appendApiRoute";
import fetchApi from "~/utils/fetchApi";

export default defineEventHandler(async (event) => {
    const query = getQuery(event);
    const queryString = Object.keys(query).map(key => `${key}=${query[key]}`).join('&');
    return fetchApi(
        appendApiRoute(`/products?${queryString}`),
        'get',
        [],
        appendAuthHeaders(event)
    );
});
