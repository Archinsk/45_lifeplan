<template>
  <header class="header bg-primary">
    <div class="container">
      <img
        id="logo"
        src="@/assets/lifeplan_logo.svg"
        alt="Life Plan Logo"
        @click="$emit('lists-toggle')"
      />
      <div class="nav">
        <HeaderButton icon="menu" />
        <HeaderButton
          icon="login"
          data-bs-toggle="modal"
          data-bs-target="#signInFormModal"
        />
      </div>
    </div>
  </header>
</template>

<script>
import HeaderButton from "@/components/HeaderButton";

export default {
  name: "Header",

  components: {
    HeaderButton,
  },
};
</script>
