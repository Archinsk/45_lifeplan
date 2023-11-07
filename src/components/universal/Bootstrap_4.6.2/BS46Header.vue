<!-- Версия 1.02 от 07.11.2023 -->
<!--Добавлено событие @nav-bar-brand-click(action)-->
<!-- Версия 1.01 от 04.11.2023 -->

<template>
  <header v-if="nav || brand" :class="container && theme ? 'bg-' + theme : ''">
    <div :class="container ? 'container' : ''">
      <vb-nav-bar
        :id="id ? id + '-navbar' : ''"
        :expand="offcanvas || expand"
        :expand-size="expandSize && !offcanvas ? expandSize : ''"
        :theme="theme"
        :dark="dark"
        :monochrome-brand-image="monochrome"
        :brand="brand"
        :without-toggler="!isCollapseButton"
        :justify-content="justifyContent"
        :class="container ? 'px-0' : ''"
        @nav-bar-brand-click="$emit('nav-bar-brand-click', $event)"
      >
        <!-- Вариант с выезжающей панелью-->
        <vb-offcanvas
          v-if="offcanvas"
          :id="id + 'offcanvas'"
          :no-effect-point="expand && expandSize ? expandSize : ''"
          :theme="theme"
          :scrollable="scroll"
        >
          <vb-nav
            v-if="nav && nav.itemsList"
            tag="ul"
            class="navbar-nav"
            :items-list="nav.itemsList"
            :window-data="windowData"
          />
        </vb-offcanvas>
        <!-- Вариант без выезжающей панели (стандартный Bootstrap)-->
        <vb-nav
          v-else-if="nav && nav.itemsList"
          :scroll="scroll"
          tag="ul"
          class="navbar-nav"
          :items-list="nav.itemsList"
          :window-data="windowData"
        />
        <template v-if="isOffcanvasButton" v-slot:navbar-end>
          <vb-offcanvas-button
            :target-id="id + 'offcanvas'"
            :class="'d-' + expandSize + '-none'"
            theme="outline-light"
            icon="menu"
            square
          />
        </template>
      </vb-nav-bar>
    </div>
  </header>
</template>

<script>
import VbNavBar from "./BS46NavBar";
import VbOffcanvas from "./BS46Offcanvas";
import VbNav from "./BS46Nav";
import VbOffcanvasButton from "./BS46OffcanvasButton";
export default {
  name: "VbHeader",
  components: {
    VbOffcanvasButton,
    VbNav,
    VbOffcanvas,
    VbNavBar,
  },
  props: {
    id: String,
    offcanvas: Boolean,
    expand: Boolean,
    expandSize: String,
    theme: String,
    dark: Boolean,
    monochrome: Boolean,
    brand: Object,
    nav: Object,
    container: Boolean,
    justifyContent: String,
    scroll: Boolean,
    windowData: Object,
  },
  computed: {
    isCollapseButton() {
      return !!(
        !this.offcanvas &&
        this.nav &&
        this.nav.itemsList &&
        this.nav.itemsList.length &&
        !(this.expand && !this.expandSize)
      );
    },
    isOffcanvasButton() {
      return !!(
        this.offcanvas &&
        this.nav &&
        this.nav.itemsList &&
        this.nav.itemsList.length &&
        !(this.expand && !this.expandSize)
      );
    },
  },
};
</script>
