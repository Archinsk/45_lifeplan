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
    <ContextMenuButton
      v-show="contextMenuVisibility"
      icon="close"
      @toggle-context-menu="$emit('open-modal-delete-category')"
      data-bs-toggle="modal"
      data-bs-target="#deleteCategoryModal"
    />
    <ContextMenuButton
      v-show="contextMenuVisibility"
      icon="mode"
      @toggle-context-menu="$emit('open-modal-edit-category')"
      data-bs-toggle="modal"
      data-bs-target="#editCategoryModal"
    />
    <div class="task-text">{{ category.name }}</div>
  </li>
</template>

<script>
import ButtonIconSquare from "@/components/universal/ButtonIconSquare";
import ContextMenuButton from "./ContextMenuButton";

export default {
  name: "CategoriesListItem",
  props: ["category", "theme", "lightnessMode"],
  components: {
    ButtonIconSquare,
    ContextMenuButton,
  },
  data() {
    return {
      contextMenuVisibility: false,
    };
  },

  computed: {
    categoryClass: function () {
      let categoryClass =
        "mb-1 border border-" +
        this.lightnessMode +
        "-neutral-500 text-" +
        this.lightnessMode +
        "-neutral-300";
      return categoryClass;
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
      let buttonClass = "context-menu-button text-dark-neutral-500 ";
      return buttonClass;
    },
  },

  methods: {
    toggleContextMenu() {
      this.contextMenuVisibility = !this.contextMenuVisibility;
    },
  },
};
</script>
