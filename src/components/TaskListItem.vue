<template>
  <li :class="taskClass" @click="$emit('toggle-task-status', taskItem)">
    <TaskListItemButtonCategory
      v-if="taskItem.category && taskItem.category.id"
      :icon="taskItem.category.icon"
      :style="categoryButtonStyles"
      @filter-category="$emit('filter-category')"
    />
    <TaskListItemButtonDeleteTask
      icon="close"
      @delete-task="$emit('delete-task')"
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
  props: ["taskItem", "theme"],
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
    };
  },

  computed: {
    taskClass: function () {
      let taskClass = "task mb-1";
      if (+this.taskItem.done) {
        taskClass += " taskCompleted";
      } else {
        taskClass += " bg-" + this.theme.info;
      }
      return taskClass;
    },

    categoryButtonStyles: function () {
      const color =
        this.taskItem.category &&
        this.taskItem.category.color &&
        !+this.taskItem.done
          ? this.taskItem.category.color
          : "#c0c0c0";
      return { backgroundColor: color, borderColor: color };
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
