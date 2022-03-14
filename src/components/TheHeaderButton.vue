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
  name: "TheHeaderButton",
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
