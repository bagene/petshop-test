
import {describe, it, expect, vi, afterEach} from 'vitest';
import {renderSuspended} from "@nuxt/test-utils/runtime";
import {cleanup, fireEvent, render, screen} from "@testing-library/vue";
import { mount } from "@vue/test-utils";
import {AuthLogin} from "#components";
import renderTestComponent from "~/utils/renderTestComponent";
import {errorStore} from "#imports";

const { errors } = errorStore();

const handleLogin = vi.fn();

const form = {
    email: '',
    password: '',
};

const renderComponent = (props = {}) => {
    return renderTestComponent(AuthLogin, {
        handleLogin: () => {},
        loginDialog: true,
        form: ref(form),
        ...props,
    });
}

describe('Login Component tests', () => {
    afterEach(() => {
        cleanup();
    });

    it('can render the login form', async () => {
        const html = renderComponent();

        expect(screen.getByTestId('login-form')).toBeDefined();
        expect(screen.getByTestId('email-input')).toBeDefined();
        expect(screen.getByTestId('password-input')).toBeDefined();
        expect(screen.getByTestId('login-button')).toBeDefined();
    });
});
