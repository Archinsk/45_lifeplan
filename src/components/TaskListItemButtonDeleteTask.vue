<template>
  <ButtonIconSquare
    :icon="icon"
    class="delete-button"
    @click-handler="$emit('delete-task')"
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
