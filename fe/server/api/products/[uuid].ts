import {getRouterParam} from "h3";
import { appendAuthHeaders } from "~/utils/appendApiHeaders";
import { appendApiRoute } from "~/utils/appendApiRoute";
import fetchApi from "~/utils/fetchApi";

export default defineEventHandler(async (event) => {
    const routeParam = getRouterParam(event, 'uuid');

    return fetchApi(
        appendApiRoute(`/products/${routeParam}`),
        'get',
        [],
        appendAuthHeaders(event)
    );
});
