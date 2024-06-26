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
    await login(email, password).then(() => {
      loginDialog.value = false;
    });
  }
</script>

<template>
  <VToolbar :elevation="2" color="primary" height="80">
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
                size="large"
                class="text-white"
                variant="outlined"
                @click="loginDialog = true">
                LOGIN
              </VBtn>
              <VBtn
                class="text-white"
                variant="outlined"
                size="large"
              >
                SIGN UP
              </VBtn>
            </template>
            <VBtn
                v-else
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

    <VDialog
        v-model="loginDialog"
        width="auto"
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
      </VCard>
    </VDialog>

<!--    <template v-slot:prepend>-->
<!--      <VAppBarNavIcon class="ml-4">-->
<!--        <img src="~/assets/icons/petson.png" alt="nav-logo">-->
<!--      </VAppBarNavIcon>-->
<!--    </template>-->

<!--    <VAppBarTitle class="text-white">-->
<!--      petson.-->
<!--    </VAppBarTitle>-->

<!--    <VRow justify="start">-->
<!--      <VTabs v-model="selectedTab" align-tabs="start" style="color: #fff">-->
<!--        <VTab-->
<!--            v-for="tab in tabs"-->
<!--            :key="tab.label"-->
<!--            :text="tab.label"-->
<!--            :value="tab.label"-->
<!--        />-->
<!--      </VTabs>-->
<!--    </VRow>-->


<!--    <template v-slot:append>-->
<!--      <VRow justify="end" class="mr-4">-->
<!--        <VCol>-->
<!--          <VBtn color="#fff" variant="outlined">-->
<!--            <v-icon>mdi-cart</v-icon>-->
<!--            CART-->
<!--          </VBtn>-->
<!--        </VCol>-->
<!--        <template v-if="!isLoggedIn">-->
<!--          <VCol >-->
<!--            <VBtn color="#fff" variant="outlined" @click="loginDialog = true">-->
<!--              LOGIN-->
<!--            </VBtn>-->
<!--          </VCol>-->
<!--          <VCol>-->
<!--            <VBtn color="#fff" variant="outlined">-->
<!--              SIGN UP-->
<!--            </VBtn>-->
<!--          </VCol>-->
<!--        </template>-->

<!--        <VCol v-else>-->
<!--          <VBtn @click="logout" color="#fff" variant="outlined">-->
<!--            LOGOUT-->
<!--          </VBtn>-->
<!--        </VCol>-->

<!--      </VRow>-->

<!--      <VDialog-->
<!--          v-model="loginDialog"-->
<!--          width="auto"-->
<!--      >-->
<!--        <VCard-->
<!--            width="600"-->

<!--        >-->
<!--          <VImg-->
<!--              class="mt-10"-->
<!--              height="100"-->
<!--              src="~/assets/img/petson-logo.svg"-->
<!--          ></VImg>-->
<!--          <VCardItem>-->
<!--            <VCardTitle class="text-center text-primary mb-2">-->
<!--              <Typography type="text-h6">Log in</Typography>-->
<!--            </VCardTitle>-->
<!--            <VCardText>-->
<!--              <VTextField-->
<!--                  label="Email"-->
<!--                  v-model="form.email"-->
<!--                  variant="outlined"-->
<!--              />-->
<!--              <VTextField-->
<!--                  label="Password"-->
<!--                  v-model="form.password"-->
<!--                  type="password"-->
<!--                  variant="outlined"-->
<!--              />-->
<!--              <VCheckbox label="Remember me" />-->

<!--              <VBtn-->
<!--                  color="primary text-white"-->
<!--                  block-->
<!--                  class="mt-4"-->
<!--                  @click="handleLogin"-->
<!--              >-->
<!--                Log in-->
<!--              </VBtn>-->
<!--            </VCardText>-->
<!--          </VCardItem>-->
<!--        </VCard>-->
<!--      </VDialog>-->
<!--    </template>-->
  </VToolbar>
</template>

<style scoped></style>
