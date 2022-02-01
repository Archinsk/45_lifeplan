<template>
  <ButtonIconSquare
    :icon="icon"
    class="context-menu-button btn text-secondary"
    @click-handler="$emit('toggle-context-menu')"
  />
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

export default {
  name: "ContextMenuButton",
  components: {
    ButtonIconSquare,
  },
  props: ["icon"],
};
</script>
