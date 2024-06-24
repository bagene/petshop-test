<script setup lang="ts">
defineProps({
  slot: {
    type: String,
    required: true
  },
  type: {
    type: String,
    default: ''
  }
})
</script>

<template>
  <div :class="type">
    <slot />
  </div>
</template>

<style scoped>

</style>
