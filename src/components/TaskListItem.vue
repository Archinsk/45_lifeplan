<template>
  <li
    class="task bg-info border border-secondary mb-1"
    :class="{ taskCompleted: !!+taskItem.done }"
    @click="$emit('toggle-task-status', taskItem)"
  >
    <TaskListItemButtonCategory
      v-if="taskItem.category && taskItem.category.icon"
      :icon="taskItem.category.icon"
      :style="categoryButtonStyles"
      @filter-category="$emit('filter-category')"
    />
    <TaskListItemButtonDeleteTask
      icon="close"
      @delete-task="$emit('delete-task')"
    />
    <div class="task-text">
      {{ taskItem.task }} - {{ startDate | date("datetime") }} -
      {{ startOfDayLocal }} - {{ endOfDayLocal }} -
      {{ endOfDayLocal - startDate }}
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
      category: {
        color:
          this.taskItem.category && this.taskItem.category.color
            ? this.taskItem.category.color
            : "black",
        icon:
          this.taskItem.category && this.taskItem.category.icon
            ? this.taskItem.category.icon
            : "home",
      },
      categoryButtonStyles: {
        backgroundColor:
          this.taskItem.category && this.taskItem.category.color
            ? this.taskItem.category.color
            : "",
        borderColor:
          this.taskItem.category && this.taskItem.category.color
            ? this.taskItem.category.color
            : "",
      },
    };
  },

  computed: {
    startDate: function () {
      return new Date(this.taskItem.creationDate * 1000);
    },
    startOfDayGMT: function () {
      return +this.startDate - (this.startDate % 86400000);
    },
    startOfDayLocal: function () {
      return new Date(
        this.startOfDayGMT + this.startDate.getTimezoneOffset() * 60000
      );
    },
    endOfDayLocal: function () {
      return new Date(+this.startOfDayLocal + 86400000);
    },
  },

  // watch: {
  //   taskItem() {
  //     console.log("Наблюдаю")
  //     if (this.taskItem.category && this.taskItem.category.icon) {
  //       this.category.icon = this.taskItem.category.icon;
  //     }
  //   },
  // },
  mounted: function () {
    // console.log("Компонент TaskListItem смонтирован");
  },
};
</script>
