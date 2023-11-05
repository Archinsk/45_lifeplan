<!-- Версия 1.01 от 02.11.2023 -->

<template>
  <router-link :to="href || '/'" class="navbar-brand" @click="$emit('click')">
    <img
      v-if="imageSrc"
      :src="imageSrc"
      :class="navbarBrandImageClass"
      alt="brand-logo"
    />
    <div v-if="name">{{ name }}</div>
  </router-link>
</template>

<script>
export default {
  name: "VbNavBarBrand",
  props: {
    href: String,
    name: String,
    imageSrc: String,
    monochrome: Boolean,
    light: Boolean,
  },
  computed: {
    navbarBrandImageClass() {
      let navbarBrandImageClass = "";
      if (this.monochrome) {
        if (this.light) {
          navbarBrandImageClass = "navbar-brand-image-light";
        } else {
          navbarBrandImageClass = "navbar-brand-image-dark";
        }
      }
      return navbarBrandImageClass;
    },
  },
};
</script>

<style lang="scss" scoped>
.navbar-brand {
  font-size: 1rem;
  font-weight: bold;
  line-height: 0.875em;
  white-space: normal;
  display: flex;
  align-items: center;

  img {
    height: 1.875rem;
  }

  div {
    flex-wrap: wrap;

    &:not(:first-child) {
      margin-left: 0.5rem;
    }
  }

  .navbar-brand-image-light {
    filter: brightness(0%) invert(100%);
  }

  .navbar-brand-image-dark {
    filter: brightness(0%);
  }
}
</style>
