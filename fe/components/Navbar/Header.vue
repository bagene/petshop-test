<script setup lang="ts">
  import {navLinks} from "~/contants/nav-links";
  import {authStore} from "~/stores/authStore";

  const { errors } = storeToRefs(errorStore());

  const selectedTab = ref(navLinks[0]);
  const tabs = ref(navLinks);
  const loginDialog = ref(false);

  const form = ref({
    email: '',
    password: '',
  });

  const { login, logout } = authStore();
  const { isLoggedIn } = storeToRefs(authStore());

  const handleLogin = async () => {
    const { email, password } = form.value;

    const response = await login(email, password);

    if (!response.ok) {
      useHandleErrors(response);

      return;
    }

    loginDialog.value = false;
  }
</script>

<template>
  <VToolbar
      data-testid="petson-navbar"
      :elevation="2"
      color="primary"
      height="80"
  >
    <VContainer>
      <VRow>
        <VCol align-self="center">
          <VToolbarTitle class="text-white" href="/">
            <VAppBarNavIcon class="ml-4">
              <img src="~/assets/icons/petson.png" alt="nav-logo">
            </VAppBarNavIcon>
            petson.
          </VToolbarTitle>
        </VCol>
        <VCol align-self="center">
          <VTabs v-model="selectedTab" class="text-white" align-tabs="center">
            <VTab
                v-for="tab in tabs"
                :key="tab.label"
                :text="tab.label"
                :value="tab.label"
                class="text-subtitle-1 font-weight-normal"
            />
          </VTabs>
        </VCol>
        <VCol align-self="center" offset-md="1">
          <VRow justify="space-evenly" >
            <VBtn
              size="large"
              class="text-white"
              variant="outlined"
            >
              <v-icon>mdi-cart</v-icon>
              CART
            </VBtn>
            <template v-if="!isLoggedIn">
              <VBtn
                data-testid="login-open-button"
                size="large"
                class="text-white"
                variant="outlined"
                @click="loginDialog = true">
                LOGIN
              </VBtn>
              <VBtn
                data-testid="signup-open-button"
                class="text-white"
                variant="outlined"
                size="large"
              >
                SIGN UP
              </VBtn>
            </template>
            <VBtn
                v-else
                data-testid="logout-button"
                size="large"
                @click="logout"
                class="text-white"
                variant="outlined">
              LOGOUT
            </VBtn>
          </VRow >
        </VCol>
      </VRow>
    </VContainer>

    <AuthLogin
        :handleLogin="handleLogin"
        v-model:loginDialog="loginDialog"
        v-model:form="form"
    />
  </VToolbar>
</template>

<style scoped></style>
