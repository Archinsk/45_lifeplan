<template>
  <TaskListItemButtonCategory
    class="mb-2"
    :icon="icon.icon"
    :style="{
      backgroundColor: selectedCategoryColor,
      borderColor: selectedCategoryColor,
    }"
    @filter-category="$emit('change-icon-selected-category')"
  />
</template>

<script>
import TaskListItemButtonCategory from "@/components/TaskListItemButtonCategory";

export default {
  name: "IconsListItem",
  props: ["icon", "selectedCategoryColor"],
  components: {
    TaskListItemButtonCategory,
  },
  data() {
    return {
      contextMenuVisibility: false,
    };
  },

  methods: {
    toggleContextMenu() {
      this.contextMenuVisibility = !this.contextMenuVisibility;
    },
  },
};
</script>
