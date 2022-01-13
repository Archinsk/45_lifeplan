<template>
  <div class="container">
    <h6>Цветовая схема</h6>
    <div class="row row-cols-6 g-0">
      <div class="bg-primary text-white border border-secondary p-2">Header, main buttons - $primary: #60c060;</div>
      <div class="bg-light border border-secondary p-2">Background - $info: #f0ffe0;</div>
      <div class="bg-info border border-secondary p-2">Tasks - $light: #e4f4e0;</div>
      <div class="bg-secondary text-white border border-secondary p-2">
        Borders - $secondary: #808080;
      </div>
      <div
        class="border text-white border-secondary p-2"
        style="background-color: #505050"
      >
        Text (dark) - $secondary: #505050;
      </div>
      <div
        class="border bg-white border-secondary p-2"
        style="background-color: #505050"
      >
        Text (light) - $white: #FFFFFF;
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ColorScheme",
};
</script>
