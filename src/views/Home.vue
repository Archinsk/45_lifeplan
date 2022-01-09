<template>
  <div>
    <Header />
    <div class="container">
      <FormAddTask @addNewTask="addNewTask($event)" />
      <TaskList :listItems="items" @toggleComplete="changeCompleted($event)" />
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
    TaskList,
    Header,
    FormAddTask,
  },
  data() {
    return {
      items: [
        { id: 1, task: "Построить дом", completed: false, icon: "stars" },
        { id: 2, task: "Посадить дерево", completed: true, icon: "favorite" },
        { id: 3, task: "Вырастить сына", completed: false, icon: "home" },
      ],
    };
  },
  methods: {
    addNewTask(event) {
      let newTask = {
        id: this.items.length + 1,
        task: event,
        completed: false,
        icon: "home",
      };
      this.items.push(newTask);
    },
    changeCompleted(id) {
      this.items = this.items.map(function (item) {
        if ((item.id === id)) {
          item.completed = !item.completed;
        }
        return item;
      });
    },
  },
};
</script>

<style>
body {
  background-color: RGB(228, 244, 224);
}
</style>
