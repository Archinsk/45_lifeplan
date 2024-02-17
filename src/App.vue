<template>
  <div id="app">
    <!--Modals on top of page is Bootstrap recomendation-->
    <vb-modal id="modal-sign-in" header footer size="sm">
      <template v-slot:modal-header>Авторизация</template>
      <vb-form
        :form-items-list="forms.signIn.formItemsList"
        @change-form="changeForm($event)"
      />
      <p>
        Ещё нет учетной записи?
        <vb-modal-button target-id="modal-sign-up" tag="a"
          >Зарегистрироваться</vb-modal-button
        >
      </p>
      <template v-slot:modal-footer>
        <vb-button theme="outline-primary" data-dismiss="modal"
          >Отмена</vb-button
        >
        <vb-button theme="primary" @click="signIn">Вход</vb-button>
      </template>
    </vb-modal>
    <vb-modal id="modal-sign-out-confirm" size="sm">
      <div class="mb-3">Вы действительно хотите выйти из системы?</div>
      <div class="row row-cols-2">
        <div class="col">
          <vb-button block theme="outline-primary" data-dismiss="modal"
            >Отмена</vb-button
          >
        </div>
        <div class="col">
          <vb-button block theme="primary" @click="signOut"
            >Подтвердить</vb-button
          >
        </div>
      </div>
    </vb-modal>
    <vb-modal id="modal-sign-up" header footer size="sm">
      <template v-slot:modal-header>Регистрация</template>
      <vb-form
        :form-items-list="forms.signUp.formItemsList"
        @change-form="changeForm($event)"
      />
      <template v-slot:modal-footer>
        <vb-button theme="outline-primary" data-dismiss="modal"
          >Отмена</vb-button
        >
        <vb-button theme="primary" @click="signUp">Регистрация</vb-button>
      </template>
    </vb-modal>
    <vb-modal id="modal-categories" header footer scrollable>
      <template v-slot:modal-header>Категории</template>
      <vb-button
        target-id="modal-category-create"
        :theme="themeColors.primary"
        @click="openModalCreateCategory"
        >Добавить категорию</vb-button
      >
      <CategoriesList
        :list-items="categories"
        :theme="themeColors"
        :lightness-mode="lightnessMode"
        @open-modal-edit-category="openModalEditCategory($event)"
        @open-modal-delete-category="openModalDeleteCategory($event)"
      />
      <template v-slot:modal-footer>
        <vb-button theme="outline-primary" data-dismiss="modal"
          >Отмена</vb-button
        >
        <vb-button theme="primary">Добавить</vb-button>
      </template>
    </vb-modal>
    <vb-modal id="modal-category-create" header footer>
      <template v-slot:modal-header>Создание категории</template>
      Пример
      <categories-list-item-template
        :category="newCategory"
        :theme="themeColors"
        :lightness-mode="lightnessMode"
      />
      <div class="mb-3">
        <label for="selectedCategoryName" class="form-label">Название</label>
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
      <vb-tabs
        id="create-category-tabs"
        :items-list="tabs.iconsButtonsTabs.itemsList"
        pills
        position="center"
      >
        <template v-slot:tab-pane-icons
          ><icons-list
            :list-items="icons"
            :theme="themeColors"
            :lightness-mode="lightnessMode"
            @change-icon-selected-category="changeIconNewCategory($event)"
        /></template>
        <template v-slot:tab-pane-colors
          ><colors-list
            :list-items="colors"
            :selected-category-icon="newCategory.icon"
            :theme="themeColors"
            :lightness-mode="lightnessMode"
            @change-color-selected-category="changeColorNewCategory($event)"
        /></template>
      </vb-tabs>
      <div class="form-check">
        <input
          v-model="searchCategoryInExistingTasks"
          class="form-check-input"
          type="checkbox"
          value=""
          id="searchCategoryInExistingTasks"
        />
        <label class="form-check-label" for="searchCategoryInExistingTasks">
          Искать и присваивать создаваемую категорию ранее созданным заданиям
          (поиск по началу строки)
        </label>
      </div>
      <template v-slot:modal-footer>
        <vb-button theme="outline-primary" data-dismiss="modal"
          >Отмена</vb-button
        >
        <vb-button theme="primary" @click="createCategory">Создать</vb-button>
      </template>
    </vb-modal>
    <vb-modal id="modal-category-edit" header footer>
      <template v-slot:modal-header>Редактирование категории</template>
      <p>Пример</p>
      <CategoriesListItem
        :category="selectedCategory"
        :key="selectedCategory.id ? selectedCategory.id : 'default'"
        :theme="themeColors"
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

      <vb-tabs
        id="edit-category-tabs"
        :items-list="tabs.iconsButtonsTabs.itemsList"
        pills
        position="center"
      >
        <template v-slot:tab-pane-icons
          ><icons-list
            :theme="themeColors"
            :lightness-mode="lightnessMode"
            :list-items="icons"
            :selected-category-color="selectedCategory.color"
            @change-icon-selected-category="changeIconSelectedCategory($event)"
        /></template>
        <template v-slot:tab-pane-colors
          ><colors-list
            :theme="themeColors"
            :lightness-mode="lightnessMode"
            :list-items="colors"
            :selected-category-icon="selectedCategory.icon"
            @change-color-selected-category="
              changeColorSelectedCategory($event)
            "
        /></template>
      </vb-tabs>
      <template v-slot:modal-footer>
        <vb-button theme="outline-primary" data-dismiss="modal"
          >Отмена</vb-button
        >
        <vb-button theme="primary" @click="editCategory">Сохранение</vb-button>
      </template>
    </vb-modal>
    <vb-modal id="modal-category-delete" header footer size="sm">
      <template v-slot:modal-header>Удаление категории</template>
      <p>
        {{
          'Вы действительно хотите удалить категорию "' +
          selectedCategory.name +
          '" ?'
        }}
      </p>
      <categories-list-item-template
        :category="selectedCategory"
        :theme="themeColors"
        :lightness-mode="lightnessMode"
      />
      <template v-slot:modal-footer>
        <vb-button theme="outline-primary" data-dismiss="modal"
          >Отмена</vb-button
        >
        <vb-button theme="primary" @click="deleteCategory">Удалить</vb-button>
      </template>
    </vb-modal>
    <vb-modal id="modal-themes" header footer scrollable>
      <template v-slot:modal-header>Темы</template>
      <vb-form
        :form-items-list="forms.themes.basicSettings.formItemsList"
        @change-form="changeForm($event)"
      />
      <vb-tabs
        id="edit-them-tabs"
        :items-list="tabs.themesTabs.itemsList"
        pills
        position="center"
      >
        <template v-slot:tab-pane-theme-primary
          ><vb-form
            :form-items-list="forms.themes.primaryTheme.formItemsList"
            @change-form="changeForm($event)"
        /></template>
        <template v-slot:tab-pane-theme-secondary
          ><vb-form
            :form-items-list="forms.themes.secondaryTheme.formItemsList"
            @change-form="changeForm($event)"
        /></template>
      </vb-tabs>
      <vb-form
        :form-items-list="forms.themes.timeSettings.formItemsList"
        @change-form="changeForm($event)"
      />
      <template v-slot:modal-footer>
        <vb-button theme="outline-primary" data-dismiss="modal"
          >Отмена</vb-button
        >
        <vb-button theme="primary" @click="setTheme">Применить</vb-button>
      </template>
    </vb-modal>

    <vb-header
      :brand="brand"
      :nav="systemNav"
      :theme="themeColors.primary"
      dark
      expand
      expand-size="sm"
      container
      offcanvas
      justify-content="between"
      @nav-bar-brand-click="headerAction($event)"
    />
    <div class="container">
      <form-add-task
        :theme="themeColors"
        :lightness-mode="lightnessMode"
        @add-new-task="addNewTask($event)"
      />
      <div id="tasks">
        <task-list
          :list-items="isFiltered ? tasksTodoFiltered : tasksTodo"
          :theme="themeColors"
          :lightness-mode="lightnessMode"
          id="tasksTodo"
          :class="todoListClass"
          @toggle-task-status="toggleTaskStatus($event)"
          @delete-task="deleteTask($event)"
          @filter-category="filterCategory($event)"
        />
        <task-list
          :list-items="isFiltered ? tasksDoneFiltered : tasksDone"
          :theme="themeColors"
          :lightness-mode="lightnessMode"
          id="tasksDone"
          :class="doneListClass"
          @toggle-task-status="toggleTaskStatus($event)"
          @delete-task="deleteTask($event)"
          @filter-category="filterCategory($event)"
        />
      </div>
    </div>

    <!--@toggle-task-status="$emit('toggle-task-status', $event)"
    @delete-task="$emit('delete-task', $event)"
    @filter-category="filterCategory($event)"-->
    <!--<router-view
      :tasks="tasksWithCategories"
      :url="url"
      :is-app-loaded="isAppLoaded"
      :theme="theme"
      :categories-db="categories"
      :icons-db="icons"
      :colors-db="colors"
      :themes="basicThemes"
      :lightness-mode="lightnessMode"
      :is-auth-user="isAuthUser"
      @add-new-task="addNewTask($event)"
      @toggle-task-status="toggleTaskStatus($event)"
      @delete-task="deleteTask($event)"
      @create-category="createCategory($event)"
      @edit-category="editCategory($event)"
      @delete-category="deleteCategory($event)"
      @change-color-theme="changeColorTheme($event)"
      @change-dark-mode="changeLightnessMode($event)"
      @save-color-themes="saveColorThemes"
      @auth-user="authUser($event)"
      @sign-out="signOut"
    />-->
  </div>
