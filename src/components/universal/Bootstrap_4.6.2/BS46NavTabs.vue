<!-- Версия 1.01 от 06.11.2023 -->

<template>
  <vb-nav
    :id="id"
    :type="pills ? 'pills' : 'tabs'"
    :position="position"
    :vertical="vertical"
    :fill="fill"
    :justified="justified"
  >
    <template v-if="itemsList && itemsList.length">
      <vb-nav-tab-link
        v-for="navTabLink of itemsList"
        :key="navTabLink.id"
        :id="id ? id + '-' + navTabLink.id : navTabLink.id"
        :href="id ? id + '-' + navTabLink.id : navTabLink.id"
        :active="navTabLink.active"
        :disabled="navTabLink.disabled"
      >
        {{ navTabLink.name }}
      </vb-nav-tab-link>
    </template>
    <slot v-else></slot>
  </vb-nav>
</template>

<script>
import VbNav from "./BS46Nav";
import VbNavTabLink from "./BS46NavTabLink";
export default {
  name: "VbNavTabs",
  components: { VbNavTabLink, VbNav },
  props: {
    id: String,
    pills: Boolean,
    position: String,
    vertical: Boolean,
    fill: Boolean,
    justified: Boolean,
    itemsList: Array,
  },
};
</script>
