import type {EventHandlerRequest, H3Event} from "h3";
export const appendAuthHeaders = (event: H3Event<EventHandlerRequest>) => {
    const token = getCookie(event, 'token');

    return {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`
    };
}

export const appendPublicHeaders = () => {
    return {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    };
}

export default appendPublicHeaders;
