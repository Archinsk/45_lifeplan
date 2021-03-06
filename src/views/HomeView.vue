<template>
  <div>
    <TheHeader
      :theme="theme"
      :lightness-mode="lightnessMode"
      @lists-toggle="listsToggle"
    />
    <div class="container">
      <FormAddTask
        :theme="theme"
        :lightness-mode="lightnessMode"
        @add-new-task="$emit('add-new-task', $event)"
      />
      <div
        v-if="!isAppLoaded"
        class="spinner-border text-primary"
        role="status"
      >
        <span class="visually-hidden">Loading...</span>
      </div>
      <div v-else id="tasks">
        <TaskList
          :list-items="isFiltered ? tasksTodoFiltered : tasksTodo"
          :theme="theme"
          :lightness-mode="lightnessMode"
          @toggle-task-status="$emit('toggle-task-status', $event)"
          @delete-task="$emit('delete-task', $event)"
          @filter-category="filterCategory($event)"
          id="tasksTodo"
          :class="todoListClass"
        />
        <TaskList
          :list-items="isFiltered ? tasksDoneFiltered : tasksDone"
          :theme="theme"
          :lightness-mode="lightnessMode"
          @toggle-task-status="$emit('toggle-task-status', $event)"
          @delete-task="$emit('delete-task', $event)"
          @filter-category="filterCategory($event)"
          id="tasksDone"
          :class="doneListClass"
        />
      </div>
    </div>
  </div>
</template>

<script>
import TheHeader from "../components/TheHeader";
import FormAddTask from "../components/FormAddTask";
import TaskList from "../components/TaskList";

export default {
  name: "HomeView",
  components: {
    TheHeader,
    FormAddTask,
    TaskList,
  },
  props: ["isAppLoaded", "theme", "lightnessMode", "tasksDb", "categoriesDb"],
  data() {
    return {
      isFiltered: false,
      filteredCategoryId: "",
      doneListVisibility: false,
      todoListClass: "position-relative",
      doneListClass: "bg-secondary position-absolute",
      timeStamp: +new Date(),
    };
  },

  methods: {
    filterCategory(categoryId) {
      if (!this.isFiltered) {
        this.filteredCategoryId = categoryId;
      } else {
        this.filteredCategoryId = "";
      }
      this.isFiltered = !this.isFiltered;
    },

    listsToggle() {
      let delay = new Promise((resolve) => {
        setTimeout(() => {
          resolve();
        }, 500);
      });
      if (!this.doneListVisibility) {
        this.todoListClass = "position-absolute";
        this.doneListClass =
          "bg-" + this.theme.secondary + " position-relative active";
        this.doneListVisibility = true;
      } else {
        this.doneListClass =
          "bg-" + this.theme.secondary + " position-relative";
        delay.then(() => {
          this.todoListClass = "position-relative";
          this.doneListClass =
            "bg-" + this.theme.secondary + " position-absolute";
          this.doneListVisibility = false;
        });
      }
    },
  },

  computed: {
    timeStampWithTimezoneOffset: function () {
      return (
        this.timeStamp - new Date(this.timeStamp).getTimezoneOffset() * 60000
      );
    },

    startOfDayGMTinMs: function () {
      return (
        this.timeStampWithTimezoneOffset -
        (this.timeStampWithTimezoneOffset % 86400000)
      );
    },

    startOfDayLocalinMs: function () {
      return (
        this.startOfDayGMTinMs +
        new Date(this.timeStamp).getTimezoneOffset() * 60000
      );
    },

    tasksTodo: function () {
      const startOfDayLocalinMs = this.startOfDayLocalinMs;
      let todo = this.tasksDb.filter(function (task) {
        if (!+task.done) {
          return true;
        } else if (task.completionDate * 1000 > startOfDayLocalinMs) {
          return true;
        }
      });
      return todo;
    },

    tasksDone: function () {
      const startOfDayLocalinMs = this.startOfDayLocalinMs;
      let done = this.tasksDb.filter(function (task) {
        if (!!+task.done && task.completionDate * 1000 <= startOfDayLocalinMs) {
          return true;
        }
      });
      done = done.sort(function (a, b) {
        if (a.completionDate > b.completionDate) {
          return -1;
        }
        if (a.completionDate === b.completionDate) {
          return 0;
        }
        if (a.completionDate < b.completionDate) {
          return 1;
        }
      });
      return done;
    },

    tasksTodoFiltered: function () {
      if (this.isFiltered) {
        let todoFiltered = this.tasksTodo.filter(
          (task) =>
            task.category && task.category.id === this.filteredCategoryId
        );
        return todoFiltered;
      }
      return false;
    },

    tasksDoneFiltered: function () {
      if (this.isFiltered) {
        let doneFiltered = this.tasksDone.filter(
          (task) =>
            task.category && task.category.id === this.filteredCategoryId
        );
        return doneFiltered;
      }
      return false;
    },
  },

  mounted() {
    console.log("Home смонтирован");
  },
};
</script>
