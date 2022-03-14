<template>
  <ButtonIconSquare
    :icon="icon"
    :class="'inputGroupButton btn btn-' + theme.primary"
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
  props: ["icon", "theme"],
  methods: {
    formHandler() {
      this.$emit("add-task-form");
    },
  },
};
</script>
