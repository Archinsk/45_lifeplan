<template>
  <ul v-if="listItems[0].id" class="taskList">
    <ColorsListItem
      v-for="item of listItems"
      :key="item.id"
      :color="item"
      :selected-category-icon="selectedCategoryIcon"
      :style="{
        backgroundColor: item.hex_color,
        borderColor: item.hex_color,
      }"
      @change-color-selected-category="$emit('change-color-selected-category', item)"
    />
  </ul>
</template>

<script>
import ColorsListItem from "./ColorsListItem";

export default {
  name: "ColorsList",
  props: ["listItems", "selectedCategoryIcon"],
  components: {
    ColorsListItem,
  },
  mounted() {
    console.log("Компонент ColorsList смонтирован");
  },
};
</script>
