<template>
  <li :class="'task border mb-1 border-secondary bg-' + theme.info">
    <ButtonIconSquare
      v-if="category.iconid"
      :icon="category.icon"
      :class="categoryButtonClass"
    />
    <ContextMenuButton
      icon="more_horiz"
      @toggle-context-menu="toggleContextMenu"
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
    categoryButtonClass: function () {
      let categoryClass = "";
      categoryClass =
        "category-button bg-" +
        this.lightnessMode +
        "-" +
        this.category.color +
        "-primary text-" +
        this.theme.info;
      return categoryClass;
    },
  },

  methods: {
    toggleContextMenu() {
      this.contextMenuVisibility = !this.contextMenuVisibility;
    },
  },
};
</script>
