<template>
  <ul class="colorsList d-flex flex-wrap gap-2 mb-0">
    <vb-button
      v-for="item of listItems"
      :key="item.id"
      :icon="selectedCategoryIcon"
      square
      :class="
        'color-button btn-' +
        lightnessMode +
        '-' +
        item.name +
        '-primary text-' +
        theme.info
      "
      @click="$emit('change-color-selected-category', item)"
    />
  </ul>
</template>

<script>
import VbButton from "./universal/bs4-based/BS46Button";

export default {
  name: "ColorsList",
  props: ["listItems", "selectedCategoryIcon", "theme", "lightnessMode"],
  components: {
    VbButton,
  },
  mounted() {
    console.log("Компонент ColorsList смонтирован");
  },
};
</script>
