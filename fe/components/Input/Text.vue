<script setup lang="ts">
  const props = defineProps({
    index: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
  });

  const model = defineModel({
    type: String,
    required: true,
  });

  const { removeError } = errorStore();
  const { errors } = storeToRefs(errorStore());

  const onModelUpdate = () => {
    removeError(props.index);
  };
</script>

<template>
  <VTextField
    color="primary"
    v-model="model"
    :label="label"
    :error-messages="errors[index]"
    variant="outlined"
    @update:model-value="onModelUpdate"
  />
</template>
