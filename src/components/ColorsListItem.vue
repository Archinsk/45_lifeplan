<template>
  <TaskListItemButtonCategory
    class="mb-2"
    :icon="selectedCategoryIcon"
    :style="{
      backgroundColor: color.hex_color,
      borderColor: color.hex_color,
    }"
    @filter-category="$emit('change-color-selected-category')"
  />
</template>

<script>
import TaskListItemButtonCategory from "@/components/TaskListItemButtonCategory";

export default {
  name: "ColorsListItem",
  props: ["color", "selectedCategoryIcon"],
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
