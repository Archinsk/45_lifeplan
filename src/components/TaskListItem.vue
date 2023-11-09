<template>
  <li :class="taskClass" @click.self="$emit('toggle-task-status', taskItem)">
    <vb-button
      v-if="taskItem.category && taskItem.category.id"
      :icon="taskItem.category.icon"
      square
      :class="'category-button ' + categoryButtonClass"
      @click="$emit('filter-category')"
    />
    <vb-button
      icon="more_horiz"
      square
      :class="contextMenuButtonClass"
      @click="toggleContextMenu"
    />
    <vb-button
      v-show="contextMenuVisibility"
      icon="close"
      square
      :class="contextMenuButtonClass"
      @click="$emit('delete-task')"
    />
    <vb-button
      v-show="contextMenuVisibility"
      icon="mode"
      square
      :class="contextMenuButtonClass"
    />
    <vb-button
      v-show="contextMenuVisibility"
      icon="info"
      square
      :class="contextMenuButtonClass"
    />
    <!--    :class="'delete-button ' + deleteButtonClass"-->
    <div class="task-text">
      {{ taskItem.task }}
    </div>
  </li>
</template>

<script>
import VbButton from "./universal/Bootstrap_4.6.2/BS46Button";

export default {
  name: "TaskListItem",
  props: ["taskItem", "theme", "lightnessMode"],
  components: {
    VbButton,
  },

  data() {
    return {
      contextMenuVisibility: false,
    };
  },

  computed: {
    taskClass: function () {
      let taskClass = "task mb-1 border";
      if (+this.taskItem.done) {
        taskClass +=
          " border-" +
          this.lightnessMode +
          "-neutral-700 text-" +
          this.lightnessMode +
          "-neutral-600 taskCompleted";
      } else {
        taskClass +=
          " border-" +
          this.lightnessMode +
          "-neutral-500 text-" +
          this.lightnessMode +
          "-neutral-300 bg-" +
          this.theme.info;
      }
      return taskClass;
    },

    categoryButtonClass: function () {
      let categoryClass = "";
      if (this.taskItem.done) {
        categoryClass =
          "bg-" +
          this.lightnessMode +
          "-neutral-700 text-" +
          this.theme.secondary;
      } else {
        categoryClass =
          "bg-" +
          this.lightnessMode +
          "-" +
          this.taskItem.category.color +
          "-primary text-" +
          this.theme.info;
      }
      return categoryClass;
    },

    deleteButtonClass: function () {
      let deleteClass = "";
      if (this.taskItem.done) {
        deleteClass = "text-" + this.lightnessMode + "-neutral-700";
      } else {
        deleteClass = "text-" + this.lightnessMode + "-neutral-500";
      }
      return deleteClass;
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

  // watch: {
  //   taskItem() {
  //     console.log("Наблюдаю")
  //     if (this.taskItem.category && this.taskItem.category.icon) {
  //       this.category.icon = this.taskItem.category.icon;
  //     }
  //   },
  // },
  mounted: function () {
    // console.log("Компонент TaskListItem смонтирован");
  },
};
</script>
