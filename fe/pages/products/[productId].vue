<script setup lang="ts">
  const router = useRouter();
  const productId = computed(() => router.currentRoute.value.params.productId);
  const { fetchProduct } = productStore();

  await fetchProduct(productId.value as string);

  const { selectedProduct } = storeToRefs(productStore());

</script>

<template>
  <template v-if="selectedProduct">
    <ProductPageCard :product="selectedProduct" />

    <VContainer>
      <VRow>
        <VCol cols="12">
          <Typography type="text-body">
            {{ selectedProduct.description }}
          </Typography>
        </VCol>
      </VRow>
    </VContainer>
  </template>

</template>

<style scoped>

</style>
