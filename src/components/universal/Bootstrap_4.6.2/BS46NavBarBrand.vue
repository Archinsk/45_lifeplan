<!-- Версия 1.02 от 07.11.2023 -->
<!--Добавлены пропы type и action. Если type === "action-link", то при клике
срабатывает @click(action)-->
<!-- Версия 1.01 от 02.11.2023 -->

<template>
  <router-link
    v-if="type === 'router-link'"
    :to="href || '/'"
    class="navbar-brand"
    @click.native.prevent="$emit('click')"
  >
    <img
      v-if="imageSrc"
      :src="imageSrc"
      :class="navbarBrandImageClass"
      alt="brand-logo"
    />
    <div v-if="name">{{ name }}</div>
  </router-link>
  <a
    v-else-if="type === 'action-link'"
    href="#"
    class="navbar-brand"
    @click.prevent="handlerClick"
  >
    <img
      v-if="imageSrc"
      :src="imageSrc"
      :class="navbarBrandImageClass"
      alt="brand-logo"
    />
    <div v-if="name">{{ name }}</div>
  </a>
</template>

<script>
export default {
  name: "VbNavBarBrand",
  props: {
    type: String,
    href: String,
    name: String,
    imageSrc: String,
    monochrome: Boolean,
    light: Boolean,
    action: Object,
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
  methods: {
    handlerClick() {
      if (this.type === "action-link") {
        this.$emit("click", this.action);
      }
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
