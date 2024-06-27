import {defineStore} from "pinia";
import type {Product, Products} from "~/models/Product";
import type {ProxyResponse} from "~/models/ProxyResponse";

export const productStore = defineStore('product', () => {
    const products = ref<Products>([]);
    const selectedProduct = ref<Product | null>(null);

    const fetchProducts = async (
        filter: {[key: string]: string|number|boolean} = {}
    ) => {
        const queryString = Object.keys(filter).map(key => `${key}=${filter[key]}`).join('&');

        const { data: { value } } = await useFetch<ProxyResponse<Products>>(
            `/api/products?${queryString}`,
            { method: 'get' }
        );
console.log(value);
        if (value?.ok) {
            addProducts(value?.data as Products);
        }
    }

    const fetchProduct = async (uuid: string) => {
        const { data: { value } } = await useFetch<ProxyResponse<Product>>(
            `/api/products/${uuid}`,
            { method: 'get' }
        );

        if (value?.ok) {
            selectedProduct.value = value?.data as Product;
        }
    }

    const addProducts = (newProducts: Products) => {
        products.value.push(...newProducts);
    }

    const getProducts = () => {
        return products;
    }

    return {
        products,
        addProducts,
        getProducts,
        fetchProducts,
        selectedProduct,
        fetchProduct,
    };
});
