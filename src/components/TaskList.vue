<template>
  <ul class="taskList">
    <TaskListItem
      v-for="item of listItems"
      :key="item.id"
      :taskItem="item"
      @toggle-task-status="$emit('toggle-task-status', $event)"
    />
  </ul>
</template>

<script>
import TaskListItem from "@/components/TaskListItem";

export default {
  name: "TaskList",
  props: ["listItems"],
  components: {
    TaskListItem,
  },
};
</script>
