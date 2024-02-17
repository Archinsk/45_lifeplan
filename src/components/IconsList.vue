<template>
  <ul class="iconsList d-flex flex-wrap gap-2 mb-0">
    <vb-button
      v-for="item of listItems"
      :key="item.id"
      :icon="item.icon"
      square
      :class="categoryButtonClass"
      @click="$emit('change-icon-selected-category', item)"
    />
  </ul>
</template>

<script>
import VbButton from "./universal/bs4-based/BS46Button";

export default {
  name: "IconsList",
  props: ["listItems", "selectedCategoryColor", "theme", "lightnessMode"],
  components: {
    VbButton,
  },
  computed: {
    categoryButtonClass: function () {
      let categoryClass = "bg-" + this.lightnessMode;
      if (this.selectedCategoryColor) {
        categoryClass +=
          "-" + this.selectedCategoryColor + "-primary text-" + this.theme.info;
      } else {
        categoryClass += "-neutral-600 text-" + this.theme.info;
      }
      return categoryClass;
    },
  },
};
</script>
