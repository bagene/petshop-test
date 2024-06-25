import type { FetchContext, FetchResponse } from "ofetch";
import appendApiHeaders from "~/utils/appendApiHeaders";
import type {ApiResponse, ErrorResponse, ProxyResponse} from "~/models/ProxyResponse";

export type IMethods = 'post' | 'get' | 'put' | 'delete' | 'patch' | 'POST' | 'GET' | 'PUT' | 'DELETE' | 'PATCH';

export const fetchApi = async (
    url: string,
    method: IMethods,
    body: any = {},
    headers: any = appendApiHeaders()
): Promise<ProxyResponse<{ [key: string]: any }>> => {
    let error = <ErrorResponse|null>null;
    let status = 200;
    const options = {
        method,
        headers: {
            ...headers,
            'Content-Type': 'application/json',
        },
        body: <string | undefined> undefined,
    };

    if (method !== 'get' && method !== 'GET') {
        options.body = JSON.stringify(body);
    }

    try {
        const response: ApiResponse =  await $fetch(url, {
            ...options,
            onResponseError({ response }: FetchContext & { response: FetchResponse<ErrorResponse> }): Promise<void> | void {
                error = response._data.error;
                status = response.status;
            }
        });

        return {
            data: response.data,
            status,
            ok: true
        };
    } catch (e) {
        return {
            data: null,
            errors: {
                message: error?.message as string,
                errors: error?.errors || undefined,
            },
            status,
            ok: false
        };
    }
}

export default fetchApi;
