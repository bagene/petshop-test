import {defineStore} from "pinia";
import type {Product, Products} from "~/models/Product";
import type {ProxyResponse} from "~/models/ProxyResponse";

export const productStore = defineStore('product', () => {
    const products: Products = [];

    const fetchProducts = async (
        filter: {[key: string]: string|number|boolean} = {}
    ) => {
        const queryString = Object.keys(filter).map(key => `${key}=${filter[key]}`).join('&');

        const { data: { value } } = await useFetch<ProxyResponse<Product[]>>(
            `/api/products?${queryString}`,
            { method: 'get' }
        );

        if (value?.ok) {
            addProducts(value?.data as Products);
        }
    }

    const addProducts = (newProducts: Products) => {
        products.push(...newProducts);
    }

    const getProducts = () => {
        return products;
    }

    return {
        products,
        addProducts,
        getProducts,
        fetchProducts,
    };
});