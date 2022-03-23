<template>
  <ul :id="id" class="taskList">
    <template v-for="(item, index) of listItems">
      <div
        v-if="
          id === 'tasksTodo' &&
          (index === 0 ||
            startOfDayLocalinMs(item.creationDate * 1000) !==
              startOfDayLocalinMs(listItems[index - 1].creationDate * 1000))
        "
        :key="item.id + '-todo'"
        :class="
          'badge bg-' +
          lightnessMode +
          '-neutral-600 text-' +
          lightnessMode +
          '-neutral-900'
        "
      >
        {{ (item.creationDate * 1000) | date("date") }}
      </div>
      <div
        v-if="
          id === 'tasksDone' &&
          (index === 0 ||
            startOfDayLocalinMs(item.completionDate * 1000) !==
              startOfDayLocalinMs(listItems[index - 1].completionDate * 1000))
        "
        :key="item.id + '-done'"
        :class="
          'badge bg-' +
          lightnessMode +
          '-neutral-600 text-' +
          lightnessMode +
          '-neutral-900'
        "
      >
        {{ (item.completionDate * 1000) | date("date") }}
      </div>
      <TaskListItem
        :key="
          item.category && item.category.id
            ? item.id + '-' + item.category.id
            : item.id
        "
        :task-item="item"
        :theme="theme"
        :lightness-mode="lightnessMode"
        @toggle-task-status="$emit('toggle-task-status', $event)"
        @filter-category="$emit('filter-category', item.category.id)"
        @delete-task="$emit('delete-task', item.id)"
      />
    </template>
  </ul>
</template>

<script>
import TaskListItem from "@/components/TaskListItem";

export default {
  name: "TaskList",
  props: ["listItems", "id", "theme", "lightnessMode"],
  components: {
    TaskListItem,
  },
  methods: {
    timeStampWithTimezoneOffset(timeStampDb) {
      return timeStampDb - new Date().getTimezoneOffset() * 60000;
    },
    startOfDayGMTinMs(timeStampDb) {
      return (
        this.timeStampWithTimezoneOffset(timeStampDb) -
        (this.timeStampWithTimezoneOffset(timeStampDb) % 86400000)
      );
    },
    startOfDayLocalinMs(timeStampDb) {
      return (
        this.startOfDayGMTinMs(timeStampDb) +
        new Date().getTimezoneOffset() * 60000
      );
    },
  },

  mounted() {
    console.log("Компонент TaskList смонтирован");
  },
};
</script>
