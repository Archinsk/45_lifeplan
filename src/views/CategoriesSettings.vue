<template>
  <div>
    <Header />
    <div class="container">
      <h4>Категории</h4>
      <CategoriesList
        :list-items="categories"
        @open-modal-edit-category="openModalEditCategory"
        @open-modal-delete-category="openModalDeleteCategory"
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
        @ok-action="createCategory"
      >
        Пример
        <CategoriesListItem :category="newCategory" />
        <div class="mb-3">
          <label for="selectedCategoryName" class="form-label">Название</label>
          <input
            type="text"
            class="form-control"
            id="selectedCategoryName"
            placeholder="Введите название категории"
            v-model.trim="newCategory.name"
          />
        </div>
        <ul class="nav nav-pills mb-3" id="create-category-tab" role="tablist">
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
              :list-items="icons"
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
              :list-items="colors"
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
        @ok-action="editCategory"
      >
        <p>Пример</p>
        <CategoriesListItem :category="selectedCategory" />
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
              :list-items="icons"
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
              :list-items="colors"
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
        @ok-action="deleteCategory"
      >
        <p>{{ 'Вы действительно хотите удалить категорию "' + selectedCategory.name + '" ?'}}</p>
        <CategoriesListItem :category="selectedCategory" />
      </CategoriesModal>
    </div>
  </div>
</template>

<script>
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

  data() {
    return {
      url: "https://www.d-skills.ru/45_lifeplan/php/",
      loggedUser: {
        id: 42,
        name: "test",
      },
      categories: [
        {
          color: "",
          colorid: "",
          icon: "",
          iconid: "",
          id: "",
          name: "",
        },
      ],
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
        icon: "",
        iconid: "",
        id: "",
        name: "",
      },
      icons: [
        {
          icon: "",
          id: "",
          name: "",
          rating: "",
          type: "",
        },
      ],
      colors: [
        {
          hex_color: "",
          id: "",
          name: "",
        },
      ],
      // newIcons: [
      //   {
      //     name: "Home",
      //     icon: "home",
      //     type: "material-icons",
      //     rating: 5,
      //   },
      //   {
      //     name: "Settings",
      //     icon: "settings",
      //     type: "material-icons",
      //     rating: 1,
      //   },
      // ],
      // newColors: [
      //   {
      //     name: "Anything",
      //     hex_color: "#60C060",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#60C090",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#60C0C0",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#6090C0",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#6060C0",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#9060C0",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#C060C0",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#C06090",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#C06060",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#C09060",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#C0C060",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#90C060",
      //   },
      // ],
      // newCategory: {
      //   name: "Test Category",
      //   user_id: "666",
      //   icon_id: "",
      //   color_id: "13",
      //   rating: 2,
      // },
      modalEditCategoryVisibilities: true,
      modalDeleteCategoryVisibilities: true,
    };
  },

  methods: {
    async postAjaxRequest(url, request, callback = this.doNothing) {
      const xhr = new XMLHttpRequest();
      // console.log(request);
      xhr.open("POST", url, true);
      xhr.responseType = "json";
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
          callback(xhr.response);
        }
      };
      xhr.setRequestHeader("Content-type", "application/json");
      xhr.send(request);
    },

    logGroup(logHeader, ...logs) {
      console.groupCollapsed(logHeader);
      for (let log of logs) console.log(log);
      console.groupEnd(logHeader);
    },

    doNothing() {},

    getCategories() {
      this.postAjaxRequest(
        this.url + "getcategories.php",
        JSON.stringify(this.loggedUser),
        this.categoriesRecord
      );
      console.log("2.1");
    },

    categoriesRecord(response) {
      this.categories = response.categories;
      this.logGroup("Список категорий", response);
      console.log("2.2");
    },

    getIcons() {
      this.postAjaxRequest(
        this.url + "geticons.php",
        JSON.stringify({}),
        this.iconsRecord
      );
      console.log("3.1");
    },

    iconsRecord(response) {
      this.icons = response.icons;
      this.logGroup("Список иконок", response);
      console.log("3.2");
    },

    getColors() {
      this.postAjaxRequest(
        this.url + "getcolors.php",
        JSON.stringify({}),
        this.colorsRecord
      );
      console.log("4.1");
    },

    colorsRecord(response) {
      this.colors = response.colors;
      this.logGroup("Список цветов", response);
      console.log("4.2");
    },

    createCategory() {
      const newCategory = Object.assign({}, this.newCategory);
      newCategory.userid = this.loggedUser.id;
      newCategory.user_name = this.loggedUser.name;
      console.log(newCategory);
      this.postAjaxRequest(
        this.url + "createcategory.php",
        JSON.stringify(newCategory),
        this.newCategoryRecord
      );
    },

    newCategoryRecord(response) {
      this.categories.push(response.category);
      this.logGroup("Новая категория", response);
    },

    editCategory() {
      const selectedCategory = Object.assign({}, this.selectedCategory);
      selectedCategory.userid = this.loggedUser.id;
      selectedCategory.user_name = this.loggedUser.name;
      console.log(selectedCategory);
      this.postAjaxRequest(
        this.url + "editcategory.php",
        JSON.stringify(selectedCategory),
        this.editCategoryRecord
      );
    },

    editCategoryRecord(response) {
      this.delectedCategory = response.category;
      this.logGroup("Измененная категория", response);
    },

    deleteCategory() {
      const selectedCategory = Object.assign({}, this.selectedCategory);
      selectedCategory.userid = this.loggedUser.id;
      selectedCategory.user_name = this.loggedUser.name;
      console.log(selectedCategory);
      this.postAjaxRequest(
        this.url + "deletecategory.php",
        JSON.stringify(selectedCategory),
        this.deleteCategoryItem
      );
    },

    deleteCategoryItem(response) {
      // this.delectedCategory = response.category;
      this.logGroup("Измененная категория", response);
    },

    assignIconsToCategories() {
      this.logGroup("Категории до присвоения иконок", this.categories);
      let categories = this.categories;
      let icons = this.icons;
      categories.forEach(function (category) {
        icons.forEach(function (icon) {
          if (category.icon_id === icon.id) {
            // const categoryWithIcon = Object.assign({}, category);
            // categoryWithIcon.icon = icon.icon;
            // category = categoryWithIcon;
            category.icon = icon.icon;
          }
        });
      });
      console.log("5.1");
      this.logGroup("Категории после присвоения иконок", this.categories);
    },

    assignColorsToCategories() {
      this.logGroup("Категории до присвоения цветов", this.categories);
      let categories = this.categories;
      let colors = this.colors;
      categories.forEach(function (category) {
        colors.forEach(function (color) {
          if (category.color_id === color.id) {
            // const categoryWithColor = Object.assign({}, category);
            // categoryWithColor.color = color.hex_color;
            // category = categoryWithColor;
            category.color = color.hex_color;
          }
        });
      });
      console.log("6.1");
      this.logGroup("Категории после присвоения цветов", this.categories);
    },

    delay1() {
      return new Promise((resolve) =>
        setTimeout(() => {
          this.assignIconsToCategories();
          this.assignColorsToCategories();
          console.log("Промис 1 выполнен");
          resolve();
        }, 2000)
      );
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
      return this.categories.find(
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

  mounted: async function () {
    console.log("Начало монтажа страницы CategoriesSettings");
    this.getCategories();
    this.getIcons();
    this.getColors();
    await this.delay1();
    console.log("Окончание монтажа страницы CategoriesSettings");
    this.logGroup("Категории при монтировании страницы", this.categories);
  },
};
</script>

<style scoped></style>
