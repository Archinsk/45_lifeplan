<template>
  <button
    type="button"
    class="buttonIconSquare btn"
    @click.stop="$emit('click-handler')"
  >
    <span class="material-icons">{{ icon }}</span>
  </button>
</template>

<script>
export default {
  name: "ButtonIconSquare",
  props: ["icon"],
};
</script>
