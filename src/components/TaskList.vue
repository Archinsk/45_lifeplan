<template>
  <ul class="taskList bg-light">
    <TaskListItem
      v-for="item of listItems"
      :key="
        item.category && item.category.id
          ? item.id + '-' + item.category.id
          : item.id
      "
      :task-item="item"
      @toggle-task-status="$emit('toggle-task-status', $event)"
      @filter-category="$emit('filter-category', item.category.id)"
      @delete-task="$emit('delete-task', item.id)"
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
    console.log("Лист при обновлении компонента");
    console.log(this.listItems);
  },
  mounted() {
    console.log("Компонент TaskList смонтирован");
  },
};
</script>
