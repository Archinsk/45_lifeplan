<template>
  <vb-form-group
    v-if="!buttonMode"
    :additional-classes="
      additionalClasses && additionalClasses.group
        ? additionalClasses.group
        : ''
    "
  >
    <div v-if="title" class="checkbox-group-title font-weight-bolder mb-1">
      {{ title }}
    </div>
    <div v-for="radio of itemsList" :key="radio.id" class="form-check">
      <input
        class="form-check-input"
        type="radio"
        :name="id"
        :id="radio.id"
        :value="radio.value"
        :checked="radio.value === value"
        :disabled="disabled || radio.disabled"
        @change="$emit('change', radio.value)"
      />
      <label v-if="radio.label" class="form-check-label" :for="radio.id">
        {{ radio.label }}
      </label>
    </div>
  </vb-form-group>
  <!--  btn-group-->
  <div v-else class="btn-group-toggle" data-toggle="buttons">
    <div v-if="title" class="checkbox-group-title font-weight-bolder mb-1">
      {{ title }}
    </div>
    <label
      v-for="radio of itemsList"
      :key="radio.id"
      class="btn"
      :class="radio.additionalClasses"
    >
      <input
        type="radio"
        :name="id"
        :id="radio.id"
        :value="radio.value"
        :checked="radio.value === value"
        :disabled="disabled || radio.disabled"
        @change="$emit('change', radio.value)"
      />
      {{ radio.label }}
    </label>
  </div>
</template>

<script>
import VbFormGroup from "./BS46FormGroup";
export default {
  name: "VbRadioGroup",
  components: { VbFormGroup },
  props: {
    id: String,
    title: String,
    itemsList: Array,
    value: String,
    required: Boolean,
    disabled: Boolean,
    additionalClasses: Object,
    buttonMode: Boolean,
  },
};
</script>

<style lang="scss" scoped>
@mixin btn-square {
  &:not(.btn-sm, .btn-lg) {
    width: 2.375rem;
    height: 2.375rem;
  }
  &.btn-sm {
    width: 1.9375rem;
    height: 1.9375rem;
  }
  &.btn-lg {
    width: 3rem;
    height: 3rem;
  }
}
.btn-square {
  @include btn-square;
}

.btn-icon,
.btn-square {
  display: inline-flex;
  justify-content: center;
  align-items: center;

  .icon + * {
    margin-left: 0.5em;
  }
}
</style>
