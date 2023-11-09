<template>
  <form
    @submit.prevent
    id="add-task-form"
    action="submit"
    :class="'sticky-top py-2 bg-' + theme.secondary"
  >
    <div class="input-group">
      <input
        type="text"
        :class="
          'form-control bg-' +
          lightnessMode +
          '-neutral-900 text-' +
          lightnessMode +
          '-neutral-300 border-' +
          lightnessMode +
          '-neutral-500'
        "
        placeholder="Введите текст задачи..."
        aria-label="Введите текст задачи..."
        aria-describedby="button-addon2"
        required
        @keyup.enter="addNewTask"
        v-model.trim="addTaskInputValue"
      />
      <div class="input-group-append">
        <vb-button
          type="submit"
          icon="add"
          square
          :class="
            'inputGroupButton btn btn-' +
            theme.primary +
            ' border-' +
            lightnessMode +
            '-neutral-500'
          "
          @click="addNewTask"
        />
      </div>
    </div>
  </form>
</template>

<script>
import VbButton from "./universal/Bootstrap_4.6.2/BS46Button";

export default {
  name: "FormAddTask",
  data() {
    return {
      iconName: "add",
      buttonSemantics: "input",
      addTaskInputValue: "",
    };
  },
  props: ["theme", "lightnessMode"],
  components: {
    VbButton,
  },
  methods: {
    addNewTask() {
      if (this.addTaskInputValue) {
        this.$emit("add-new-task", this.addTaskInputValue);
        this.addTaskInputValue = "";
      } else {
        let addTaskForm = document.getElementById("add-task-form");
        addTaskForm.submit();
      }
    },
  },
};
</script>
