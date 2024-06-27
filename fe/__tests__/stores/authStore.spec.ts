import {afterEach, beforeEach, describe, expect, it, vi} from "vitest";
import {createPinia, setActivePinia} from "pinia";
import * as loginApi from "~/server/api/user/login";
import type {ProxyResponse} from "~/models/ProxyResponse";
import * as fetchComposable from "#app/composables/fetch";
import type {_AsyncData} from "#app/composables/asyncData";
import type {User} from "~/models/User";
import {cleanup} from "@testing-library/vue";

const fetchSpy = vi.spyOn(fetchComposable, 'useFetch');

const user = {
    first_name: 'Test',
    last_name: 'User',
    email: 'test@example.org',
    address: 'test',
    phone_number: '12345',
    is_marketing: false,
    is_admin: true,
    created_at: '2024-06-27T00:00:00',
    updated_at: '2024-06-27T00:00:00',
    uuid: 'test-id',
    last_login_at: null
} as User;

describe('test auth store', () => {
    beforeEach(() => {
        setActivePinia(createPinia());
    });

    afterEach(() => cleanup());

    const store = authStore();

    it('login should call login api', async () => {
        const loginPayload = {
            data: {
                value: {
                    data: {
                        token: 'token'
                    },
                    ok: true,
                    status: 200,
                }
            }
        } as _AsyncData<ProxyResponse<{ token: string }>, any>;

        fetchSpy.mockResolvedValue(loginPayload);

        const res = await store.login('test@example.org', 'password');

        expect(fetchSpy).toHaveBeenCalled();
        expect(fetchSpy).toHaveReturnedWith(loginPayload);
        expect(res).toEqual({
            data: {
                token: 'token',
            },
            status: 200,
            ok: true
        });
    });

    it('logout should call logout api and remove user', async () => {
        store.$state.user = user;

        await store.logout();

        expect(fetchSpy).toHaveBeenCalled();
        expect(store.$state.user).toBeNull();
    });

    it('getUser should set user', async () => {
        store.$state.user = null;

        expect(store.$state.user).toBeNull();

        const getUserPayload = {
            data: {
                value: {
                    data: user,
                    ok: true,
                    status: 200
                }
            }
        } as _AsyncData<ProxyResponse<User>, any>;

        fetchSpy.mockResolvedValue(getUserPayload);

        await store.getUser();

        expect(fetchSpy).toHaveBeenCalled();
        expect(fetchSpy).toHaveReturnedWith(getUserPayload);
        expect(store.$state.user).toEqual(user);
        expect(store.isLoggedIn).toBeTruthy();
    });
});
