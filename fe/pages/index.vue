<script setup lang="ts">

</script>

<template>
  <VContainer>
    <VRow no-gutters>
      <VCol cols="6" offset-sm="3" align-self="center">
        <VTextField
            prepend-inner-icon="mdi-magnify"
            placeholder="Search for products"
            variant="outlined"
        />
      </VCol>
    </VRow>
  </VContainer>

  <VContainer>
    <VImg src="~/assets/img/home-banner.png" />
  </VContainer>

  <VContainer>
    <VRow>
      <div class="text-h3 text-primary">
        Dry dog food
      </div>
    </VRow>
    <VRow>
      <VCol>
        <ProductCard />
      </VCol>
      <VCol>
        <ProductCard />
      </VCol>
      <VCol>
        <ProductCard />
      </VCol>
    </VRow>
  </VContainer>
</template>

<style scoped>

</style>