</template>

<script>
import $ from "jquery";
import axios from "axios";
// import TheHeader from "./components/TheHeader";
import VbHeader from "./components/universal/bs4-based/BS46Header";
import VbModal from "./components/universal/bs4-based/BS46Modal";
import VbButton from "./components/universal/bs4-based/BS46Button";
import VbForm from "./components/universal/bs4-based/BS46Form";
import VbModalButton from "./components/universal/bs4-based/BS46ModalButton";
import VbTabs from "./components/universal/bs4-based/BS46Tabs";

import CategoriesList from "./components/CategoriesList";
import CategoriesListItem from "./components/CategoriesListItem";
import CategoriesListItemTemplate from "./components/CategoriesListItemTemplate";
import IconsList from "./components/IconsList";
import ColorsList from "./components/ColorsList";

import TaskList from "./components/TaskList";
import FormAddTask from "./components/FormAddTask";

export default {
  components: {
    FormAddTask,
    TaskList,
    VbTabs,
    ColorsList,
    IconsList,
    CategoriesListItemTemplate,
    CategoriesListItem,
    VbModalButton,
    CategoriesList,
    VbForm,
    VbButton,
    VbModal,
    VbHeader,
    // TheHeader
  },
  data() {
    return {
      url: "https://www.d-skills.ru/45_lifeplan/php/",
      loggedUser: {
        id: "1",
        name: "mihail",
      },
      // loggedUser: {
      //   id: null,
      //   name: "",
      // },
      // loggedUser: {
      //   id: 79,
      //   name: "Гость",
      // },
      defaultTasks: [
        {
          id: "1534",
          task: "Бытовые. Заменить выключатель в детской комнате",
          done: "0",
          creationDate: 1642636460,
          completionDate: null,
          categoryid: "121",
        },
        {
          id: "1533",
          task: "Саморазвитие. Поучаствовать в соревнованиях по настольному теннису",
          done: "0",
          creationDate: 1642636430,
          completionDate: null,
          categoryid: "123",
          category: {
            id: "123",
            name: "Саморазвитие",
            iconid: "13",
            icon: "self_improvement",
            colorid: "6",
            color: "#9060C0",
          },
        },
        {
          id: "1532",
          task: "Саморазвитие. Разучить на гитаре песню Depeche Mode «Personal Jesus»",
          done: "0",
          creationDate: 1642636400,
          completionDate: null,
          categoryid: "123",
          category: {
            id: "123",
            name: "Саморазвитие",
            iconid: "13",
            icon: "self_improvement",
            colorid: "6",
            color: "#9060C0",
          },
        },
        {
          id: "1531",
          task: "Саморазвитие. Прочитать книгу Экзюпери «Цитадель»",
          done: "0",
          creationDate: 1642241690,
          completionDate: null,
          categoryid: "123",
          category: {
            id: "123",
            name: "Саморазвитие",
            iconid: "13",
            icon: "self_improvement",
            colorid: "6",
            color: "#9060C0",
          },
        },
        {
          id: "1530",
          task: "Саморазвитие. Пройти интерактивный курс htmlacademy.ru",
          done: "1",
          creationDate: 1642241660,
          completionDate: 1645600075,
          categoryid: "123",
          category: {
            id: "123",
            name: "Саморазвитие",
            iconid: "13",
            icon: "self_improvement",
            colorid: "6",
            color: "#9060C0",
          },
        },
        {
          id: "1529",
          task: "Бытовые. Заменить светильник в кухне",
          done: "0",
          creationDate: 1642241630,
          completionDate: null,
          categoryid: "121",
        },
        {
          id: "1528",
          task: "Бытовые. Собрать компьютерный стол",
          done: "1",
          creationDate: 1642241600,
          completionDate: 1642670000,
          categoryid: "121",
        },
        {
          id: "1527",
          task: "Жизненный план. Закупить строительные материалы",
          done: "0",
          creationDate: 1641550460,
          completionDate: null,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
        {
          id: "1525",
          task: "Жизненный план. Выполнить проект дома",
          done: "1",
          creationDate: 1641550430,
          completionDate: 1645600045,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
        {
          id: "1526",
          task: "Жизненный план. Приобрести участок под строительство",
          done: "1",
          creationDate: 1641550400,
          completionDate: 1644559611,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
        {
          id: "1524",
          task: "Жизненный план. Вырастить сына",
          done: "0",
          creationDate: 1641032060,
          completionDate: null,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
        {
          id: "1523",
          task: "Жизненный план. Построить дом",
          done: "0",
          creationDate: 1641032030,
          completionDate: null,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
        {
          id: "1522",
          task: "Жизненный план. Посадить дерево",
          done: "1",
          creationDate: 1641032000,
          completionDate: 1641550400,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
      ],
      defaultCategories: [
        {
          id: "122",
          name: "Жизненный план",
          iconid: "7",
          icon: "stars",
          colorid: "1",
          color: "#60C060",
        },
        {
          id: "123",
          name: "Саморазвитие",
          iconid: "13",
          icon: "self_improvement",
          colorid: "6",
          color: "#9060C0",
        },
      ],
      isAppLoaded: false,
      basicThemes: [
        {
          id: 1,
          value: "emerald",
          name: "Изумруд",
        },
        {
          id: 2,
          value: "jade",
          name: "Нефрит",
        },
        {
          id: 3,
          value: "turquoise",
          name: "Бирюза",
        },
        {
          id: 4,
          value: "steel",
          name: "Сталь",
        },
        {
          id: 5,
          value: "azure",
          name: "Лазурь",
        },
        {
          id: 6,
          value: "amethyst",
          name: "Аметист",
        },
        {
          id: 7,
          value: "fuchsia",
          name: "Фуксия",
        },
        {
          id: 8,
          value: "honeysuckle",
          name: "Жимолость",
        },
        {
          id: 9,
          value: "chestnut",
          name: "Каштан",
        },
        {
          id: 10,
          value: "copper",
          name: "Медь",
        },
        {
          id: 11,
          value: "khaki",
          name: "Хаки",
        },
        {
          id: 12,
          value: "asparagus",
          name: "Спаржа",
        },
      ],
      //------------------------------
      brand: {
        type: "action-link",
        href: "/",
        name: "",
        imageSrc: "images/lifeplan_logo.svg",
        action: { methodName: "listsToggle", argument: "" },
      },
      systemNav: {
        itemsList: [
          {
            id: "nav-link-tasks",
            name: "Задания",
            type: "router-link",
            href: "/",
            active: false,
            disabled: false,
            icon: "check_circle",
          },
          {
            id: "nav-link-categories",
            name: "Категории",
            type: "modal-link",
            href: "modal-categories",
            active: false,
            disabled: false,
            icon: "category",
          },
          {
            id: "nav-link-themes",
            name: "Темы",
            type: "modal-link",
            href: "modal-themes",
            active: false,
            disabled: false,
            icon: "brush",
          },
          /*{
            id: "nav-link-statistics",
            name: "Статистика",
            type: "router-link",
            href: "/statistics",
            active: false,
            disabled: false,
            icon: "leaderboard",
          },
          {
            id: "nav-link-settings",
            name: "Настройки",
            type: "router-link",
            href: "/settings",
            active: false,
            disabled: false,
            icon: "settings",
          },
          {
            id: "nav-link-help",
            name: "Помощь",
            type: "router-link",
            href: "/icon",
            active: false,
            disabled: false,
            icon: "help",
          },*/
          {
            id: "nav-link-sign-in",
            name: "Вход",
            type: "modal-link",
            href: "modal-sign-in",
            active: false,
            disabled: false,
            icon: "login",
          },
          {
            id: "nav-link-sign-out",
            name: "Выход",
            type: "modal-link",
            href: "modal-sign-out-confirm",
            active: false,
            disabled: false,
            icon: "logout",
          },
        ],
      },
      icons: [],
      colors: [],
      categories: [],
      tasks: [],
      forms: {
        signIn: {
          id: "sign-in-form",
          formItemsList: [
            {
              id: "sign-in-user-login",
              label: "Логин",
              type: "input",
              subtype: "text",
              required: false,
              additionalClasses: {
                group: "col-12",
                label: "",
                field: "",
              },
              errorText: "",
              value: "",
            },
            {
              id: "sign-in-user-password",
              label: "Пароль",
              type: "input",
              subtype: "text",
              required: false,
              additionalClasses: {
                group: "col-12",
                label: "",
                field: "",
              },
              errorText: "",
              value: "",
            },
          ],
          validity: false,
        },
        signUp: {
          id: "sign-up-form",
          formItemsList: [
            {
              id: "sign-up-user-login",
              label: "Логин",
              type: "input",
              subtype: "text",
              required: false,
              additionalClasses: {
                group: "col-12",
                label: "",
                field: "",
              },
              errorText: "",
              value: "",
            },
            {
              id: "sign-up-user-password",
              label: "Пароль",
              type: "input",
              subtype: "text",
              required: false,
              additionalClasses: {
                group: "col-12",
                label: "",
                field: "",
              },
              errorText: "",
              value: "",
            },
            {
              id: "sign-up-user-password-repeat",
              label: "Повтор пароля",
              type: "input",
              subtype: "text",
              required: false,
              additionalClasses: {
                group: "col-12",
                label: "",
                field: "",
              },
              errorText: "",
              value: "",
            },
          ],
          validity: false,
        },
        themes: {
          basicSettings: {
            id: "theme-basic-settings-form",
            formItemsList: [
              {
                id: "theme-additional-mode",
                type: "input",
                subtype: "checkbox",
                label: "Переключение тем по расписанию",
                switchMode: true,
                value: false,
              },
            ],
          },
          primaryTheme: {
            id: "primary-theme",
            formItemsList: [
              {
                id: "primary-theme-color-radio",
                type: "radioGroup",
                buttonMode: true,
                itemsList: [
                  {
                    id: "1",
                    value: "emerald",
                    label: "",
                    additionalClasses: "btn-light-emerald-primary btn-square",
                  },
                  {
                    id: "2",
                    value: "jade",
                    label: "",
                    additionalClasses: "btn-light-jade-primary btn-square",
                  },
                  {
                    id: "3",
                    value: "turquoise",
                    label: "",
                    additionalClasses: "btn-light-turquoise-primary btn-square",
                  },
                  {
                    id: "4",
                    value: "steel",
                    label: "",
                    additionalClasses: "btn-light-steel-primary btn-square",
                  },
                  {
                    id: "5",
                    value: "azure",
                    label: "",
                    additionalClasses: "btn-light-azure-primary btn-square",
                  },
                  {
                    id: "6",
                    value: "amethyst",
                    label: "",
                    additionalClasses: "btn-light-amethyst-primary btn-square",
                  },
                  {
                    id: "7",
                    value: "fuchsia",
                    label: "",
                    additionalClasses: "btn-light-fuchsia-primary btn-square",
                  },
                  {
                    id: "8",
                    value: "honeysuckle",
                    label: "",
                    additionalClasses:
                      "btn-light-honeysuckle-primary btn-square",
                  },
                  {
                    id: "9",
                    value: "chestnut",
                    label: "",
                    additionalClasses: "btn-light-chestnut-primary btn-square",
                  },
                  {
                    id: "10",
                    value: "copper",
                    label: "",
                    additionalClasses: "btn-light-copper-primary btn-square",
                  },
                  {
                    id: "11",
                    value: "khaki",
                    label: "",
                    additionalClasses: "btn-light-khaki-primary btn-square",
                  },
                  {
                    id: "12",
                    value: "asparagus",
                    label: "",
                    additionalClasses: "btn-light-asparagus-primary btn-square",
                  },
                ],
                value: "emerald",
              },
              {
                id: "primary-theme-lightness-mode",
                type: "input",
                subtype: "checkbox",
                label: "Тёмный режим",
                switchMode: true,
                value: false,
              },
            ],
          },
          secondaryTheme: {
            id: "secondary-theme",
            formItemsList: [
              {
                id: "secondary-theme-color-radio",
                type: "radioGroup",
                buttonMode: true,
                itemsList: [
                  {
                    id: "1",
                    value: "emerald",
                    label: "",
                    additionalClasses: "btn-light-emerald-primary btn-square",
                  },
                  {
                    id: "2",
                    value: "jade",
                    label: "",
                    additionalClasses: "btn-light-jade-primary btn-square",
                  },
                  {
                    id: "3",
                    value: "turquoise",
                    label: "",
                    additionalClasses: "btn-light-turquoise-primary btn-square",
                  },
                  {
                    id: "4",
                    value: "steel",
                    label: "",
                    additionalClasses: "btn-light-steel-primary btn-square",
                  },
                  {
                    id: "5",
                    value: "azure",
                    label: "",
                    additionalClasses: "btn-light-azure-primary btn-square",
                  },
                  {
                    id: "6",
                    value: "amethyst",
                    label: "",
                    additionalClasses: "btn-light-amethyst-primary btn-square",
                  },
                  {
                    id: "7",
                    value: "fuchsia",
                    label: "",
                    additionalClasses: "btn-light-fuchsia-primary btn-square",
                  },
                  {
                    id: "8",
                    value: "honeysuckle",
                    label: "",
                    additionalClasses:
                      "btn-light-honeysuckle-primary btn-square",
                  },
                  {
                    id: "9",
                    value: "chestnut",
                    label: "",
                    additionalClasses: "btn-light-chestnut-primary btn-square",
                  },
                  {
                    id: "10",
                    value: "copper",
                    label: "",
                    additionalClasses: "btn-light-copper-primary btn-square",
                  },
                  {
                    id: "11",
                    value: "khaki",
                    label: "",
                    additionalClasses: "btn-light-khaki-primary btn-square",
                  },
                  {
                    id: "12",
                    value: "asparagus",
                    label: "",
                    additionalClasses: "btn-light-asparagus-primary btn-square",
                  },
                ],
                value: "emerald",
              },
              {
                id: "secondary-theme-lightness-mode",
                type: "input",
                subtype: "checkbox",
                label: "Тёмный режим",
                switchMode: true,
                value: false,
              },
            ],
          },
          timeSettings: {
            id: "theme-time-settings-form",
            formItemsList: [
              {
                id: "theme-secondary-time-start",
                type: "input",
                subtype: "time",
                label: "Начало дополнительной темы",
                value: "17:00",
              },
              {
                id: "theme-secondary-time-end",
                type: "input",
                subtype: "time",
                label: "Окончание дополнительной темы",
                value: "08:00",
              },
            ],
          },
        },
      },
      user: {
        id: null,
        name: "",
        isAuth: false,
      },
      themeColor: "amethyst",
      lightnessMode: "light",

      defaultCategory: {
        color: "neutral-600",
        colorid: "",
        icon: "",
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
      searchCategoryInExistingTasks: false,
      selectedCategory: {
        color: "",
        colorid: "",
        icon: "home",
        iconid: "",
        id: "",
        name: "",
      },

      tabs: {
        iconsButtonsTabs: {
          itemsList: [
            { id: "tab-pane-icons", active: true, name: "Иконка" },
            { id: "tab-pane-colors", active: false, name: "Цвет" },
          ],
        },
        themesTabs: {
          itemsList: [
            { id: "tab-pane-theme-primary", active: true, name: "Основная" },
            {
              id: "tab-pane-theme-secondary",
              active: false,
              name: "Дополнительная",
            },
          ],
        },
      },

      isFiltered: false,
      filteredCategoryId: "",
      doneListVisibility: false,
      todoListClass: "position-relative",
      doneListClass: "bg-secondary position-absolute",
      timeStamp: +new Date(),

      appLoadingStart: null,

      theme: {
        id: null,
        isToggleThemesByTime: false,
        primary: {
          color: "steel",
          lightnessMode: "light",
          timeStart: "08:00",
        },
        secondary: {
          color: "amethyst",
          lightnessMode: "light",
          timeStart: "17:00",
        },
      },

      // Данные модального окна авторизации
      errors: {
        signIn: {
          login: {
            id: "",
            type: "",
            errorText: "",
          },
          password: {
            id: "",
            type: "",
            errorText: "",
          },
        },
        signUp: {
          login: {
            id: "",
            type: "",
            errorText: "",
          },
          password: {
            id: "",
            type: "",
            errorText: "",
          },
          passwordRepeat: {
            id: "",
            type: "",
            errorText: "",
          },
        },
      },
      serverErrors: {
        signIn: {
          login: [],
          password: [],
        },
        signUp: {
          login: [],
        },
      },
      emptyError: {
        id: "",
        type: "",
        errorText: "",
      },
      signInModal: null,
      signUpModal: null,

      timeoutIdReloadTasks: null,
      intervalIdReloadTasksDaily: null,
    };
  },

  computed: {
    a1TimeStampGlobal() {
      return new Date(this.timeStamp);
    },
    a2timeZoneOffsetMs() {
      return new Date(this.timeStamp).getTimezoneOffset() * 60000;
    },
    a3timeStampWithTimezoneOffset: function () {
      return new Date(this.timeStamp - this.timeZoneOffsetMs);
    },
    a4startOfDayGMTinMs() {
      return new Date(this.startOfDayGMTinMs);
    },
    a5startOfDayLocalinMs() {
      return new Date(this.startOfDayLocalinMs);
    },
    a6finishOfDayLocalinMs() {
      return new Date(this.finishOfDayLocalinMs);
    },
    isAuthUser: function () {
      return !!this.loggedUser.id;
    },

    //------------------------------
    themeColors: function () {
      return {
        primary:
          this.theme[this.currentTheme].lightnessMode +
          "-" +
          this.theme[this.currentTheme].color +
          "-primary",
        secondary:
          this.theme[this.currentTheme].lightnessMode +
          "-" +
          this.theme[this.currentTheme].color +
          "-secondary",
        info:
          this.theme[this.currentTheme].lightnessMode +
          "-" +
          this.theme[this.currentTheme].color +
          "-info",
      };
    },
    categoriesWithIconsAndColors() {
      let categoriesWithIconsAndColors = [];
      if (this.categories.length && (this.icons.length || this.colors.length)) {
        categoriesWithIconsAndColors = this.categories.map((category) => {
          this.icons.forEach((icon) => {
            if (category.iconid === icon.id) {
              category.icon = icon.icon;
            }
          });
          this.colors.forEach((color) => {
            if (category.colorid === color.id) {
              category.color = color.name;
            }
          });
          return category;
        });
      }
      return categoriesWithIconsAndColors;
    },
    tasksWithCategories() {
      let tasksWithCategories = [];
      if (this.tasks.length && this.categoriesWithIconsAndColors.length) {
        tasksWithCategories = this.tasks.map((task) => {
          this.categories.forEach((category) => {
            if (task.categoryid === category.id) {
              task.category = category;
            }
          });
          task.done = !!+task.done;
          return task;
        });
      }
      return tasksWithCategories;
    },

    timeZoneOffsetMs() {
      return new Date(this.timeStamp).getTimezoneOffset() * 60000;
    },
    timeStampWithTimezoneOffset: function () {
      return this.timeStamp + this.timeZoneOffsetMs;
    },
    startOfDayGMTinMs: function () {
      return (
        this.timeStampWithTimezoneOffset -
        (this.timeStampWithTimezoneOffset % 86400000)
      );
    },
    startOfDayLocalinMs: function () {
      return (
        this.startOfDayGMTinMs +
        new Date(this.timeStamp).getTimezoneOffset() * 60000
      );
    },
    tasksTodo: function () {
      const startOfDayLocalinMs = this.startOfDayLocalinMs;
      let todo = this.tasksWithCategories
        .filter(function (task) {
          if (!+task.done) {
            return true;
          } else if (task.completionDate * 1000 > startOfDayLocalinMs) {
            return true;
          }
        })
        .slice(0, 20);
      return todo;
    },
    tasksDone: function () {
      const startOfDayLocalinMs = this.startOfDayLocalinMs;
      let done = this.tasksWithCategories.filter(function (task) {
        if (!!+task.done && task.completionDate * 1000 <= startOfDayLocalinMs) {
          return true;
        }
      });
      done = done
        .sort(function (a, b) {
          if (a.completionDate > b.completionDate) {
            return -1;
          }
          if (a.completionDate === b.completionDate) {
            return 0;
          }
          if (a.completionDate < b.completionDate) {
            return 1;
          }
        })
        .slice(0, 20);
      return done;
    },
    tasksTodoFiltered: function () {
      if (this.isFiltered) {
        let todoFiltered = this.tasksTodo.filter(
          (task) =>
            task.category && task.category.id === this.filteredCategoryId
        );
        return todoFiltered;
      }
      return false;
    },
    tasksDoneFiltered: function () {
      if (this.isFiltered) {
        let doneFiltered = this.tasksDone.filter(
          (task) =>
            task.category && task.category.id === this.filteredCategoryId
        );
        return doneFiltered;
      }
      return false;
    },
    finishOfDayLocalinMs() {
      return this.startOfDayLocalinMs + 86400000;
    },
    timeToReloadTasks() {
      return this.finishOfDayLocalinMs - this.timeStamp;
    },
    timePassedFromTodayStart() {
      return (this.timeStamp - this.timeZoneOffsetMs) % 86400000;
    },
    timePrimaryThemeStart() {
      let timeArray = this.theme.primary.timeStart.split(":");
      return +timeArray[0] * 60 * 60 * 1000 + +timeArray[1] * 60 * 1000;
    },
    timeSecondaryThemeStart() {
      let timeArray = this.theme.secondary.timeStart.split(":");
      return +timeArray[0] * 60 * 60 * 1000 + +timeArray[1] * 60 * 1000;
    },

    currentTheme() {
      if (
        this.timePassedFromTodayStart > this.timeSecondaryThemeStart &&
        this.timePassedFromTodayStart < this.timePrimaryThemeStart
      ) {
        return "secondary";
      } else {
        return "primary";
      }
    },
  },

  methods: {
    assignCategoryToTasksByName(category) {
      let tasks = this.tasks;
      tasks.forEach(function (task) {
        if (task.task.startsWith(category.name)) {
          task.category = category;
        }
      });
    },

    addNewTask(createdTask) {
      const newTask = {
        login: this.loggedUser.name,
        userid: this.loggedUser.id,
        task: createdTask,
      };
      axios.post(this.url + "createtask.php", newTask).then((response) => {
        let task = response.data.task;
        // Разобраться с типами данных
        task.id = "" + task.id;
        if (task.categoryid) {
          task.category = this.categories.find(
            (category) => category.id === task.categoryid
          );
        }
        this.tasks.unshift(task);
      });
    },

    toggleTaskStatus(updatedTask) {
      axios
        .post(this.url + "toggletaskstatus.php", updatedTask)
        .then((response) => {
          const task = this.tasks.find(
            (task) => task.id === response.data.task.id
          );
          task.done = task.done === "0" ? "1" : "0";
          task.completionDate =
            task.completionDate === null
              ? response.data.task.completion_date
              : null;
        });
    },

    deleteTask(taskId) {
      const task = { id: taskId };
      axios.post(this.url + "deletetask.php", task).then(() => {
        let taskIndex = this.tasks.findIndex((task) => task.id === taskId);
        this.tasks.splice(taskIndex, 1);
      });
    },

    filterCategory(categoryId) {
      if (!this.isFiltered) {
        this.filteredCategoryId = categoryId;
      } else {
        this.filteredCategoryId = "";
      }
      this.isFiltered = !this.isFiltered;
    },

    changeColorTheme(basicThemeId) {
      console.log("Смена темы");
      const colorTheme = this.basicThemes[basicThemeId - 1];
      this.themeColor = colorTheme.value;
      document.body.className = "bg-" + this.themeColors.secondary;
    },

    changeLightnessMode(lightnessMode) {
      this.lightnessMode = lightnessMode === "light" ? "dark" : "light";
      document.body.className = "bg-" + this.themeColors.secondary;
    },

    saveColorThemes() {
      const request = {
        userid: this.loggedUser.id,
        themecolors: this.themeColor,
        lightnessmodes: this.lightnessMode,
        starttimes: "14:30",
      };
      axios.post(this.url + "savethemes.php", request);
    },

    authUser(user) {
      this.loggedUser = user;
      this.initApp();
      this.$router.push("/");
    },

    // addNewIcons() {
    //   this.postAjaxRequest(
    //     this.url + "createicons.php",
    //     JSON.stringify(this.newIcons),
    //     this.logGroup("Записываю иконки", this.icons)
    //   );
    // },

    // createNewColors() {
    //   this.postAjaxRequest(
    //     this.url + "createcolors.php",
    //     JSON.stringify(this.newColors),
    //     this.logGroup("Записываю иконки", this.newColors)
    //   );
    // },

    // writeCategoriesToTasks() {
    //   this.postAjaxRequest(
    //           this.url + "assigncategoriestotasks.php",
    //           JSON.stringify({}),
    //           this.logGroup("Присвоение категорий существующим заданиям", this.tasks)
    //   );
    // },

    //------------------------------
    // Общие методы
    doNothing() {},
    logGroup(logHeader, ...logs) {
      console.groupCollapsed(logHeader);
      for (let log of logs) console.log(log);
      console.groupEnd(logHeader);
    },

    // Инициализация
    async initApp() {
      this.appLoadingStart = new Date();

      this.timeoutIdReloadTasks = setTimeout(
        this.setTimerReloadTasks,
        this.timeToReloadTasks
      );
      this.initTheme();

      // Общедоступные сведения
      await Promise.all([
        this.checkAuth(),
        this.getIcons(),
        this.getColors(),
      ]).then(() => {
        console.log("--- Загружены общедоступные сведения ---");
      });
      // Cведения авторизованного пользователя
      await Promise.all([
        this.getTheme(),
        this.getTasks(),
        this.getCategories(),
      ]).then(() => {
        console.log("--- Загружены сведения авторизованного пользователя ---");
      });

      this.isAppLoaded = true;
      console.log(
        "Програма инициализирована за " +
          (new Date() - this.appLoadingStart) +
          "мс"
      );
      // } else {
      //   this.tasks = this.defaultTasks;
      //   this.categories = this.defaultCategories;
      //   this.isAppLoaded = true;
      //   console.log(
      //     "Програма инициализирована за " + (new Date() - startDate) + "мс"
      //   );
      // }
    },

    // Авторизация
    async checkAuth() {
      await axios.post(this.url + "checkauth.php", {}).then((response) => {
        if (response.data.user) {
          if (response.data.user) {
            this.user.id = +response.data.user.id;
            this.user.name = response.data.user.name;
            this.user.isAuth = true;
          }
          console.log("Пользователь является авторизованным");
        } else {
          console.log("Пользователь не является авторизованным");
        }
      });
    },
    async signIn() {
      let requestBody = {
        login: this.forms.signIn.formItemsList[0].value,
        password: this.forms.signIn.formItemsList[1].value,
      };
      await axios
        .post(this.url + "signin.php", requestBody)
        .then((response) => {
          this.logGroup("Ответ на проверку авторизации", response.data);
          // this.signInResponseParsing(response.data, user);
          if (response.data.user) {
            this.user.id = +response.data.user.id;
            this.user.name = response.data.user.name;
            this.user.isAuth = true;
          }
          if (response.data.error) {
            if (response.data.error.type === "login") {
              this.forms.signIn.formItemsList[0].errorText =
                response.data.error.errorText;
              this.forms.signIn.formItemsList[1].errorText = "";
            }
            if (response.data.error.type === "password") {
              this.forms.signIn.formItemsList[0].errorText = "";
              this.forms.signIn.formItemsList[1].errorText =
                response.data.error.errorText;
            }
          }
        });
    },
    async signUp() {
      let requestBody = {
        login: this.forms.signUp.formItemsList[0].value,
        password: this.forms.signUp.formItemsList[1].value,
      };
      axios.post(this.url + "signup.php", requestBody).then((response) => {
        // this.signUpResponseParsing(response.data, user);
        this.logGroup("Ответ на проверку регистрации", response.data);
        if (response.data.user) {
          this.user.id = +response.data.user.id;
          this.user.name = response.data.user.name;
          this.user.isAuth = true;
        }
        if (response.data.error) {
          this.forms.signUp.formItemsList[0].errorText =
            response.data.error.errorText;
          this.forms.signUp.formItemsList[1].errorText = "";
        }
      });
    },
    signOut() {
      console.log("Выход");
      axios.post(this.url + "signout.php").then(() => {
        location.reload();
      });
    },

    // Общие сведения
    async getIcons() {
      await axios.post(this.url + "geticons.php").then((response) => {
        this.logGroup(
          "Список иконок получен за " +
            (new Date() - this.appLoadingStart) +
            "мс со старта программы",
          response.data.icons
        );
        this.icons = response.data.icons;
      });
    },
    async getColors() {
      await axios.post(this.url + "getcolors.php").then((response) => {
        this.logGroup(
          "Список цветов получен за " +
            (new Date() - this.appLoadingStart) +
            "мс со старта программы",
          response.data.colors
        );
        this.colors = response.data.colors;
      });
    },

    // Сведения авторизованного пользователя
    async getTasks() {
      await axios
        .post(this.url + "gettasks.php", this.loggedUser)
        .then((response) => {
          this.logGroup(
            "Список заданий получен через " +
              (new Date() - this.appLoadingStart) +
              "мс со старта программы",
            response.data.tasks
          );
          this.tasks = response.data.tasks;
        });
    },
    async getCategories() {
      await axios
        .post(this.url + "getcategories.php", this.loggedUser)
        .then((response) => {
          this.logGroup(
            "Список категорий получен за " +
              (new Date() - this.appLoadingStart) +
              "мс со старта программы",
            response.data.categories
          );
          this.categories = response.data.categories;
        });
    },

    // Работа с категориями
    openModalCreateCategory() {
      this.newCategory = Object.assign({}, this.defaultCategory);
      this.showModal("modal-category-create");
    },
    openModalEditCategory(category) {
      this.selectedCategory = Object.assign({}, category);
      this.showModal("modal-category-edit");
    },
    openModalDeleteCategory(category) {
      this.selectedCategory = Object.assign({}, category);
      this.showModal("modal-category-delete");
    },
    changeIconNewCategory(icon) {
      this.newCategory.icon = icon.icon;
      this.newCategory.iconid = icon.id;
    },
    changeColorNewCategory(color) {
      this.newCategory.color = color.name;
      this.newCategory.colorid = color.id;
    },
    changeIconSelectedCategory(icon) {
      this.selectedCategory.icon = icon.icon;
      this.selectedCategory.iconid = icon.id;
    },
    changeColorSelectedCategory(color) {
      this.selectedCategory.color = color.name;
      this.selectedCategory.colorid = color.id;
    },
    async createCategory() {
      const newCategory = Object.assign({}, this.newCategory);
      newCategory.userid = this.loggedUser.id;
      newCategory.user_name = this.loggedUser.name;
      if (this.searchCategoryInExistingTasks) {
        newCategory.search = true;
      }
      await axios
        .post(this.url + "createcategory.php", newCategory)
        .then((response) => {
          this.hideModal("modal-category-create");
          this.logGroup("Добавлена категория", response.data);
        });
      await Promise.all([this.getTasks(), this.getCategories()]).then(() => {
        console.log("--- Обновлены задания и категории ---");
      });
    },
    async editCategory() {
      const updatedCategory = Object.assign({}, this.selectedCategory);
      updatedCategory.userid = this.loggedUser.id;
      updatedCategory.user_name = this.loggedUser.name;
      await axios
        .post(this.url + "editcategory.php", updatedCategory)
        .then((response) => {
          this.hideModal("modal-category-edit");
          this.logGroup("Измененна категория", response.data);
        });
      await Promise.all([this.getTasks(), this.getCategories()]).then(() => {
        console.log("--- Обновлены задания и категории ---");
      });
    },
    async deleteCategory() {
      let deletedCategory = Object.assign({}, this.selectedCategory);
      deletedCategory.userid = this.loggedUser.id;
      deletedCategory.user_name = this.loggedUser.name;
      await axios
        .post(this.url + "deletecategory.php", deletedCategory)
        .then((response) => {
          this.hideModal("modal-category-delete");
          this.logGroup("Удалена категория", response.data);
        });
      await Promise.all([this.getTasks(), this.getCategories()]).then(() => {
        console.log("--- Обновлены задания и категории ---");
      });
    },

    // Темы
    initTheme() {
      this.theme.currentTheme = "primary";
      document.body.className = "bg-" + this.themeColors.secondary;
    },
    async getTheme() {
      await axios
        .post(this.url + "gettheme.php", { userid: this.loggedUser.id })
        .then((response) => {
          // this.hideModal("modal-category-create");
          this.logGroup("Тема пользователя", response.data);
          let loadedTheme = {
            id: response.data.theme.id,
            isToggleThemesByTime: !!+response.data.theme.toggle_by_time,
            primary: {
              color: response.data.theme.primary_color,
              lightnessMode: response.data.theme.primary_lightness,
              timeStart: response.data.theme.primary_time_start,
            },
            secondary: {
              color: response.data.theme.secondary_color,
              lightnessMode: response.data.theme.secondary_lightness,
              timeStart: response.data.theme.secondary_time_start,
            },
          };
          this.theme = Object.assign({}, loadedTheme);
          document.body.className =
            "bg-" +
            this.theme[this.currentTheme].lightnessMode +
            "-" +
            this.theme[this.currentTheme].color +
            "-secondary";
          this.forms.themes.basicSettings.formItemsList[0].value =
            !!+response.data.theme.toggle_by_time;
          this.forms.themes.primaryTheme.formItemsList[0].value =
            response.data.theme.primary_color;
          this.forms.themes.primaryTheme.formItemsList[1].value =
            !!+response.data.theme.primary_lightness;
          this.forms.themes.secondaryTheme.formItemsList[0].value =
            response.data.theme.secondary_color;
          this.forms.themes.secondaryTheme.formItemsList[1].value =
            !!+response.data.theme.secondary_lightness;
          this.forms.themes.timeSettings.formItemsList[0].value =
            response.data.theme.primary_time_start;
          this.forms.themes.timeSettings.formItemsList[1].value =
            response.data.theme.secondary_time_start;
          console.log(this.forms.themes);
        });
    },
    async setTheme() {
      const updatedTheme = {
        toggle_by_time: this.forms.themes.basicSettings.formItemsList[0].value,
        primary_color: this.forms.themes.primaryTheme.formItemsList[0].value,
        primary_lightness: this.forms.themes.primaryTheme.formItemsList[1].value
          ? "dark"
          : "light",
        primary_time_start:
          this.forms.themes.timeSettings.formItemsList[1].value,
        secondary_color:
          this.forms.themes.secondaryTheme.formItemsList[0].value,
        secondary_lightness: this.forms.themes.secondaryTheme.formItemsList[1]
          .value
          ? "dark"
          : "light",
        secondary_time_start:
          this.forms.themes.timeSettings.formItemsList[0].value,
      };
      if (this.theme.id) {
        updatedTheme.id = this.theme.id;
      } else {
        updatedTheme.userid = this.loggedUser.id;
      }
      // this.logGroup("Обновляемая тема", updatedTheme);
      await axios
        .post(this.url + "settheme.php", updatedTheme)
        .then((response) => {
          this.hideModal("modal-category-create");
          if (this.theme.id) {
            this.logGroup("Обновлена тема", response.data);
          } else {
            this.logGroup("Добавлена тема", response.data);
          }
        });

      await this.getTheme();
    },

    // Формы и фильтры
    changeForm({ formItem, newValue }) {
      if ("value" in formItem) {
        formItem.value = newValue;
      }
      if ("values" in formItem) {
        formItem.values = newValue.slice();
      }
    },

    // Модальные окна
    showModal(modalId) {
      $(`#${modalId}`).modal({
        backdrop: true,
      });
      $(`#${modalId}`).modal("show");
    },
    hideModal(modalId) {
      $(`#${modalId}`).modal("hide");
    },

    // Методы хедера
    headerAction(action) {
      this[action.methodName](action.argument);
    },
    listsToggle() {
      console.log("Сработал переключатель листов");
      let delay = new Promise((resolve) => {
        setTimeout(() => {
          resolve();
        }, 500);
      });
      if (!this.doneListVisibility) {
        this.todoListClass = "position-absolute";
        this.doneListClass =
          "bg-" + this.themeColors.secondary + " position-relative active";
        this.doneListVisibility = true;
      } else {
        this.doneListClass =
          "bg-" + this.themeColors.secondary + " position-relative";
        delay.then(() => {
          this.todoListClass = "position-relative";
          this.doneListClass =
            "bg-" + this.themeColors.secondary + " position-absolute";
          this.doneListVisibility = false;
        });
      }
    },

    setTimerReloadTasks() {
      this.reloadTasks();
      this.intervalIdReloadTasksDaily = setInterval(this.reloadTasks, 86400000);
    },
    reloadTasks() {
      this.timeStamp = +new Date();
      this.tasks = this.tasks.slice();
    },

    // Методы формы авторизации
    signInLoginValidation([login, password]) {
      if (!login) {
        this.errors.signIn.login = {
          id: "4",
          type: "login",
          errorText: "Введите логин",
        };
      } else {
        if (this.serverErrors.signIn.login.length > 0) {
          if (this.serverErrors.signIn.login.indexOf(login) >= 0) {
            console.log("Совпадение найдено");
            this.errors.signIn.login = {
              id: "1",
              type: "login",
              errorText: "Пользователь не зарегистрирован!",
            };
          } else {
            this.errors.signIn.login = {
              id: "",
              type: "",
              errorText: "",
            };
          }
        } else if (this.errors.signIn.login.errorText) {
          this.errors.signIn.login = {
            id: "",
            type: "",
            errorText: "",
          };
        }
        if (this.errors.signIn.password.errorText || password) {
          this.signInPasswordValidation([login, password]);
        }
      }
    },
    signInPasswordValidation([login, password]) {
      if (!password) {
        this.errors.signIn.password = {
          id: "5",
          type: "password",
          errorText: "Введите пароль",
        };
      } else {
        if (this.serverErrors.signIn.password.length > 0) {
          if (
            this.serverErrors.signIn.password.find(
              (user) => user.login === login && user.password === password
            )
          ) {
            console.log("Совпадение найдено");
            this.errors.signIn.password = {
              id: "2",
              type: "password",
              errorText: "Неверно введен пароль!",
            };
          } else {
            this.errors.signIn.password = {
              id: "",
              type: "",
              errorText: "",
            };
          }
        } else if (this.errors.signIn.password.errorText) {
          this.errors.signIn.password = {
            id: "",
            type: "",
            errorText: "",
          };
        }
      }
    },
    signUpLoginValidation(login) {
      if (!login) {
        this.errors.signUp.login = {
          id: "6",
          type: "login",
          errorText: "Введите логин",
        };
      } else {
        if (this.serverErrors.signUp.login.length > 0) {
          if (this.serverErrors.signUp.login.indexOf(login) >= 0) {
            console.log("Совпадение найдено");
            this.errors.signUp.login = {
              id: "3",
              type: "login",
              errorText: "Логин уже занят",
            };
          } else {
            this.errors.signUp.login = {
              id: "",
              type: "",
              errorText: "",
            };
          }
        } else if (this.errors.signUp.login.errorText) {
          this.errors.signUp.login = {
            id: "",
            type: "",
            errorText: "",
          };
        }
      }
    },
    signUpPasswordValidation([password, passwordRepeat]) {
      if (!password) {
        this.errors.signUp.password = {
          id: "7",
          type: "password",
          errorText: "Введите пароль",
        };
      } else {
        if (this.errors.signUp.password.errorText) {
          this.errors.signUp.password = {
            id: "",
            type: "",
            errorText: "",
          };
        }
        if (this.errors.signUp.passwordRepeat.errorText || passwordRepeat) {
          this.signUpPasswordRepeatValidation([password, passwordRepeat]);
        }
      }
    },
    signUpPasswordRepeatValidation([password, passwordRepeat]) {
      if (!passwordRepeat) {
        this.errors.signUp.passwordRepeat = {
          id: "8",
          type: "passwordRepeat",
          errorText: "Введите пароль ещё раз",
        };
      } else {
        if (!password) {
          this.signUpPasswordValidation([password, passwordRepeat]);
        } else {
          if (passwordRepeat !== password) {
            this.errors.signUp.passwordRepeat = {
              id: "9",
              type: "passwordRepeat",
              errorText: "Повтор не совпадает с паролем",
            };
          } else if (this.errors.signUp.passwordRepeat.errorText) {
            this.errors.signUp.passwordRepeat = {
              id: "",
              type: "",
              errorText: "",
            };
          }
        }
      }
    },
    signInResponseParsing(response, user) {
      if (response.error) {
        this.signInErrorRecord(response.error, user);
      }
      if (response.user) {
        this.authUser(response.user);
      }
    },
    signInErrorRecord(error, user) {
      if (error.type === "login") {
        this.errors.signIn.login = error;
        this.errors.signIn.password = {};
        this.serverErrors.signIn.login.push(user.login);
      }
      if (error.type === "password") {
        this.errors.signIn.password = error;
        this.errors.signIn.login = {};
        let errorPasswordUser = {
          login: user.login,
          password: user.password,
        };
        this.serverErrors.signIn.password.push(errorPasswordUser);
      }
      this.logGroup("Записана ошибка", error);
    },
    authUserFromModal(user) {
      this.errorsReset();
      this.loggedUser = user;
      this.logGroup(
        "Пользователь авторизован",
        "user.id = " + user.id,
        "user.name = " + user.name
      );
      this.signInModal.hide();
      this.signUpModal.hide();
      this.$emit("auth-user", user);
    },
    signUpResponseParsing(response, user) {
      if (response.error) {
        this.signUpErrorRecord(response.error);
        this.serverErrors.signUp.login.push(user.login);
      }
      if (response.user) {
        this.authUser(response.user);
      }
    },
    signUpErrorRecord(error) {
      if (error.type === "login") {
        this.errors.signUp.login = error;
      }
      this.logGroup("Записана ошибка", error);
    },
    errorsReset() {
      this.errors.signIn.login = this.emptyError;
      this.errors.signIn.password = this.emptyError;
      this.errors.signUp.login = this.emptyError;
      this.errors.signUp.password = this.emptyError;
      this.errors.signUp.passwordRepeat = this.emptyError;
      this.serverErrors.signIn.login = [];
      this.serverErrors.signIn.password = [];
      this.serverErrors.signUp.login = [];
    },
  },

  created() {
    document.body.className = "bg-" + this.themeColors.secondary;
    this.initApp();
  },

  mounted() {},
};
</script>
