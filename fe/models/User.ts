export interface User {
    first_name: string;
    last_name: string;
    email: string;
    address: string;
    phone_number: string;
    is_marketing: boolean;
    is_admin: boolean;
    created_at: string;
    updated_at: string;
    uuid: string;
    last_login_at: string | null;
}
