<template>
  <ul class="iconsList">
    <IconsListItem
      v-for="item of listItems"
      :key="item.id"
      :icon="item"
      :selected-category-color="selectedCategoryColor"
      @change-icon-selected-category="
        $emit('change-icon-selected-category', item)
      "
    />
  </ul>
</template>

<script>
import IconsListItem from "./IconsListItem";

export default {
  name: "IconsList",
  props: ["listItems", "selectedCategoryColor"],
  components: {
    IconsListItem,
  },
};
</script>
