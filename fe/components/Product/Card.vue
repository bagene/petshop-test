<script setup lang="ts">
import type {PropType} from "vue";
import type {Product} from "~/models/Product";
import type {Image} from "~/models/Image";

defineProps({
  product: {
    type: Object as PropType<Product>,
    required: true,
  }
});
</script>

<template>
  <VCard :href="`/products/${product.uuid}`" variant="flat" hover max-width="300" max-height="450">
    <VCardItem >
      <VImg src="~/assets/img/product-image.png" />

      <VCardText>
        <Typography type="text-h6" class="text-decoration-underline">
          {{ product.title }}
        </Typography>
        <Typography class="text-grey">Animonda</Typography>
        <Typography class="text-h6">
          {{ product.price }} kn
        </Typography>
      </VCardText>
    </VCardItem>

  </VCard>
</template>

<style scoped>

</style>
