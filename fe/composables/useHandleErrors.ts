import type {ProxyResponse} from "~/models/ProxyResponse";

export default function (response: ProxyResponse<any>) {
    const { errors } = response;
    const { setGlobalError, setErrors } = errorStore();


    switch (response.status) {
        case 422:
            setErrors(errors?.errors || {});
            break;
        default:
            setGlobalError(response.errors?.message || 'Internal server error');
            break;
    }
}
