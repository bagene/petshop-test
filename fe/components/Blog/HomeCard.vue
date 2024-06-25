<script setup lang="ts">

</script>

<template>
  <VCard variant="flat">
    <VCardItem>
      <VContainer fluid>
        <VRow align-content="center">
          <VCol cols="6">
            <VImg height="400" src="~/assets/img/treat-your-pup.png" />
          </VCol>
          <VCol align-self="center" cols="6">
            <VSpacer />
            <VCardText>
              <Typography type="text-h2 mb-2" class="text-primary">
                Treat your Pup
              </Typography>
              <VBtn
                  :rounded="false"
                  variant="flat"
                  color="primary text-white"
                  class="text-decoration-underline"
              >
                Discover our dog treat selection
              </VBtn>
            </VCardText>
          </VCol>
        </VRow>
      </VContainer>
    </VCardItem>

  </VCard>
</template>
