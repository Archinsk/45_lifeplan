<template>
  <vb-form-group
    :additional-classes="
      additionalClasses && additionalClasses.group
        ? additionalClasses.group
        : ''
    "
  >
    <div v-if="title" class="checkbox-group-title font-weight-bolder mb-1">
      {{ title }}
    </div>
    <vb-checkbox
      v-for="checkbox of itemsList"
      :key="checkbox.id"
      :id="checkbox.id"
      :label="checkbox.label"
      :value="values.includes(checkbox.id)"
      :required="required || checkbox.required"
      :disabled="disabled || checkbox.disabled"
      :additional-classes="additionalClasses"
      :switch-mode="switchMode || checkbox.switchMode"
      grouped
      @change="changeValues(checkbox.id, $event)"
    />
  </vb-form-group>
</template>

<script>
import VbCheckbox from "./BS46Checkbox";
import VbFormGroup from "./BS46FormGroup";
export default {
  name: "VbCheckboxesGroup",
  components: { VbFormGroup, VbCheckbox },
  props: {
    id: String,
    title: String,
    itemsList: Array,
    values: Array,
    required: Boolean,
    disabled: Boolean,
    additionalClasses: Object,
    switchMode: Boolean,
  },
  methods: {
    changeValues(itemId, itemValue) {
      let newValues = this.values.slice();
      if (itemValue && !newValues.includes(itemId)) {
        newValues.push(itemId);
      }
      if (!itemValue && newValues.includes(itemId)) {
        newValues = newValues.filter((item) => item !== itemId);
      }
      this.$emit("change", newValues);
    },
  },
};
</script>
