import {afterEach, beforeEach, describe, expect, it} from "vitest";
import {createPinia, setActivePinia} from "pinia";

describe('errorStore test', () => {
    beforeEach(() => {
        setActivePinia(createPinia());
    });

    const store = errorStore();

    const globalError = 'Internal Server Error';
    const errors = {
        email: [
            'The email field is required.'
        ],
        password: [
            'The password field is required'
        ]
    };

    it('should set global error', () => {
        expect(store.$state.globalError);

        store.setGlobalError(globalError);

        expect(store.$state.globalError).toEqual(globalError);
    });

    it('should set errors', () => {
        expect(store.$state.errors).toEqual({});

        store.setErrors(errors);

        expect(store.$state.errors).toEqual(errors);
    });

    it('should clear errors', () => {
        store.setGlobalError(globalError);
        store.setErrors(errors);

        expect(store.$state.globalError).not.toBeNull();
        expect(store.$state.errors).toBeTruthy();

        store.clearErrors();

        expect(store.$state.globalError).toBeNull();
        expect(store.$state.errors).toEqual({});
    });

    it('should remove specific error', () => {
        store.setErrors(errors);

        expect(store.$state.errors).toEqual(errors);

        store.removeError('email');

        expect(store.$state.errors.email).not.toBeDefined();
    });
});
