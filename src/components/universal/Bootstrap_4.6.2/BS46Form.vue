<template>
  <form :id="id">
    <fieldset>
      <legend v-if="legend">{{ legend }}</legend>
      <div :class="tightGutters ? 'form-row' : 'row'">
        <template v-for="formItem of formItemsList">
          <vb-input
            v-if="
              formItem.type === 'input' &&
              formItem.subtype !== 'file' &&
              formItem.subtype !== 'checkbox'
            "
            :key="formItem.id"
            :id="formItem.id"
            :label="formItem.label"
            :type="formItem.subtype"
            :value="formItem.value"
            :required="required || formItem.required"
            :disabled="disabled || formItem.disabled"
            :readonly="formItem.readonly"
            :additional-classes="formItem.additionalClasses"
            :horizontal="horizontal || formItem.horizontal"
            :placeholder="formItem.placeholder"
            :focusable="formItem.focusable"
            :flatpickr="formItem.flatpickr"
            @input="
              $emit('change-form', {
                formItem,
                newValue: $event,
              })
            "
            @focus="$emit('focus', formItem.id)"
          />
          <vb-textarea
            v-if="formItem.type === 'textarea'"
            :key="formItem.id"
            :id="formItem.id"
            :label="formItem.label"
            :value="formItem.value"
            :required="required || formItem.required"
            :disabled="disabled || formItem.disabled"
            :readonly="formItem.readonly"
            :additional-classes="formItem.additionalClasses"
            :horizontal="horizontal || formItem.horizontal"
            :placeholder="formItem.placeholder"
            :rows="formItem.rows"
            @input="$emit('change-form', { formItem, newValue: $event })"
          />
          <vb-select
            v-if="formItem.type === 'select'"
            :key="formItem.id"
            :id="formItem.id"
            :label="formItem.label"
            :items-list="formItem.itemsList"
            :values="formItem.values"
            :required="required || formItem.required"
            :disabled="disabled || formItem.disabled"
            :additional-classes="formItem.additionalClasses"
            :horizontal="horizontal || formItem.horizontal"
            :default-value-label="formItem.defaultValueLabel"
            :multiple="formItem.multiple"
            :badges="formItem.badges"
            @change="$emit('change-form', { formItem, newValue: $event })"
          />
          <vb-checkbox
            v-if="formItem.type === 'input' && formItem.subtype === 'checkbox'"
            :key="formItem.id"
            :id="formItem.id"
            :label="formItem.label"
            :value="formItem.value"
            :required="required || formItem.required"
            :disabled="disabled || formItem.disabled"
            :additional-classes="formItem.additionalClasses"
            :switch-mode="formItem.switchMode"
            @change="$emit('change-form', { formItem, newValue: $event })"
          />
          <vb-date-range
            v-if="formItem.type === 'range'"
            :key="formItem.id"
            :id="formItem.id"
            :labels="formItem.labels"
            :type="formItem.subtype"
            :required="required || formItem.required"
            :disabled="disabled || formItem.disabled"
            :readonly="formItem.readonly"
            :additional-classes="formItem.additionalClasses"
            :horizontal="horizontal || formItem.horizontal"
            :values="formItem.values"
            @input="
              $emit('change-form', {
                formItem,
                newValue: $event,
              })
            "
          />
          <vb-checkboxes-group
            v-if="formItem.type === 'checkboxesGroup'"
            :key="formItem.id"
            :id="formItem.id"
            :title="formItem.title"
            :items-list="formItem.itemsList"
            :values="formItem.values"
            :required="required || formItem.required"
            :disabled="disabled || formItem.disabled"
            :additional-classes="formItem.additionalClasses"
            :switch-mode="formItem.switchMode"
            @change="$emit('change-form', { formItem, newValue: $event })"
          />
          <vb-radio-group
            v-if="formItem.type === 'radioGroup'"
            :key="formItem.id"
            :id="formItem.id"
            :title="formItem.title"
            :items-list="formItem.itemsList"
            :value="formItem.value"
            :required="required || formItem.required"
            :disabled="disabled || formItem.disabled"
            :additional-classes="formItem.additionalClasses"
            @change="$emit('change-form', { formItem, newValue: $event })"
          />
        </template>
      </div>
    </fieldset>
  </form>
</template>

<script>
import VbInput from "./Form_components/BS46Input";
import VbSelect from "./Form_components/BS46Select";
import VbCheckbox from "./Form_components/BS46Checkbox";
import VbDateRange from "./Form_components/BS46DateRange";
import VbTextarea from "./Form_components/BS46Textarea";
import VbCheckboxesGroup from "./Form_components/BS46CheckboxesGroup";
import VbRadioGroup from "./Form_components/BS46RadioGroup";
export default {
  name: "VbForm",
  components: {
    VbRadioGroup,
    VbCheckboxesGroup,
    VbDateRange,
    VbTextarea,
    VbInput,
    VbSelect,
    VbCheckbox,
  },
  props: {
    id: String,
    legend: String,
    formItemsList: Array,
    required: Boolean,
    disabled: Boolean,
    horizontal: Boolean,
    validity: Boolean,
    tightGutters: Boolean,
  },
};
</script>
