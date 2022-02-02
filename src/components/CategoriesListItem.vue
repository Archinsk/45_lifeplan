<template>
  <li class="task bg-info border border-secondary mb-1">
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
      data-bs-target="#delete-category"
    />
    <ContextMenuButton
      v-show="contextMenuVisibility"
      icon="mode"
      @toggle-context-menu="$emit('open-modal-edit-category')"
      data-bs-toggle="modal"
      data-bs-target="#edit-category"
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
  props: ["category"],
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
