<template>
  <ul class="taskList">
    <TaskListItem
      v-for="item of listItems"
      :key="item.id"
      :taskItem="item"
      @toggleComplete="$emit('toggleComplete', $event)"
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

<style scoped>
.taskList {
  list-style: none;
  padding-left: 0;
}
</style>
