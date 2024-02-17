<template>
  <div :class="rangeClass">
    <div class="row">
      <vb-input
        :id="id + '-start'"
        :label="labels ? labels[0] : ''"
        :type="type"
        :value="values ? values[0] : ''"
        :required="required"
        :disabled="disabled"
        :readonly="readonly"
        :additional-classes="additionalClasses"
        :horizontal="horizontal"
        @input="$emit('input', [$event, values[1] ? values[1] : ''])"
      />
      <vb-input
        :id="id + 'finish'"
        :label="labels ? labels[1] : ''"
        :type="type"
        :value="values ? values[1] : ''"
        :required="required"
        :disabled="disabled"
        :readonly="readonly"
        :additional-classes="additionalClasses"
        :horizontal="horizontal"
        @input="$emit('input', [values[0] ? values[0] : '', $event])"
      />
    </div>
  </div>
</template>

<script>
import VbInput from "./BS46Input";
export default {
  name: "VbDateRange",
  components: { VbInput },
  props: {
    id: String,
    labels: Array,
    type: String,
    required: Boolean,
    disabled: Boolean,
    readonly: Boolean,
    additionalClasses: Object,
    horizontal: Boolean,
    values: Array,
  },
  computed: {
    // Работает неправильно, переделать!
    rangeClass: function () {
      let rangeClass =
        "form-group d-flex flex-column justify-content-end mb-0 col";
      if (this.additionalClasses?.group) {
        rangeClass += "-" + this.additionalClasses.group * 2;
      }
      return rangeClass;
    },
  },
};
</script>
