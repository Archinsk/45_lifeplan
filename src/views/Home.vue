<template>
  <div>
    <Header @lists-toggle="listsToggle" />
    <div class="container">
      <FormAddTask @add-new-task="$emit('add-new-task', $event)" />
      <div
        v-if="!isAppLoaded"
        class="spinner-border text-primary"
        role="status"
      >
        <span class="visually-hidden">Loading...</span>
      </div>
      <div v-else id="tasks">
        <TaskList
          :list-items="tasksDone"
          @toggle-task-status="$emit('toggle-task-status', $event)"
          @delete-task="$emit('delete-task', $event)"
          @filter-category="filterCategory($event)"
          id="tasksDone"
          :class="{ active: tasksDoneVisibility }"
        />
        <TaskList
          :list-items="tasksTodo"
          @toggle-task-status="$emit('toggle-task-status', $event)"
          @delete-task="$emit('delete-task', $event)"
          @filter-category="filterCategory($event)"
          id="tasksTodo"
        />
      </div>
      <button class="btn btn-danger">action</button>
    </div>
  </div>
</template>

<script>
import Header from "../components/Header";
import FormAddTask from "../components/FormAddTask";
import TaskList from "../components/TaskList";

export default {
  name: "Home",
  components: {
    Header,
    FormAddTask,
    TaskList,
  },
  props: ["isAppLoaded", "tasksDb", "categoriesDb"],
  data() {
    return {
      filteredTasks: [],
      tasksDoneVisibility: false,
    };
  },

  methods: {
    filterCategory(categoryId) {
      console.log("Фильтрация по категоии с id=", categoryId);
      if (this.filteredTasks.length === 0) {
        console.log("Добавление в массив фильтрации");
        this.filteredTasks = this.tasksDb.filter(
          (task) => task.category && task.category.id === categoryId
        );
        console.log(this.filteredTasks);
      } else {
        console.log("Очищаю массив фильтрации");
        this.filteredTasks = [];
      }
    },

    listsToggle() {
      this.tasksDoneVisibility = !this.tasksDoneVisibility;
      console.log(this.tasksDoneVisibility);
    },
  },

  computed: {
    tasksTodo: function () {
      const tasks =
        this.filteredTasks.length > 0 ? this.filteredTasks : this.tasksDb;
      let tasksWithIndexes = tasks.map(function (item, index) {
        item.index = index;
        return item;
      });
      let todo = tasksWithIndexes.filter((task) => !!+task.done === false);
      return todo;
    },
    tasksDone: function () {
      const tasks =
        this.filteredTasks.length > 0 ? this.filteredTasks : this.tasksDb;
      let tasksWithIndexes = tasks.map(function (item, index) {
        item.index = index;
        return item;
      });
      let done = tasksWithIndexes.filter((task) => !!+task.done === true);
      return done;
    },
  },
};
</script>
