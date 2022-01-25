<template>
  <ButtonIconSquare
    :icon="icon"
    class="inputGroupButton btn btn-primary border-secondary"
    @click-handler="$emit('add-new-task')"
  />
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

export default {
  name: "FormAddTaskButton",
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
/*.inputGroupButton {*/
/*  background-color: RGB(96, 192, 96);*/
/*  color: white;*/
/*  border: 1px solid RGB(128, 128, 128);*/
/*  border-radius: 0 0.25rem 0.25rem 0;*/
/*}*/
</style>
