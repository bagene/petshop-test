<template>
  <div>
    <VApp>
      <NuxtLayout>
        <ErrorSnackbar />
        <NuxtPage />
      </NuxtLayout>
    </VApp>
  </div>
</template>
<script setup lang="ts">
import { authStore } from '~/stores/authStore';
const { getUser, isLoggedIn } = authStore();

if (!isLoggedIn) {
  getUser();
}
</script>
