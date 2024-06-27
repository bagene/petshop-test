import {defineStore} from "pinia";
import type {ErrorResponse, ProxyResponse} from "~/models/ProxyResponse";
import type {User} from "~/models/User";


export const authStore = defineStore('auth', () => {
    const user = ref<User | null>(null);
    const isLoggedIn = computed(() => !!user.value);

    const login = async (email: string, password: string) => {
        const { data: { value } } = await useFetch<ProxyResponse<{ token: string }>>('/api/user/login', {
            method: 'post',
            body: { email, password },
        });

        if (value?.ok) {
            await getUser();
        }

        return value as ProxyResponse<{ token: string } | ErrorResponse>
    }

    const logout = async () => {
        await useFetch('/api/user/logout', { method: 'delete' });
        user.value = null;
    };

    const getUser = async () => {
        const { data: { value } } = await useFetch<ProxyResponse<User>>(
            '/api/user',
            { method: 'get' },
        );

        if (value?.ok) {
            user.value = value?.data;
        }
    }

    return {
        user,
        login,
        logout,
        getUser,
        isLoggedIn,
    };
});
