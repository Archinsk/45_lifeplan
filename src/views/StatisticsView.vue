<template>
  <div>
    <TheHeader :theme="theme" />
    <div class="container">
      <h4>Статистика</h4>
    </div>
  </div>
</template>

<script>
import TheHeader from "../components/TheHeader";

export default {
  name: "StatisticsView",
  components: {
    TheHeader,
  },
  props: ["theme"],
};
</script>

<style scoped></style>
