<template>
  <li :class="'task border mb-1 border-secondary bg-' + theme.info">
    <TaskListItemButtonCategory
      v-if="category.icon"
      :icon="category.icon"
      :style="{ backgroundColor: category.color, borderColor: category.color }"
    />
    <ContextMenuButton
      icon="more_horiz"
      @toggle-context-menu="toggleContextMenu"
    />
    <ContextMenuButton
      v-show="contextMenuVisibility"
      icon="close"
      @toggle-context-menu="$emit('open-modal-delete-category')"
      data-bs-toggle="modal"
      data-bs-target="#deleteCategoryModal"
    />
    <ContextMenuButton
      v-show="contextMenuVisibility"
      icon="mode"
      @toggle-context-menu="$emit('open-modal-edit-category')"
      data-bs-toggle="modal"
      data-bs-target="#editCategoryModal"
    />
    <div class="task-text">
      {{ category.name }}
    </div>
  </li>
</template>

<script>
import TaskListItemButtonCategory from "@/components/TaskListItemButtonCategory";
import ContextMenuButton from "./ContextMenuButton";

export default {
  name: "CategoriesListItem",
  props: ["category", "theme"],
  components: {
    TaskListItemButtonCategory,
    ContextMenuButton,
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
