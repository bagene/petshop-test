<script setup lang="ts">

import {productStore} from "~/stores/productStore";
import type {Product} from "~/models/Product";

const { products, fetchProducts } = productStore();

await fetchProducts();

const categories = computed(() => {
  const mappedCategories: {
    [key: string]: Product[];
  } = {};

  products.forEach((product: Product) => {
    mappedCategories[product.category.title] = [
        ...(mappedCategories[product.category.title] || []),
      product
    ];
  });

  return mappedCategories;
});

</script>

<template>
  <VContainer>
    <VRow no-gutters>
      <VCol class="mt-8" cols="6" offset-sm="3" align-self="center">
        <VTextField
            class="text-primary"
            color="primary"
            base-color="primary"
            prepend-inner-icon="mdi-magnify"
            label="Search products"
            variant="outlined"
        />
      </VCol>
    </VRow>
  </VContainer>

  <VContainer>
    <VImg src="~/assets/img/home-banner.png" />
  </VContainer>

  <VContainer v-for="category in Object.keys(categories).splice(0, 2)">
    <VRow>
      <VCol>
        <Typography class="text-h3 text-primary">
          {{ category }}
        </Typography>
      </VCol>

    </VRow>
    <VRow>
      <VCol v-for="product in categories[category].splice(0, 4)">
        <ProductCard :product="product" class="mb-2"/>
      </VCol>
    </VRow>

    <BlogHomeCard />
  </VContainer>
</template>

<style scoped>

</style>
