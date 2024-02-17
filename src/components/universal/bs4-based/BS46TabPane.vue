<!-- Версия 1.01 от 06.11.2023 -->

<template>
  <div
    :class="tabPaneClass"
    :id="id"
    :aria-labelledby="`${id}-tab`"
    role="tabpanel"
  >
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: "VbTabPane",
  props: {
    id: String,
    active: Boolean,
  },
  computed: {
    tabPaneClass() {
      let tabPaneClass = "tab-pane fade";
      if (this.active) {
        tabPaneClass += " show active";
      }
      return tabPaneClass;
    },
  },
};
</script>
