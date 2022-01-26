<template>
  <li
    class="task bg-info border border-secondary mb-1"
    :class="{ taskCompleted: !!+taskItem.done }"
    @click="$emit('toggle-task-status', taskItem)"
  >
    <TaskListItemButtonCategory
      v-if="this.taskItem.category && this.taskItem.category.icon"
      :icon="category.icon"
      :style="{ backgroundColor: category.color }"
      @filter-task="$emit('filter-category')"
    />
    <!--    @delete-task="$emit('delete-task', taskItem.index)"-->
    <TaskListItemButtonDeleteTask icon="close" />
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
      // deleteIndex: this.index,
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
