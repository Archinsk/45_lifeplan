<template>
  <ButtonIconSquare
    :icon="icon"
    :class="
      'inputGroupButton btn btn-' +
      theme.primary +
      ' border-' +
      lightnessMode +
      '-neutral-500'
    "
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
  props: ["icon", "theme", "lightnessMode"],
  methods: {
    formHandler() {
      this.$emit("add-task-form");
    },
  },
};
</script>
