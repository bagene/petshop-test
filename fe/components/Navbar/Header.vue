<script setup lang="ts">
  import {navLinks} from "~/contants/nav-links";
  import {authStore} from "~/stores/authStore";

  const selectedTab = ref(navLinks[0]);
  const tabs = ref(navLinks);
  const loginDialog = ref(false);

  const form = ref({
    email: '',
    password: '',
  });

  const { login, logout, getUser } = authStore();
  const { isLoggedIn } = storeToRefs(authStore());

  const handleLogin = async () => {
    const { email, password } = form.value;
    await login(email, password);
  }
</script>

<template>
  <VAppBar :elevation="2" color="primary">
    <template v-slot:prepend>
      <VAppBarNavIcon>
        <img src="~/assets/icons/petson.png" alt="nav-logo">
      </VAppBarNavIcon>
    </template>

    <VAppBarTitle style="color: #fff">
      petson
    </VAppBarTitle>

    <VTabs v-model="selectedTab" align-tabs="start" style="color: #fff">
      <VTab
          v-for="tab in tabs"
          :key="tab.label"
          :text="tab.label"
          :value="tab.label"
      />
    </VTabs>

    <template v-slot:append>
      <VRow justify="start">
        <VCol>
          <VBtn color="#fff" variant="outlined">
            <v-icon>mdi-cart</v-icon>
            CART
          </VBtn>
        </VCol>
        <template v-if="!isLoggedIn">
          <VCol >
            <VBtn color="#fff" variant="outlined" @click="loginDialog = true">
              LOGIN
            </VBtn>
          </VCol>
          <VCol>
            <VBtn color="#fff" variant="outlined">
              SIGN UP
            </VBtn>
          </VCol>
        </template>

        <VCol v-else>
          <VBtn @click="logout" color="#fff" variant="outlined">
            LOGOUT
          </VBtn>
        </VCol>

      </VRow>

      <v-dialog
          v-model="loginDialog"
          width="auto"
      >
        <v-card
            width="600"

        >
          <v-img
              class="mt-10"
              height="100"
              src="~/assets/img/petson-logo.svg"
          ></v-img>
          <VCardItem>
            <VCardTitle class="text-center text-primary mb-2">
              <Typography type="text-h6">Log in</Typography>
            </VCardTitle>
            <VCardText>
              <VTextField
                  label="Email"
                  v-model="form.email"
                  variant="outlined"
              />
              <VTextField
                  label="Password"
                  v-model="form.password"
                  type="password"
                  variant="outlined"
              />
              <VCheckbox label="Remember me" />

              <VBtn
                  color="primary text-white"
                  block
                  class="mt-4"
                  @click="handleLogin"
              >
                Log in
              </VBtn>
            </VCardText>
          </VCardItem>
        </v-card>
      </v-dialog>
    </template>
  </VAppBar>
</template>

<style scoped></style>
