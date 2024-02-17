<!-- Версия 1.01 от 06.11.2023 -->

<template>
  <vb-nav-link
    type="a"
    :id="id + '-tab'"
    :href="`#${href}`"
    :active="active"
    :disabled="disabled"
    :aria-controls="href"
    :aria-selected="active"
    data-toggle="tab"
    role="tab"
    @click="$emit('click')"
    ><slot></slot
  ></vb-nav-link>
</template>

<script>
import VbNavLink from "./BS46NavLink";
export default {
  name: "VbNavTabLink",
  components: { VbNavLink },
  props: {
    id: String,
    href: String,
    active: Boolean,
    disabled: Boolean,
  },
};
</script>
