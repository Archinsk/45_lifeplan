<template>
  <li
    class="task bg-info border border-secondary mb-1"
    :class="{ taskCompleted: !!+taskItem.done }"
    @click="$emit('toggle-task-status', taskItem)"
  >
    <TaskListItemButtonCategory
      :icon="taskItem.icon"
      @filter-task="$emit('filter-category')"
    />
    <TaskListItemButtonDeleteTask
      icon="close"
      @delete-task="$emit('delete-task', taskItem.index)"
    />
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
  data() {
    return {
      deleteIndex: this.index,
    };
  },
  mounted: function () {
    // console.log(this.taskItem.done);
    // console.log(!!+this.taskItem.done);
  },
};
</script>
