<template>
  <ul class="taskList">
    <TaskListItem
      v-for="item of listItems"
      :key="item.category && item.category.id ? item.id + '-' + item.category.id : item.id"
      :task-item="item"
      @toggle-task-status="$emit('toggle-task-status', $event)"
      @filter-task="$emit('filter-category')"
      @delete-task="$emit('delete-task', $event)"
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
  updated() {
    console.log("Список обновлен");
    console.log("Лист при обловлении компонента");
    console.log(this.listItems);
  },
  mounted() {
    console.log("Смонтирован список");
    console.log("Лист при монтировании компонента");
    console.log(this.listItems);
  },
};
</script>
