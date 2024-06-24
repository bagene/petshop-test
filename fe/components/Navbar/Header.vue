<script setup lang="ts">
  import {navLinks} from "~/contants/nav-links";

  const selectedTab = ref(navLinks[0]);
  const tabs = ref(navLinks);
</script>

<template>
  <VAppBar :elevation="2" color="primary" >
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
        <VCol>
          <VBtn color="#fff" variant="outlined">
            LOGOUT
          </VBtn>
        </VCol>
      </VRow>
    </template>
  </VAppBar>
</template>

<style scoped></style>
