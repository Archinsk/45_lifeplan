<template>
  <form
    @submit.prevent
    action="submit"
    :class="'sticky-top py-2 bg-' + theme.secondary"
  >
    <div class="input-group">
      <input
        type="text"
        class="form-control"
        placeholder="Введите текст задачи..."
        aria-label="Введите текст задачи..."
        aria-describedby="button-addon2"
        @keyup.enter="addNewTask"
        v-model="addTaskInputValue"
      />
      <FormAddTaskButton
        :icon="iconName"
        :class="buttonSemantics"
        :theme="theme"
        @add-new-task="addNewTask"
      />
    </div>
  </form>
</template>

<script>
import FormAddTaskButton from "@/components/FormAddTaskButton";

export default {
  name: "FormAddTask",
  data() {
    return {
      iconName: "add",
      buttonSemantics: "input",
      addTaskInputValue: "",
    };
  },
  props: ["theme"],
  components: {
    FormAddTaskButton,
  },
  methods: {
    addNewTask() {
      this.$emit("add-new-task", this.addTaskInputValue);
      this.addTaskInputValue = "";
    },
  },
};
</script>
