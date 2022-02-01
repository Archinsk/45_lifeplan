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
      <h4>Цвета</h4>
      <ColorsList :list-items="colors" />
      <h4>Иконки</h4>
      <IconsList :list-items="icons" />
      <CategoriesModal id="edit-category" title="Редактирование категории">
        <CategoriesListItem :task-item="selectedCategory" />
      </CategoriesModal>
      <CategoriesModal id="delete-category" title="Удаление категории">
        <CategoriesListItem :task-item="selectedCategory" />
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
        id: 1,
        name: "mihail",
      },
      categories: [
        {
          color: "",
          color_id: "",
          icon: "",
          icon_id: "",
          id: "",
          name: "",
        },
      ],
      selectedCategory: null,
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

    assignIconsToCategories() {
      this.logGroup("Категории до присвоения иконок", this.categories);
      let categories = this.categories;
      let icons = this.icons;
      categories.forEach(function (category) {
        icons.forEach(function (icon) {
          if (category.icon_id === icon.id) {
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
      this.selectedCategory = category;
    },

    openModalDeleteCategory(category) {
      this.selectedCategory = category;
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
