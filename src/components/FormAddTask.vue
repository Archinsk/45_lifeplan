<template>
  <div class="input-group my-2">
    <input
      type="text"
      class="form-control"
      placeholder="Введите текст задачи..."
      aria-label="Введите текст задачи..."
      aria-describedby="button-addon2"
      v-model="addTaskInputValue"
    />
    <FormAddTaskButton
      :icon="iconName"
      :class="buttonSemantics"
      @addNewTask="addNewTask"
    />
  </div>
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
  props: [],
  components: {
    FormAddTaskButton,
  },
  methods: {
    addNewTask() {
      this.$emit("addNewTask", this.addTaskInputValue);
      this.addTaskInputValue = "";
    },
  },
};
</script>

<style scoped>
.form-control {
  border-color: RGB(128, 128, 128);
}
.form-control:focus {
  box-shadow: none;
}
</style>
