<template>
  <form action="submit" class="sticky-top bg-light py-2 ">
    <div class="input-group">
      <input
        type="text"
        class="form-control border-secondary"
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
/*.form-control:focus {*/
/*  box-shadow: none;*/
/*}*/
</style>
