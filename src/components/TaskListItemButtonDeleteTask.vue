<template>
  <ButtonIconSquare
    :icon="icon"
    class="delete-button btn btn-danger text-secondary"
  />
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

export default {
  name: "TaskListItemButtonDeleteTask",
  components: {
    ButtonIconSquare,
  },
  props: ["icon"],
};
</script>

<style scoped>
/*.deleteButton {*/
/*  border-radius: 0 0.25rem 0.25rem 0;*/
/*  position: absolute;*/
/*  top: 0;*/
/*  right: 0;*/
/*}*/
</style>
