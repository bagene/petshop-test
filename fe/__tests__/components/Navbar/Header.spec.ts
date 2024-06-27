import {authStore, renderTestComponent} from '#imports';
import {NavbarHeader} from '#components';
import {describe, it, expect, afterEach, vi, beforeEach} from 'vitest';
import {cleanup, fireEvent, screen} from '@testing-library/vue';
import type {ProxyResponse} from "~/models/ProxyResponse";

const storeAuth = authStore();

const loginSpy = vi.spyOn(storeAuth, 'login');

const renderComponent = () => renderTestComponent(
    NavbarHeader,
    {},
);

describe('NavbarHeader Component tests', () => {
    beforeEach(() => {
        loginSpy.mockResolvedValue({
            data: {
                token: 'token'
            },
            errors: null,
            status: 200,
            ok: true
        } as ProxyResponse<{ token: string }>);
    });
    afterEach(() => {
        vi.resetAllMocks();
        cleanup();
    });

    it('can render the navbar header', async () => {
        renderComponent();

        expect(screen.getByTestId('petson-navbar')).toBeDefined();
        expect(screen.getByText('PRODUCTS')).toBeDefined();
        expect(screen.getByText('PROMOTIONS')).toBeDefined();
        expect(screen.getByText('BLOG')).toBeDefined();
        expect(screen.getByTestId('login-open-button')).toBeDefined();
        expect(screen.getByTestId('signup-open-button')).toBeDefined();
    });

    it('should show login form when login button is clicked', async () => {
        renderComponent();

        const loginButton = screen.getByTestId('login-open-button');

        await fireEvent.click(loginButton);

        expect(screen.getByTestId('login-form')).toBeDefined();
        expect(screen.getByTestId('email-input')).toBeDefined();
        expect(screen.getByTestId('password-input')).toBeDefined();
        expect(screen.getByTestId('login-button')).toBeDefined();
    });

    it('should submit login form when login button is clicked', async () => {
        renderComponent();

        await fireEvent.click(screen.getByTestId('login-open-button'));

        const emailInput = screen.getByTestId('email-input').querySelector('input') as Element;
        const passwordInput = screen.getByTestId('password-input').querySelector('input') as Element;

        await fireEvent.update(emailInput, 'test@example.org');
        await fireEvent.update(passwordInput, 'password');

        await fireEvent.click(screen.getByTestId('login-button'));

        expect(loginSpy).toHaveBeenCalledWith(
            'test@example.org',
            'password'
        );
    });
});
