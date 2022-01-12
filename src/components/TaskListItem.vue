<template>
  <li
    class="task bg-info border border-secondary mb-1"
    :class="{ taskCompleted: taskItem.completed }"
    @click="$emit('toggleComplete', taskItem.id)"
  >
    <TaskListItemButtonCategory :icon="taskItem.icon" />
    <TaskListItemButtonDeleteTask icon="close" />
    <div class="task-text">
      {{ taskItem.task }}
    </div>
  </li>
</template>

<script>
import TaskListItemButtonCategory from "@/components/TaskListItemButtonCategory";
import TaskListItemButtonDeleteTask from "./TaskListItemButtonDeleteTask";

export default {
  name: "TaskListItem",
  props: ["taskItem"],
  components: {
    TaskListItemButtonDeleteTask,
    TaskListItemButtonCategory,
  },
};
</script>
