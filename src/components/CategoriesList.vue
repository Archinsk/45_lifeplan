<template>
  <ul class="taskList">
    <CategoriesListItem
      v-for="item of listItems"
      :key="item.id"
      :theme="theme"
      :category="item"
      @open-modal-edit-category="$emit('open-modal-edit-category', item)"
      @open-modal-delete-category="$emit('open-modal-delete-category', item)"
    />
  </ul>
</template>

<script>
import CategoriesListItem from "@/components/CategoriesListItem";

export default {
  name: "CategoriesList",
  props: ["listItems", "theme"],
  components: {
    CategoriesListItem,
  },
  mounted() {
    console.log("Компонент CategoriesList смонтирован");
  },
};
</script>
