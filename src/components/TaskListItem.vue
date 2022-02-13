<template>
  <li :class="taskClass" @click="$emit('toggle-task-status', taskItem)">
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
      {{ taskItem.task }}. Создана -
      {{ (taskItem.creationDate * 1000) | date("datetime") }}. Выполнена -
      {{ (taskItem.completionDate * 1000) | date("datetime") }}
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
          this.taskItem.category && this.taskItem.category.color && !+this.taskItem.done
            ? this.taskItem.category.color
            : "#c0c0c0",
        borderColor:
          this.taskItem.category && this.taskItem.category.color && !+this.taskItem.done
            ? this.taskItem.category.color
            : "#c0c0c0",
      },
    };
  },

  computed: {
    taskClass: function () {
      let taskClass = "task mb-1";
      if (+this.taskItem.done) {
        taskClass += " taskCompleted bg-light";
      } else {
        taskClass += " bg-info";
      }
      return taskClass;
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
