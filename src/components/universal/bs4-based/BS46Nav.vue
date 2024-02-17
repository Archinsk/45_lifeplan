<!-- Версия 1.01 от 02.11.2023 -->

<template>
  <ul
    v-if="tag === 'ul'"
    :class="navClass"
    :style="scroll ? 'max-height: 7.5rem;' : ''"
  >
    <template v-if="itemsList">
      <vb-nav-item
        v-for="navLink of itemsList"
        :key="navLink.id"
        :id="navLink.id"
        :type="navLink.type"
        :href="navLink.href"
        :active="navLink.active"
        :disabled="navLink.disabled"
        :dropdown="navLink.dropdown"
        :dropdown-items-list="navLink.dropdownItemsList"
        :icon="navLink.icon"
        :badge="navLink.badge"
        :additionalClasses="navLink.additionalClasses"
        :windowData="windowData"
        :name="navLink.name"
        >{{ navLink.name }}</vb-nav-item
      >
    </template>
    <slot v-else></slot>
  </ul>
  <nav v-else :class="navClass">
    <template v-if="itemsList">
      <vb-nav-link
        v-for="navLink of itemsList"
        :key="navLink.id"
        :type="navLink.type"
        :href="navLink.href"
        :active="navLink.active"
        :disabled="navLink.disabled"
        :icon="navLink.icon"
        :badge="navLink.badge"
        :additional-classes="navLink.additionalClasses"
        :windowData="windowData"
        >{{ navLink.name }}</vb-nav-link
      >
    </template>
    <slot v-else></slot>
  </nav>
</template>

<script>
import VbNavLink from "./BS46NavLink";
import VbNavItem from "./BS46NavItem";
export default {
  name: "VbNav",
  components: { VbNavItem, VbNavLink },
  props: {
    tag: String,
    type: String,
    position: String,
    vertical: Boolean,
    fill: Boolean,
    justified: Boolean,
    scroll: Boolean,
    itemsList: Array,
    windowData: Object,
  },
  computed: {
    navClass() {
      let navClass = "nav";
      if (this.type === "tabs") {
        navClass += " nav-tabs";
      } else if (this.type === "pills") {
        navClass += " nav-pills";
      }
      if (this.position === "center") {
        navClass += " justify-content-center";
      } else if (this.position === "end") {
        navClass += " justify-content-end";
      }
      if (this.vertical) {
        navClass += " flex-column";
      }
      if (this.fill) {
        navClass += " nav-fill";
      }
      if (this.justified) {
        navClass += " nav-justified";
      }
      if (this.scroll) {
        navClass += " navbar-nav-scroll flex-nowrap";
      }
      return navClass;
    },
  },
};
</script>

<style lang="scss" scoped>
.offcanvas {
  .navbar-nav {
    flex-direction: column;
  }
}
</style>
