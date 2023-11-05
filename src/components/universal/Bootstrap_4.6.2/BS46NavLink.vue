<!-- Версия 1.01 от 02.11.2023 -->

<template>
  <a
    v-if="type === 'a'"
    :href="href"
    :class="navLinkClass"
    @click="$emit('click')"
  >
    <vb-icon
      v-if="icon"
      :name="typeof icon === 'string' ? icon : icon.name"
      :format="icon.format"
      :type="icon.type"
    />
    <span><slot></slot></span>
  </a>
  <vb-modal-button
    v-else-if="type === 'modal-link'"
    :target-id="href"
    tag="a"
    :icon="icon"
    :class="navLinkClass"
    without-btn-class
    :additional-classes="additionalClasses"
  >
    <span>
      <slot></slot>
    </span>
    <vb-badge
      v-if="badge"
      :theme="badge.theme"
      :pill="badge.pill"
      :not-null-display="badge.notNullDisplay"
      :value="badge.value"
      :max="badge.max"
      class="ml-2"
    />
  </vb-modal-button>
  <router-link
    v-else
    :to="href"
    :class="navLinkClass"
    @click.native.prevent="clickLink"
    ><vb-icon
      v-if="icon"
      :name="typeof icon === 'string' ? icon : icon.name"
      :format="icon.format"
      :type="icon.type"
    />
    <span>
      <slot></slot>
    </span>
  </router-link>
</template>

<script>
import VbModalButton from "./BS46ModalButton";
import VbIcon from "./BS46Icon";
import VbBadge from "./BS46Badge";
export default {
  name: "VbNavLink",
  components: { VbBadge, VbIcon, VbModalButton },
  props: {
    type: String,
    href: String,
    active: Boolean,
    disabled: Boolean,
    icon: [Object, String],
    badge: Object,
    additionalClasses: String,
    withoutNavLinkClass: Boolean,
  },
  computed: {
    navLinkClass() {
      let navLinkClass = "";
      if (!this.withoutNavLinkClass) {
        navLinkClass += " nav-link";
      }
      if (this.disabled) {
        navLinkClass += " disabled";
      } else if (this.active) {
        navLinkClass += " active";
      }
      return navLinkClass;
    },
  },
  methods: {
    clickLink() {
      this.$emit("click");
    },
  },
};
</script>

<style lang="scss" scoped>
.nav-link {
  padding-top: 0.4375rem;
  padding-bottom: 0.4375rem;

  .icon + * {
    margin-left: 0.5em;
  }
}

.offcanvas.show {
  .offcanvas-body {
    .dropdown {
      .dropdown-toggle {
        padding: 0.4375rem 0;
      }
    }
    .nav-link {
      padding-left: 0;
      padding-right: 0;
    }
  }
}

.navbar-collapse.show,
.navbar-collapse.collapsing {
  .dropdown {
    .dropdown-toggle {
      padding: 0.4375rem 0;
    }
  }
}
</style>
