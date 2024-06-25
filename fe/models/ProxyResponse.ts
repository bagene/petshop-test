export interface ErrorResponse {
    message: string;
    errors?: {
        string: string[];
    },
}


export interface ProxyResponse<T> {
    data: T | null,
    errors?: ErrorResponse | null,
    status: number,
    ok: boolean,
}

export interface ApiResponse {
    data: {
        [key: string]: any;
    }
}
