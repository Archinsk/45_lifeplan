<template>
  <div>
    <TheHeader :theme="theme" />
    <div class="container">
      <h4>Категории</h4>
      <div
        v-if="!isAppLoaded"
        class="spinner-border text-primary"
        role="status"
      >
        <span class="visually-hidden">Loading...</span>
      </div>
      <template v-else>
        <CategoriesList
          :list-items="categoriesDb"
          :theme="theme"
          :lightness-mode="lightnessMode"
          @open-modal-edit-category="openModalEditCategory($event)"
          @open-modal-delete-category="openModalDeleteCategory($event)"
        />
        <button
          :class="'btn btn-' + theme.primary"
          data-bs-toggle="modal"
          data-bs-target="#createCategoryModal"
          @click="openModalCreateCategory"
        >
          Создать категорию
        </button>

        <CategoriesModal
          id="createCategoryModal"
          refModal="createCategoryModal"
          title="Создание категории"
          ok-button-title="Создать"
          :ok-disabled="!isValidNewCategory"
          :theme="theme"
          :lightness-mode="lightnessMode"
          @ok-action="createCategory"
        >
          Пример
          <CategoriesListItem
            :category="newCategory"
            :theme="theme"
            :lightness-mode="lightnessMode"
          />
          <div class="mb-3">
            <label for="selectedCategoryName" class="form-label"
              >Название</label
            >
            <input
              type="text"
              :class="
                'form-control bg-' +
                lightnessMode +
                '-neutral-900 text-' +
                lightnessMode +
                '-neutral-300 border-' +
                lightnessMode +
                '-neutral-500'
              "
              id="selectedCategoryName"
              placeholder="Введите название категории"
              v-model.trim="newCategory.name"
            />
          </div>
          <nav
            :class="
              'nav nav-tabs border-' +
              lightnessMode +
              '-neutral-500 border-bottom'
            "
            id="create-category-tab"
            role="tablist"
          >
            <button
              :class="
                'nav-link active bg-' +
                theme.secondary +
                ' border-' +
                lightnessMode +
                '-neutral-500 border-bottom-0'
              "
              id="pills-home-tab-2"
              data-bs-toggle="pill"
              data-bs-target="#pills-create-category-icons"
              type="button"
              role="tab"
              aria-controls="pills-home"
              aria-selected="true"
            >
              Иконка
            </button>
            <button
              :class="
                'nav-link bg-' +
                theme.secondary +
                ' border-' +
                lightnessMode +
                '-neutral-500 border-bottom-0'
              "
              id="pills-profile-tab-2"
              data-bs-toggle="pill"
              data-bs-target="#pills-create-category-colors"
              type="button"
              role="tab"
              aria-controls="pills-profile"
              aria-selected="false"
            >
              Цвет
            </button>
          </nav>
          <div
            :class="
              'tab-content border border-' +
              lightnessMode +
              '-neutral-500 border-top-0 p-2 mb-3'
            "
            id="pills-tabContent-2"
          >
            <div
              class="tab-pane fade show active"
              id="pills-create-category-icons"
              role="tabpanel"
              aria-labelledby="pills-create-category-icons-tab"
            >
              <IconsList
                :list-items="iconsDb"
                :theme="theme"
                :lightness-mode="lightnessMode"
                @change-icon-selected-category="changeIconNewCategory($event)"
              />
            </div>
            <div
              class="tab-pane fade"
              id="pills-create-category-colors"
              role="tabpanel"
              aria-labelledby="pills-create-category-colors-tab"
            >
              <ColorsList
                :list-items="colorsDb"
                :selected-category-icon="newCategory.icon"
                :theme="theme"
                :lightness-mode="lightnessMode"
                @change-color-selected-category="changeColorNewCategory($event)"
              />
            </div>
          </div>
          <div class="form-check">
            <input
              v-model="searchCategoryInExistingTasks"
              class="form-check-input"
              type="checkbox"
              value=""
              id="searchCategoryInExistingTasks"
            />
            <label class="form-check-label" for="searchCategoryInExistingTasks">
              Искать и присваивать создаваемую категорию ранее созданным
              заданиям (поиск по началу строки)
            </label>
          </div>
        </CategoriesModal>

        <CategoriesModal
          id="editCategoryModal"
          refModal="editCategoryModal"
          title="Редактирование категории"
          ok-button-title="Изменить"
          :ok-disabled="!isValidEditableCategory"
          :theme="theme"
          :lightness-mode="lightnessMode"
          @ok-action="editCategory"
        >
          <p>Пример</p>
          <CategoriesListItem
            :category="selectedCategory"
            :key="selectedCategory.id ? selectedCategory.id : 'default'"
            :theme="theme"
            :lightness-mode="lightnessMode"
          />
          <div class="mb-3">
            <label for="newCategoryName" class="form-label">Название</label>
            <input
              type="text"
              :class="
                'form-control bg-' +
                lightnessMode +
                '-neutral-900 text-' +
                lightnessMode +
                '-neutral-300 border-' +
                lightnessMode +
                '-neutral-500'
              "
              id="newCategoryName"
              placeholder="Введите название категории"
              v-model.trim="selectedCategory.name"
            />
          </div>

          <nav
            :class="
              'nav nav-tabs border-' +
              lightnessMode +
              '-neutral-500 border-bottom'
            "
            id="pills-tab"
            role="tablist"
          >
            <button
              :class="
                'nav-link active bg-' +
                theme.secondary +
                ' border-' +
                lightnessMode +
                '-neutral-500 border-bottom-0'
              "
              id="pills-home-tab"
              data-bs-toggle="pill"
              data-bs-target="#pills-home"
              type="button"
              role="tab"
              aria-controls="pills-home"
              aria-selected="true"
            >
              Иконка
            </button>
            <button
              :class="
                'nav-link bg-' +
                theme.secondary +
                ' border-' +
                lightnessMode +
                '-neutral-500 border-bottom-0'
              "
              id="pills-profile-tab"
              data-bs-toggle="pill"
              data-bs-target="#pills-profile"
              type="button"
              role="tab"
              aria-controls="pills-profile"
              aria-selected="false"
            >
              Цвет
            </button>
          </nav>
          <div
            :class="
              'tab-content border border-' +
              lightnessMode +
              '-neutral-500 border-top-0 p-2'
            "
            id="pills-tabContent"
          >
            <div
              class="tab-pane fade show active"
              id="pills-home"
              role="tabpanel"
              aria-labelledby="pills-home-tab"
            >
              <IconsList
                :theme="theme"
                :lightness-mode="lightnessMode"
                :list-items="iconsDb"
                :selected-category-color="selectedCategory.color"
                @change-icon-selected-category="
                  changeIconSelectedCategory($event)
                "
              />
            </div>
            <div
              class="tab-pane fade"
              id="pills-profile"
              role="tabpanel"
              aria-labelledby="pills-profile-tab"
            >
              <ColorsList
                :theme="theme"
                :lightness-mode="lightnessMode"
                :list-items="colorsDb"
                :selected-category-icon="selectedCategory.icon"
                @change-color-selected-category="
                  changeColorSelectedCategory($event)
                "
              />
            </div>
          </div>
        </CategoriesModal>

        <CategoriesModal
          id="deleteCategoryModal"
          refModal="deleteCategoryModal"
          title="Удаление категории"
          ok-button-title="Удалить"
          :theme="theme"
          :lightness-mode="lightnessMode"
          @ok-action="deleteCategory"
        >
          <p>
            {{
              'Вы действительно хотите удалить категорию "' +
              selectedCategory.name +
              '" ?'
            }}
          </p>
          <CategoriesListItem
            :category="selectedCategory"
            :theme="theme"
            :lightness-mode="lightnessMode"
          />
        </CategoriesModal>
      </template>
    </div>
  </div>
