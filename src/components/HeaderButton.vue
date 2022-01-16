<template>
  <ButtonIconSquare
    class="header-button btn"
    :icon="icon"
    :semantics="buttonSemantics"
    :class="buttonSemantics"
  />
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

export default {
  name: "MenuButton",
  data() {
    return {
      buttonSemantics: "menuButton",
    };
  },
  components: {
    ButtonIconSquare,
  },
  props: ["icon"],
};
</script>

<style scoped>
/*.menuButton {*/
/*  margin-left: 0.75rem;*/
/*  border-radius: 0.25rem;*/

/*}*/
</style>
