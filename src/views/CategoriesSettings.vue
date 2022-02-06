<template>
  <div>
    <Header />
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
          @open-modal-edit-category="openModalEditCategory($event)"
          @open-modal-delete-category="openModalDeleteCategory($event)"
        />
        <button
          class="btn btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#create-category"
        >
          Создать категорию
        </button>

        <CategoriesModal
          id="create-category"
          title="Создание категории"
          ok-button-title="Создать"
          :ok-disabled="!isValidNewCategory"
          @ok-action="$emit('create-category', newCategory)"
        >
          Пример
          <CategoriesListItem :category="newCategory" />
          <div class="mb-3">
            <label for="selectedCategoryName" class="form-label"
              >Название</label
            >
            <input
              type="text"
              class="form-control"
              id="selectedCategoryName"
              placeholder="Введите название категории"
              v-model.trim="newCategory.name"
            />
          </div>
          <ul
            class="nav nav-pills mb-3"
            id="create-category-tab"
            role="tablist"
          >
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
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
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
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
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent-2">
            <div
              class="tab-pane fade show active"
              id="pills-create-category-icons"
              role="tabpanel"
              aria-labelledby="pills-create-category-icons-tab"
            >
              <h4>Иконки</h4>
              <IconsList
                :list-items="iconsDb"
                :selected-category-color="newCategory.color"
                @change-icon-selected-category="changeIconNewCategory($event)"
              />
            </div>
            <div
              class="tab-pane fade"
              id="pills-create-category-colors"
              role="tabpanel"
              aria-labelledby="pills-create-category-colors-tab"
            >
              <h4>Цвета</h4>
              <ColorsList
                :list-items="colorsDb"
                :selected-category-icon="newCategory.icon"
                @change-color-selected-category="changeColorNewCategory($event)"
              />
            </div>
          </div>
        </CategoriesModal>

        <CategoriesModal
          id="edit-category"
          title="Редактирование категории"
          ok-button-title="Изменить"
          :ok-disabled="!isValidEditableCategory"
          @ok-action="$emit('edit-category', selectedCategory)"
        >
          <p>Пример</p>
          <CategoriesListItem
            :category="selectedCategory"
            :key="selectedCategory.id ? selectedCategory.id : 'default'"
          />
          <div class="mb-3">
            <label for="newCategoryName" class="form-label">Название</label>
            <input
              type="text"
              class="form-control"
              id="newCategoryName"
              placeholder="Введите название категории"
              v-model.trim="selectedCategory.name"
            />
          </div>

          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
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
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
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
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div
              class="tab-pane fade show active"
              id="pills-home"
              role="tabpanel"
              aria-labelledby="pills-home-tab"
            >
              <h4>Иконки</h4>
              <IconsList
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
              <h4>Цвета</h4>
              <ColorsList
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
          id="delete-category"
          title="Удаление категории"
          ok-button-title="Удалить"
          @ok-action="$emit('delete-category', selectedCategory)"
        >
          <p>
            {{
              'Вы действительно хотите удалить категорию "' +
              selectedCategory.name +
              '" ?'
            }}
          </p>
          <CategoriesListItem :category="selectedCategory" />
        </CategoriesModal>
      </template>
    </div>
  </div>
</template>

<script>
// import axios from "axios";
import Header from "../components/Header";
import CategoriesList from "../components/CategoriesList";
import ColorsList from "../components/ColorsList";
import CategoriesModal from "../components/CategoriesModal";
import IconsList from "../components/IconsList";
import CategoriesListItem from "../components/CategoriesListItem";

export default {
  name: "CategoriesSettings",

  components: {
    CategoriesListItem,
    IconsList,
    CategoriesList,
    ColorsList,
    Header,
    CategoriesModal,
  },

  props: ["isAppLoaded", "categoriesDb", "iconsDb", "colorsDb"],

  data() {
    return {
      defaultCategory: {
        color: "grey",
        colorid: "",
        icon: "help",
        iconid: "",
        id: "",
        name: "",
      },
      newCategory: {
        color: "grey",
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
      modalEditCategoryVisibilities: true,
      modalDeleteCategoryVisibilities: true,
    };
  },

  methods: {
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
      this.selectedCategory.color = color.hex_color;
      this.selectedCategory.colorid = color.id;
      console.log(color);
    },

    changeIconNewCategory(icon) {
      this.newCategory.icon = icon.icon;
      this.newCategory.iconid = icon.id;
      console.log(icon);
    },

    changeColorNewCategory(color) {
      this.newCategory.color = color.hex_color;
      this.newCategory.colorid = color.id;
      console.log(color);
    },
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

  mounted() {
    console.log("Компонент CategoriesSetting смонтирован");
  },
};
</script>

<style scoped></style>