</template>

<script>
// import axios from "axios";
import TheHeader from "../components/TheHeader";
import CategoriesList from "../components/CategoriesList";
import ColorsList from "../components/ColorsList";
import CategoriesModal from "../components/CategoriesModal";
import IconsList from "../components/IconsList";
import CategoriesListItem from "../components/CategoriesListItem";
import { Modal } from "bootstrap";

export default {
  name: "CategoriesView",

  components: {
    CategoriesListItem,
    IconsList,
    CategoriesList,
    ColorsList,
    TheHeader,
    CategoriesModal,
  },

  props: [
    "isAppLoaded",
    "theme",
    "lightnessMode",
    "categoriesDb",
    "iconsDb",
    "colorsDb",
  ],

  data() {
    return {
      defaultCategory: {
        color: "neutral-600",
        colorid: "",
        icon: "help",
        iconid: "",
        id: "",
        name: "",
      },
      newCategory: {
        color: "neutral-600",
        colorid: "",
        icon: "help",
        iconid: "",
        id: "",
        name: "",
      },
      selectedCategory: {
        color: "",
        colorid: "",
        icon: "home",
        iconid: "",
        id: "",
        name: "",
      },
      createCategoryModal: null,
      editCategoryModal: null,
      deleteCategoryModal: null,
      modalEditCategoryVisibilities: true,
      modalDeleteCategoryVisibilities: true,
      searchCategoryInExistingTasks: false,
    };
  },

  methods: {
    openModalCreateCategory() {
      this.newCategory = Object.assign({}, this.defaultCategory);
    },

    openModalEditCategory(category) {
      this.selectedCategory = Object.assign({}, category);
    },

    openModalDeleteCategory(category) {
      this.selectedCategory = Object.assign({}, category);
    },

    changeIconSelectedCategory(icon) {
      this.selectedCategory.icon = icon.icon;
      this.selectedCategory.iconid = icon.id;
      console.log(icon);
    },

    changeColorSelectedCategory(color) {
      this.selectedCategory.color = color.name;
      this.selectedCategory.colorid = color.id;
      console.log(color);
    },

    changeIconNewCategory(icon) {
      this.newCategory.icon = icon.icon;
      this.newCategory.iconid = icon.id;
      console.log(icon);
    },

    changeColorNewCategory(color) {
      this.newCategory.color = color.name;
      this.newCategory.colorid = color.id;
      console.log(color);
    },

    createCategory() {
      this.createCategoryModal.hide();
      if (this.searchCategoryInExistingTasks) {
        this.newCategory.search = true;
      }
      this.$emit("create-category", this.newCategory);
      this.newCategory = {
        color: "grey",
        colorid: "",
        icon: "help",
        iconid: "",
        id: "",
        name: "",
      };
    },

    editCategory() {
      this.editCategoryModal.hide();
      this.$emit("edit-category", this.selectedCategory);
    },

    deleteCategory() {
      this.deleteCategoryModal.hide();
      this.$emit("delete-category", this.selectedCategory);
    },
    resetNewCategory() {},
  },

  computed: {
    selectedCategoryBeforeChange: function () {
      const selectedCategory = this.selectedCategory;
      return this.categoriesDb.find(
        (category) => category.id === selectedCategory.id
      );
    },

    isValidNewCategory: function () {
      return (
        this.newCategory.name &&
        this.newCategory.iconid &&
        this.newCategory.colorid
      );
    },

    isValidEditableCategory: function () {
      if (!this.selectedCategoryBeforeChange) {
        return false;
      }
      if (this.selectedCategory.id) {
        return (
          this.selectedCategory.name !==
            this.selectedCategoryBeforeChange.name ||
          this.selectedCategory.iconid !==
            this.selectedCategoryBeforeChange.iconid ||
          this.selectedCategory.colorid !==
            this.selectedCategoryBeforeChange.colorid
        );
      }
      return false;
    },
  },

  updated() {
    if (!this.createCategoryModal) {
      this.createCategoryModal = new Modal(
        this.$children[2].$refs.createCategoryModal
      );
    }
    if (!this.editCategoryModal) {
      this.editCategoryModal = new Modal(
        this.$children[3].$refs.editCategoryModal
      );
    }
    if (!this.deleteCategoryModal) {
      this.deleteCategoryModal = new Modal(
        this.$children[4].$refs.deleteCategoryModal
      );
    }
  },

  mounted() {},
};
</script>

<style scoped></style>
