<template>
  <form
    id="add-task-form"
    :class="'sticky-top py-2 bg-' + theme.secondary"
    @submit.prevent
  >
    <div class="input-group">
      <input
        id="add-task-input"
        name="add-task-input"
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
        @keyup.enter.prevent="addNewTask"
        v-model.trim="addTaskInputValue"
      />
      <div class="input-group-append">
        <vb-button
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
      let addTaskInput = document.getElementById("add-task-input");
      if (this.addTaskInputValue) {
        this.$emit("add-new-task", this.addTaskInputValue);
        this.addTaskInputValue = "";
        addTaskInput.setCustomValidity("");
      } else {
        addTaskInput.setCustomValidity("Нужно ввести текст");
        addTaskInput.reportValidity();
      }
    },
  },
};
</script>
