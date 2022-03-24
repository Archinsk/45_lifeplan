<template>
  <li :class="taskClass" @click="$emit('toggle-task-status', taskItem)">
    <TaskListItemButtonCategory
      v-if="taskItem.category && taskItem.category.id"
      :icon="taskItem.category.icon"
      :theme="theme"
      :lightness-mode="lightnessMode"
      :class="categoryButtonClass"
      @filter-category="$emit('filter-category')"
    />
    <TaskListItemButtonDeleteTask
      icon="close"
      :class="deleteButtonClass"
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
  props: ["taskItem", "theme", "lightnessMode"],
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
      let taskClass = "task mb-1 border";
      if (+this.taskItem.done) {
        taskClass +=
          " border-" +
          this.lightnessMode +
          "-neutral-700 text-" +
          this.lightnessMode +
          "-neutral-600 taskCompleted";
      } else {
        taskClass +=
          " border-" +
          this.lightnessMode +
          "-neutral-500 text-" +
          this.lightnessMode +
          "-neutral-300 bg-" +
          this.theme.info;
      }
      return taskClass;
    },

    categoryButtonClass: function () {
      let categoryClass = "";
      if (+this.taskItem.done) {
        categoryClass =
          "bg-" +
          this.lightnessMode +
          "-neutral-700 text-" +
          this.theme.secondary;
      } else {
        categoryClass =
          "bg-" +
          this.lightnessMode +
          "-" +
          this.taskItem.category.name +
          "-primary text-" +
          this.theme.info;
      }
      return categoryClass;
    },

    deleteButtonClass: function () {
      let deleteClass = "";
      if (+this.taskItem.done) {
        deleteClass = "text-" + this.lightnessMode + "-neutral-700";
      } else {
        deleteClass = "text-" + this.lightnessMode + "-neutral-500";
      }
      return deleteClass;
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
