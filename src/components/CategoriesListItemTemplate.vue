<template>
  <li :class="categoryClass">
    <vb-button
      v-if="category.iconid"
      :icon="category.icon"
      square
      :class="categoryButtonClass"
    />
    <vb-button icon="more_horiz" square :class="contextMenuButtonClass" />
    <div class="task-text">{{ category.name }}</div>
  </li>
</template>

<script>
import VbButton from "./universal/bs4-based/BS46Button";

export default {
  name: "CategoriesListItemTemplate",
  props: ["category", "theme", "lightnessMode"],
  components: {
    VbButton,
  },

  computed: {
    categoryClass: function () {
      return (
        "mb-1 border border-" +
        this.lightnessMode +
        "-neutral-500 text-" +
        this.lightnessMode +
        "-neutral-300 bg-" +
        this.theme.info
      );
    },
    categoryButtonClass: function () {
      let categoryClass =
        "category-button btn-" + this.lightnessMode + "-" + this.category.color;
      if (this.category.colorid) {
        categoryClass += "-primary";
      }
      categoryClass += " text-" + this.theme.info;
      return categoryClass;
    },
    contextMenuButtonClass: function () {
      return "context-menu-button text-" + this.lightnessMode + "-neutral-500 ";
    },
  },
};
</script>
