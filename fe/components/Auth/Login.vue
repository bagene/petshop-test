<script setup lang="ts">

import type {PropType} from "vue";

defineProps({
    handleLogin: {
        type: Function,
        required: true,
    },
});

const form = defineModel('form', {
    type: Object as PropType<{ email: string, password: string }>,
    required: true,
});

const loginDialog = defineModel('loginDialog', {
    type: Boolean,
    required: true,
});
</script>

<template >
  <VDialog
      v-model="loginDialog"
      width="auto"
      data-testid="login-form"
  >
    <VCard
        width="600"
    >
      <VImg
          class="mt-10"
          height="100"
          src="~/assets/img/petson-logo.svg"
      ></VImg>
      <VCardItem>
        <VCardTitle class="text-center text-primary mb-2">
          <Typography type="text-h6">Log in</Typography>
        </VCardTitle>

        <VCardText>
          <VForm @submit.prevent="handleLogin">
            <InputText
                data-testid="email-input"
                index="email"
                label="Email"
                v-model="form.email"
            />
            <InputText
                data-testid="password-input"
                index="password"
                label="Password"
                v-model="form.password"
            />
            <VCheckbox label="Remember me" />

            <VBtn
                data-testid="login-button"
                color="primary text-white"
                block
                class="mt-4"
                type="submit"
            >
              Log in
            </VBtn>
          </VForm>
        </VCardText>
      </VCardItem>
    </VCard>
  </VDialog>
</template>
