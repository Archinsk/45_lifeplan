<!-- Версия 1.01 от 02.11.2023 -->

<template>
  <li :class="navItemClass">
    <template v-if="!dropdown">
      <vb-modal-button
        v-if="type === 'modal-link' && linkIsSquareButton"
        :icon="icon"
        :badge="badge"
        :additional-classes="additionalClasses.navLink"
        square
        :data-target="'#' + href"
        class="mx-2"
        @click="$emit('click')"
      ></vb-modal-button>
      <vb-nav-link
        v-else
        :type="type"
        :href="href"
        :active="active"
        :disabled="disabled"
        :icon="icon"
        :badge="badge"
        @click="$emit('click')"
        ><slot></slot
      ></vb-nav-link>
    </template>
    <template v-else>
      <vb-nav-link
        :id="id"
        :type="type"
        :href="href"
        :active="active"
        :disabled="disabled"
        :icon="icon"
        :badge="badge"
        :class="dropdownLinkClass"
        :without-nav-link-class="isNestedDropdown"
        role="button"
        data-toggle="dropdown"
        aria-expanded="false"
        @click="$emit('click')"
        ><slot></slot
      ></vb-nav-link>
      <div class="dropdown-menu">
        <template v-for="dropdownItem of dropdownItemsList">
          <vb-dropdown-item
            v-if="!dropdownItem.dropdown"
            :key="dropdownItem.id"
            :type="dropdownItem.type"
            :href="dropdownItem.href"
            :active="dropdownItem.active"
            :disabled="dropdownItem.disabled"
            :icon="dropdownItem.icon"
            @click="$emit('nav-link-click', dropdownItem)"
            >{{ dropdownItem.name }}</vb-dropdown-item
          >
          <vb-nav-item
            v-else
            :key="dropdownItem.id"
            :id="dropdownItem.id"
            :type="dropdownItem.type"
            :href="dropdownItem.href"
            :active="dropdownItem.active"
            :disabled="dropdownItem.disabled"
            :dropdown="dropdownItem.dropdown"
            :icon="dropdownItem.icon"
            :badge="dropdownItem.badge"
            :additional-classes="additionalClasses"
            :window-data="windowData"
            :dropdown-items-list="dropdownItem.dropdownItemsList"
            is-nested-dropdown
            @click="$emit('click', dropdownItem)"
          >
            {{ dropdownItem.name }}
          </vb-nav-item>
        </template>
      </div>
    </template>
  </li>
</template>

<script>
import $ from "jquery";
import VbNavLink from "./BS46NavLink";
import VbModalButton from "./BS46ModalButton";
import VbDropdownItem from "./BS46DropdownItem";
export default {
  name: "VbNavItem",
  components: { VbDropdownItem, VbModalButton, VbNavLink },
  props: {
    id: String,
    type: String,
    href: String,
    active: Boolean,
    disabled: Boolean,
    dropdown: Boolean,
    icon: [Object, String],
    badge: Object,
    additionalClasses: Object,
    windowData: Object,
    dropdownItemsList: Array,
    name: String,
    isNestedDropdown: Boolean,
  },
  computed: {
    navItemClass() {
      let navItemClass = "";
      if (!this.isNestedDropdown) {
        navItemClass += "nav-item";
      }
      if (this.dropdown) {
        navItemClass += " dropdown";
      }
      return navItemClass;
    },
    dropdownLinkClass() {
      let dropdownLinkClass = "dropdown-toggle";
      if (this.isNestedDropdown) {
        dropdownLinkClass += " dropdown-item";
      }
      return dropdownLinkClass;
    },
    linkIsSquareButton() {
      let additionalClassesArray;
      if (this.additionalClasses && this.additionalClasses.navLink) {
        additionalClassesArray = this.additionalClasses.navLink.split(" ");
      } else {
        return false;
      }
      return (
        additionalClassesArray.includes("btn-square") ||
        (additionalClassesArray.includes("btn-square-sm") &&
          this.windowData.width >= 576) ||
        (additionalClassesArray.includes("btn-square-md") &&
          this.windowData.width >= 768) ||
        (additionalClassesArray.includes("btn-square-lg") &&
          this.windowData.width >= 992) ||
        (additionalClassesArray.includes("btn-square-xl") &&
          this.windowData.width >= 1200)
      );
    },
  },
  mounted() {
    if (this.dropdown && this.isNestedDropdown) {
      $("#" + this.id).on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();

        if ($(this).parent().hasClass("show")) {
          $(this).parent().removeClass("show");
          $(this).next().removeClass("show");
        } else {
          $(this).parent().addClass("show");
          $(this).next().addClass("show");
        }
      });
    }
  },
};
</script>

<style lang="scss" scoped>
.nav-item {
  padding-top: 0.0625rem;
  padding-bottom: 0.0625rem;
}

.navbar-dark {
  .offcanvas.show {
    .offcanvas-body {
      .dropdown-menu {
        background-color: hsla(0, 0%, 100%, 0.2);
      }
    }
    .nav-item {
      padding: 0;
    }
  }

  .navbar-collapse.show,
  .navbar-collapse.collapsing {
    .dropdown-menu {
      background-color: hsla(0, 0%, 100%, 0.2);
    }
    .nav-item {
      padding: 0;
    }
  }
}

.offcanvas.show {
  @mixin static-dropdown-menu {
    .offcanvas-body {
      .dropdown-menu {
        position: unset !important;
        transform: translate3d(0px, 0px, 0px) !important;
        border: none;
        border-radius: unset;
        padding: 0 0 0 1rem;
        margin-top: 0;
      }
    }
  }

  @media (max-width: 575.98px) {
    &.offcanvas-sm {
      @include static-dropdown-menu;
    }
  }

  @media (max-width: 767.98px) {
    &.offcanvas-md {
      @include static-dropdown-menu;
    }
  }

  @media (max-width: 991.98px) {
    &.offcanvas-lg {
      @include static-dropdown-menu;
    }
  }

  @media (max-width: 1199.98px) {
    &.offcanvas-xl {
      @include static-dropdown-menu;
    }
  }
}

@mixin static-dropdown-menu {
  .navbar-collapse.show,
  .navbar-collapse.collapsing {
    .dropdown-menu {
      position: unset !important;
      transform: translate3d(0px, 0px, 0px) !important;
      border: none;
      border-radius: unset;
      padding: 0 0 0 1rem;
      margin-top: 0;
    }
  }
}

.navbar-expand-sm {
  @media (max-width: 575.98px) {
    @include static-dropdown-menu;
  }
}
.navbar-expand-md {
  @media (max-width: 767.98px) {
    @include static-dropdown-menu;
  }
}
.navbar-expand-lg {
  @media (max-width: 991.98px) {
    @include static-dropdown-menu;
  }
}
.navbar-expand-xl {
  @media (max-width: 1199.98px) {
    @include static-dropdown-menu;
  }
}
</style>
