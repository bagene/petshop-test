<script setup lang="ts">
  const { clearErrors } = errorStore();
  const { globalError, hasGlobalError } = storeToRefs(errorStore());

  watchEffect(() => {
    if (globalError.value) {
      setTimeout(() => {
        clearErrors();
      }, 2000);
    }
  });
</script>

<template>
  <VSnackbar v-model="hasGlobalError" :timeout="2000" color="error">
    {{ globalError }}
  </VSnackbar>
</template>
