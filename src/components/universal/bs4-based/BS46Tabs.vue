<!-- Версия 1.01 от 06.11.2023 -->

<template>
  <div>
    <vb-nav-tabs
      :id="id"
      :items-list="itemsList"
      :pills="pills"
      :position="position"
      :vertical="vertical"
      :fill="fill"
      :justified="justified"
    />
    <vb-tab-content :id="id">
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
    </vb-tab-content>
  </div>
</template>

<script>
import VbNavTabs from "./BS46NavTabs";
import VbTabContent from "./BS46TabContent";
import VbTabPane from "./BS46TabPane";
export default {
  name: "VbTabs",
  components: { VbTabPane, VbTabContent, VbNavTabs },
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
