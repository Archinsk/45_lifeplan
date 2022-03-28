<template>
  <ul class="iconsList">
    <ButtonIconSquare
      v-for="item of listItems"
      :key="item.id"
      :icon="item.icon"
      :class="categoryButtonClass"
      @click-handler="$emit('change-icon-selected-category', item)"
    />
  </ul>
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

export default {
  name: "IconsList",
  props: ["listItems", "selectedCategoryColor", "theme", "lightnessMode"],
  components: {
    ButtonIconSquare,
  },
  computed: {
    categoryButtonClass: function () {
      let categoryClass = "me-2 mb-2 bg-" + this.lightnessMode;
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
