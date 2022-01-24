<template>
  <ButtonIconSquare
    :icon="icon"
    :class="buttonSemantics"
    class="category-button btn btn-primary text-light"
    @click="$emit('filter-category')"
  />
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

export default {
  name: "TaskListItemButtonCategory",
  data() {
    return {
      buttonSemantics: "categoryButton",
    };
  },
  components: {
    ButtonIconSquare,
  },
  props: ["icon"],
};
</script>

<style scoped>
/*.categoryButton {*/
/*  margin-right: 0.75rem;*/
/*  border-radius: 0.1875rem;*/
/*  background-color: deepskyblue;*/
/*  color: RGB(240, 255, 224);*/
/*}*/
</style>
