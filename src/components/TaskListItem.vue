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
        backgroundColor: this.taskItem.category.color,
        borderColor: this.taskItem.category.color
      }
    };
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
    // console.log(this.taskItem.done);
    // console.log(!!+this.taskItem.done);
  },
};
</script>
