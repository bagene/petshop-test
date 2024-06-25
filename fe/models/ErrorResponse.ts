export interface ErrorResponse {
    message: string;
    errors: {
        string: string[];
    },
    status: number;
}
