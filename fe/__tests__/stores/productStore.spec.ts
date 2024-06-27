import {afterEach, beforeEach, describe, expect, it, vi} from "vitest";
import {createPinia, setActivePinia} from "pinia";
import {cleanup} from "@testing-library/vue";
import * as fetchComposable from "#app/composables/fetch";
import type {Product, Products} from "~/models/Product";
import type {Category} from "~/models/Category";
import type {_AsyncData} from "#app/composables/asyncData";
import type {ProxyResponse} from "~/models/ProxyResponse";

const fetchSpy = vi.spyOn(fetchComposable, 'useFetch');

const category = {
    id: 1,
    uuid: 'test',
    title: 'category 1',
    slug: 'category-1',
    created_at: '2024-06-27T00:00:00',
    updated_at: '2024-06-27T00:00:00'
} as Category;

const products = [
    {
        category_id: 1,
        uuid: 'uuid-1',
        title: 'product 1',
        price: 100,
        description: 'test',
        created_at: '2024-06-27T00:00:00',
        updated_at: '2024-06-27T00:00:00',
        deleted_at: null,
        category,
    },
    {
        category_id: 1,
        uuid: 'uuid-2',
        title: 'product 2',
        price: 100,
        description: 'test',
        created_at: '2024-06-27T00:00:00',
        updated_at: '2024-06-27T00:00:00',
        deleted_at: null,
        category,
    },
] as Products;

describe('productStore tests', () => {
    beforeEach(() => {
        setActivePinia(createPinia());
    });

    afterEach(() => cleanup());

    const store = productStore();

    it('fetchProducts should call get products api and set products', async () => {
        expect(store.$state.products).toEqual([]);

        fetchSpy.mockResolvedValue({
            data: {
                value: {
                    data: products,
                    status: 200,
                    ok: true
                }
            }
        } as _AsyncData<ProxyResponse<Products>, any>);

        await store.fetchProducts();

        expect(fetchSpy).toHaveBeenCalled();
        expect(store.$state.products).toEqual(products);
    });

    it('fetchProduct should call get product api and set selected product', async () => {
        expect(store.$state.selectedProduct).toBeNull();

        fetchSpy.mockResolvedValue({
            data: {
                value: {
                    data: products[0],
                    status: 200,
                    ok: true
                }
            }
        } as _AsyncData<ProxyResponse<Product>, any>);

        await store.fetchProduct(products[0].uuid);

        expect(fetchSpy).toHaveBeenCalled();
        expect(store.$state.selectedProduct).toEqual(products[0]);
    })
});
