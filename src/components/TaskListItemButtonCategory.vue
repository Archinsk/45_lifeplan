<template>
  <ButtonIconSquare
    :icon="icon"
    class="category-button btn btn-primary text-light"
    @click-handler="$emit('filter-category')"
  />
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

export default {
  name: "TaskListItemButtonCategory",
  components: {
    ButtonIconSquare,
  },
  props: ["icon"],
};
</script>
