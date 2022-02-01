<template>
  <li class="task bg-info border border-secondary mb-1">
    <TaskListItemButtonCategory
      :icon="taskItem.icon"
      style="background-color: grey; border-color: grey"
    />
    <div class="task-text">
      {{ taskItem.id + " - " + taskItem.name }}
    </div>
  </li>
</template>

<script>
import TaskListItemButtonCategory from "@/components/TaskListItemButtonCategory";

export default {
  name: "IconsListItem",
  props: ["taskItem"],
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
