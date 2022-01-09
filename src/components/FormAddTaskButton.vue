<template>
  <ButtonIconSquare
    :icon="icon"
    :class="buttonSemantics"
    @clickHandler="$emit('addNewTask')"
  />
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

export default {
  name: "FormAddTaskButton",
  data() {
    return {
      buttonSemantics: "inputGroupButton",
    };
  },
  components: {
    ButtonIconSquare,
  },
  props: ["icon"],
  methods: {
    formHandler() {
      this.$emit("add-task-form");
    },
  },
};
</script>

<style scoped>
.inputGroupButton {
  background-color: RGB(96, 192, 96);
  color: white;
  border: 1px solid RGB(128, 128, 128);
  border-radius: 0 0.25rem 0.25rem 0;
}
</style>
