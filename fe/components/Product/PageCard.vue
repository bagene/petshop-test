<script setup lang="ts">
  import type {Product} from "~/models/Product";

  const { product } = defineProps({
    product: {
      type: Object as PropType<Product>,
      required: true,
    }
  });

  const items = [
    { title: 'Home', disabled: false, href: '/' },
    { title: product.category.title, disabled: false, href: '/' },
    { title: product.title, disabled: true, href: `/products/${product.uuid}` },
  ];


</script>

<template>
  <VContainer>
    <VRow>
      <VCol align-self="start">
        <VBreadcrumbs :items="items" href="href">
          <template v-slot:title="{ item }">
            {{ item.title }}
          </template>
        </VBreadcrumbs>
      </VCol>
    </VRow>

    <VRow no-gutters>
      <VCol cols="6">
        <VImg width="652" height="652" src="~/assets/img/product-image.png" />
      </VCol>
      <VCol cols="6" align-self="center">
        <Typography type="text-h3">{{ product.title }}</Typography>
        <Typography type="text-h5" class="text-grey font-weight-light">
          {{ product.category.title }}
        </Typography>
        <VSpacer class="mt-12" />

        <Typography type="text-h3" class="font-weight-light">
          {{ product.price }} kn
        </Typography>

        <VSpacer class="mt-4" />

        <VRow justify="space-between">
          <VCol cols="6" align-self="center">
            <VBtn
                color="primary"
                class="text-white"
                prepend-icon="mdi-cart"
                size="large"
                rounded
                block
            >
              Add to cart
            </VBtn>
          </VCol>
          <VCol cols="6">
            <VBtnGroup>
              <VBtn icon="mdi-plus" color="grey" rounded></VBtn>
              <VTextField
                  value="1"
                  class="text-center"
                  outlined
                  dense
                  disabled
              />
              <VBtn icon="mdi-minus" color="grey" rounded></VBtn>
            </VBtnGroup>
          </VCol>
        </VRow>
      </VCol>
    </VRow>
  </VContainer>
</template>

<style scoped>

</style>
