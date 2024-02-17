<template>
  <vb-form-group
    v-if="!grouped"
    :additional-classes="
      additionalClasses && additionalClasses.group
        ? additionalClasses.group
        : ''
    "
  >
    <div :class="wrapperClass">
      <input
        type="checkbox"
        :class="fieldClass"
        :id="id"
        :checked="value"
        :required="required"
        :disabled="disabled"
        v-model="inputValue"
        @change="$emit('change', inputValue)"
      />
      <label v-if="label" :class="labelClass" :for="id"
        >{{ label }} <span v-if="required" class="text-danger">*</span></label
      >
    </div>
  </vb-form-group>
  <div v-else :class="wrapperClass">
    <input
      type="checkbox"
      :class="fieldClass"
      :id="id"
      :checked="value"
      :required="required"
      :disabled="disabled"
      v-model="inputValue"
      @change="$emit('change', inputValue)"
    />
    <label v-if="label" :class="labelClass" :for="id"
      >{{ label }} <span v-if="required" class="text-danger">*</span></label
    >
  </div>
</template>

<script>
import VbFormGroup from "./BS46FormGroup";
export default {
  name: "VbCheckbox",
  components: { VbFormGroup },
  props: {
    id: String,
    label: String,
    value: Boolean,
    required: Boolean,
    disabled: Boolean,
    additionalClasses: Object,
    switchMode: Boolean,
    grouped: Boolean,
  },
  data() {
    return {
      inputValue: false,
    };
  },
  computed: {
    wrapperClass() {
      return this.switchMode ? "custom-control custom-switch" : "form-check";
    },
    fieldClass() {
      return this.switchMode ? "custom-control-input" : "form-check-input";
    },
    labelClass() {
      return this.switchMode ? "custom-control-label" : "form-check-label";
    },
  },
  created() {
    this.inputValue = this.value;
  },
  watch: {
    value: function () {
      this.inputValue = this.value;
    },
  },
};
</script>
