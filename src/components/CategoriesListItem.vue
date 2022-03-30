<template>
  <li :class="categoryClass">
    <ButtonIconSquare
      v-if="category.iconid"
      :icon="category.icon"
      :class="categoryButtonClass"
    />
    <ButtonIconSquare
      icon="more_horiz"
      :class="contextMenuButtonClass"
      @click-handler="toggleContextMenu"
    />
    <ButtonIconSquare
      v-show="contextMenuVisibility"
      data-bs-toggle="modal"
      data-bs-target="#deleteCategoryModal"
      icon="close"
      :class="contextMenuButtonClass"
      @click-handler="$emit('open-modal-delete-category')"
    />
    <ButtonIconSquare
      v-show="contextMenuVisibility"
      data-bs-toggle="modal"
      data-bs-target="#editCategoryModal"
      icon="mode"
      :class="contextMenuButtonClass"
      @click-handler="$emit('open-modal-edit-category')"
    />
    <div class="task-text">{{ category.name }}</div>
  </li>
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";

export default {
  name: "CategoriesListItem",
  props: ["category", "theme", "lightnessMode"],
  components: {
    ButtonIconSquare,
  },
  data() {
    return {
      contextMenuVisibility: false,
    };
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

  methods: {
    toggleContextMenu() {
      this.contextMenuVisibility = !this.contextMenuVisibility;
    },
  },
};
</script>
