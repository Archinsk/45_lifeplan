<template>
  <ul class="taskList">
    <CategoriesListItem
      v-for="item of listItems"
      :key="
        item.category && item.category.id
          ? item.id + '-' + item.category.id
          : item.id
      "
      :task-item="item"
      @open-modal-edit-category="$emit('open-modal-edit-category', item)"
      @open-modal-delete-category="$emit('open-modal-delete-category', item)"
    />
  </ul>
</template>

<script>
import CategoriesListItem from "@/components/CategoriesListItem";

export default {
  name: "CategoriesList",
  props: ["listItems"],
  components: {
    CategoriesListItem,
  },
  updated() {
    console.log("Список обновлен");
    console.log("Лист при обновлении компонента");
    console.log(this.listItems);
  },
  mounted() {
    console.log("Смонтирован список");
    console.log("Лист при монтировании компонента");
    console.log(this.listItems);
  },
};
</script>
