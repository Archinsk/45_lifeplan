<template>
  <li
    class="alert alert-secondary alert-dismissible fade show mb-1 task"
    :class="{ taskCompleted: taskItem.completed }"
    role="alert"
    @click="$emit('toggleComplete', taskItem.id)"
  >
    <TaskListItemButtonCategory :icon="taskItem.icon" />
    {{ taskItem.task }}
    <TaskListItemButtonDeleteTask icon="close" />
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

<style lang="scss" scoped>
.task {
  display: flex;
  align-items: center;
  background-color: RGB(240, 255, 224);
  color: RGB(80, 80, 80);
  border-color: RGB(128, 128, 128);
  padding: 0;

  &.taskCompleted {
    background-color: transparent;
    color: RGB(160, 160, 160);
    border-color: RGB(192, 192, 192);
    text-decoration: line-through;
  }
}

.btn-close {
  padding: 0.9375rem;
}

.btn-close:focus {
  box-shadow: none;
}
</style>
