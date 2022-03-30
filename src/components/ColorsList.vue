<template>
  <ul class="colorsList d-flex flex-wrap gap-2 mb-0">
    <ButtonIconSquare
      v-for="item of listItems"
      :key="item.id"
      :icon="selectedCategoryIcon"
      :class="
        'color-button btn-' +
        lightnessMode +
        '-' +
        item.name +
        '-primary text-' +
        theme.info
      "
      @click-handler="$emit('change-color-selected-category', item)"
    />
  </ul>
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

export default {
  name: "ColorsList",
  props: ["listItems", "selectedCategoryIcon", "theme", "lightnessMode"],
  components: {
    ButtonIconSquare,
  },
  mounted() {
    console.log("Компонент ColorsList смонтирован");
  },
};
</script>
