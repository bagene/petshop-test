<script setup lang="ts">
import type {PropType} from "vue";
import type {Product} from "~/models/Product";
import type {Image} from "~/models/Image";

defineProps({
  product: Object as PropType<Product>
})
</script>

<template>
  <VCard variant="flat" hover max-width="300" max-height="450">

    <VCardItem>
      <VImg :src="(product.image as Image).path" />

      <VCardText>
        <Typography type="text-h6" class="text-decoration-underline">
          {{ product.title }}
        </Typography>
        <Typography class="text-light">Animonda</Typography>
        <Typography class="text-h6">
          {{ product.price }} kn
        </Typography>
      </VCardText>
    </VCardItem>

  </VCard>
</template>

<style scoped>

</style>
