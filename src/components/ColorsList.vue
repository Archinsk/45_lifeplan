<template>
  <ul class="taskList">
    <ColorsListItem
      v-for="item of listItems"
      :key="
        item.category && item.category.id
          ? item.id + '-' + item.category.id
          : item.id
      "
      :task-item="item"
      :style="categoryButtonStyles"
    />
  </ul>
</template>

<script>
import ColorsListItem from "./ColorsListItem";

export default {
  name: "ColorsList",
  props: ["listItems"],
  components: {
    ColorsListItem
  },
  data() {
    return {
      categoryButtonStyles: {
        backgroundColor: this.taskItem.category.color,
        borderColor: this.taskItem.category.color
      }
    }
  }
};
</script>
