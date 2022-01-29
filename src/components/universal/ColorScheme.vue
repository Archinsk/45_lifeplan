<template>
  <div class="container">
    <h6>Цветовая схема</h6>
    <div class="row row-cols-4 g-0">
      <div class="bg-primary text-white border border-secondary p-2">
        Хедер, основные кнопки - rgb(96, 192, 96) hex#60c060 hsl(120, 43%, 56%)
        hwb(120, 38%, 25%) - $primary
      </div>
      <div class="bg-light border border-secondary p-2">
        Фон списков, фон выполненных заданий - rgb(228, 244, 224) hex#e4f4e0
        hsl(108, 48%, 92%) hwb(108, 88%, 4%) - $info
      </div>
      <div class="bg-info border border-secondary p-2">
        Фон невыполненных заданий - rgb(240, 255, 224) hex#f0ffe0 hsl(89, 100%,
        94%) hwb(89, 88%, 0%) - $light
      </div>
      <div class="bg-white border border-secondary p-2">
        Лого, текст основных кнопок - rgb(255, 255, 255) hex#ffffff hsl(0, 0%,
        100%) hwb(0, 100%, 0%) - $white
      </div>
      <div
        class="border border-secondary p-2"
        style="background-color: #c0c0c0"
      >
        Фон, контуры, текст кнопок выполненного задания - rgb(192, 192, 192)
        hex#c0c0c0 hsl(0, 0%, 75%) hwb(0, 75%, 25%)
      </div>
      <div
        class="border border-secondary p-2"
        style="background-color: #a0a0a0"
      >
        Текст выполненного задания - rgb(160, 160, 160) hex#a0a0a0 hsl(0, 0%,
        63%) hwb(0, 63%, 37%);
      </div>
      <div
        class="border text-white border-secondary p-2"
        style="background-color: #808080"
      >
        Фон, контуры, текст кнопок невыполненного задания - rgb(128, 128, 128)
        hex#808080 hsl(0, 0%, 50%) hwb(0, 50%, 50%) - $white
      </div>
      <div
        class="border text-white border-secondary p-2"
        style="background-color: #505050"
      >
        Текст выполненного задания - rgb(80, 80, 80) hex#505050 hsl(0, 0%, 31%)
        hwb(0, 31%, 69%)
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ColorScheme",
};
</script>
