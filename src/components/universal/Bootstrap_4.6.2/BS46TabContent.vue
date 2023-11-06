<!-- Версия 1.01 от 06.11.2023 -->

<template>
  <div class="tab-content">
    <template v-if="itemsList && itemsList.length">
      <vb-tab-pane
        v-for="tabPane of itemsList"
        :key="tabPane.id"
        :id="id ? id + '-' + tabPane.id : tabPane.id"
        :active="tabPane.active"
      >
        <slot :name="tabPane.id"></slot>
      </vb-tab-pane>
    </template>
    <slot v-else></slot>
  </div>
</template>

<script>
import VbTabPane from "./BS46TabPane";
export default {
  name: "VbTabContent",
  components: { VbTabPane },
  props: {
    id: String,
    itemsList: Array,
  },
};
</script>
