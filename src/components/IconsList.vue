<template>
  <ul class="taskList">
    <IconsListItem
      v-for="item of listItems"
      :key="
        item.category && item.category.id
          ? item.id + '-' + item.category.id
          : item.id
      "
      :task-item="item"
    />
  </ul>
</template>

<script>
import IconsListItem from "./IconsListItem";

export default {
  name: "IconsList",
  props: ["listItems"],
  components: {
    IconsListItem
  },
};
</script>
