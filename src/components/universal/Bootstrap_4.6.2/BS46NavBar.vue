<!-- Версия 1.01 от 03.11.2023 -->

<template>
  <nav :class="navbarClass" :id="id">
    <vb-nav-bar-brand
      v-if="brand"
      :href="brand.href"
      :name="brand.name"
      :image-src="brand.imageSrc"
      :monochrome="monochromeBrandImage"
      :light="dark"
    />
    <vb-collapse-button
      v-if="!withoutToggler"
      aria-label="Toggle navigation"
      :target-id="id ? id + '-collapse' : 'navbarCollapseContent'"
      theme="outline-light"
      square
      icon="menu"
      :class="'d-' + expandSize + '-none'"
    />
    <vb-collapse
      class="navbar-collapse"
      :id="id ? id + '-collapse' : 'navbarCollapseContent'"
    >
      <slot></slot>
    </vb-collapse>
    <slot name="navbar-end"></slot>
  </nav>
</template>

<script>
import VbNavBarBrand from "./BS46NavBarBrand";
import VbCollapseButton from "./BS46CollapseButton";
import VbCollapse from "./BS46Collapse";
export default {
  name: "VbNavBar",
  components: {
    VbCollapse,
    VbCollapseButton,
    VbNavBarBrand,
  },
  props: {
    id: String,
    dark: Boolean,
    theme: String,
    scroll: Boolean,
    monochromeBrandImage: Boolean,
    expand: Boolean,
    expandSize: String,
    brand: Object,
    withoutToggler: Boolean,
    justifyContent: String,
  },
  computed: {
    navbarClass() {
      let navbarClass = "navbar";
      if (this.dark) {
        navbarClass += " navbar-dark";
      } else {
        navbarClass += " navbar-light";
      }
      if (this.theme) {
        navbarClass += ` bg-${this.theme}`;
      }
      if (this.expand) {
        if (this.expandSize) {
          if (["sm", "md", "lg", "xl"].includes(this.expandSize)) {
            navbarClass += ` navbar-expand-${this.expandSize}`;
          } else {
            navbarClass += " navbar-expand-sm";
          }
        } else {
          navbarClass += " navbar-expand";
        }
      }
      if (
        ["start", "center", "end", "between", "around"].includes(
          this.justifyContent
        )
      ) {
        navbarClass += ` justify-content-${this.justifyContent}`;
      }
      return navbarClass;
    },
  },
};
</script>
