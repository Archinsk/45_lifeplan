<template>
  <li class="task bg-info border border-secondary mb-1">
    <TaskListItemButtonCategory
      icon="stars"
      :style="{backgroundColor: taskItem.hex_color, borderColor: taskItem.hex_color}"
    />
    <div class="task-text">
      {{ taskItem.id + " - " + taskItem.name + " - " + taskItem.hex_color }}
    </div>
  </li>
</template>

<script>
import TaskListItemButtonCategory from "@/components/TaskListItemButtonCategory";

export default {
  name: "ColorsListItem",
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
