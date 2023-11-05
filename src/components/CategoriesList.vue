<template>
  <ul class="taskList">
    <template v-if="listItems.length">
      <CategoriesListItem
        v-for="item of listItems"
        :key="item.id"
        :theme="theme"
        :lightness-mode="lightnessMode"
        :category="item"
        @open-modal-edit-category="$emit('open-modal-edit-category', item)"
        @open-modal-delete-category="$emit('open-modal-delete-category', item)"
      />
    </template>
  </ul>
</template>

<script>
import CategoriesListItem from "@/components/CategoriesListItem";

export default {
  name: "CategoriesList",
  props: ["listItems", "theme", "lightnessMode"],
  components: {
    CategoriesListItem,
  },
  mounted() {
    console.log("Компонент CategoriesList смонтирован");
  },
};
</script>
