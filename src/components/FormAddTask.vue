<template>
  <form
    @submit.prevent
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
        @keyup.enter="addNewTask"
        v-model="addTaskInputValue"
      />
      <ButtonIconSquare
        icon="add"
        :class="
          'inputGroupButton btn btn-' +
          theme.primary +
          ' border-' +
          lightnessMode +
          '-neutral-500'
        "
        @click-handler="addNewTask"
      />
    </div>
  </form>
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

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
    ButtonIconSquare,
  },
  methods: {
    addNewTask() {
      this.$emit("add-new-task", this.addTaskInputValue);
      this.addTaskInputValue = "";
    },
  },
};
</script>
