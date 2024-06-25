import {defineStore} from "pinia";
import type {ProxyResponse} from "~/models/ProxyResponse";
import type {User} from "~/models/User";


export const authStore = defineStore('auth', () => {
    const user = ref<User | null>(null);
    const token = ref<string | null>(null);
    const isLoggedIn = computed(() => !!user.value);

    const login = async (email: string, password: string) => {
        const { data: { value } } = await useFetch<ProxyResponse<{ token: string }>>('/api/user/login', {
            method: 'post',
            body: { email, password },
        });

        if (value?.ok) {
            token.value = value?.data?.token as string;
        }

        await getUser();
    }

    const logout = async () => {
        await useFetch('/api/user/logout', { method: 'delete' });
        token.value = null;
        user.value = null;
    };

    const getUser = async () => {
        const { data: { value } } = await useFetch<ProxyResponse<User>>(
            '/api/user',
            { method: 'get', headers: { Authorization: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJleHAiOjE3MTkzMDI4MDEsIm5iZiI6MTcxOTMwMTkwMSwidXNlcl91dWlkIjoiNmRjOTA3NmItZDdhNi00ZjQzLWIyYWItMjA5MThhMGZjM2NkIn0.eJhWyx0z5XF6Mu7wa1HqcJxnXUnbs3Dd6PE9cPdz9CY' } },
        );

        if (value?.ok) {
            user.value = value?.data;
        }
    }

    return {
        user,
        token,
        login,
        logout,
        getUser,
        isLoggedIn,
    };
});
