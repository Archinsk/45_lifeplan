<!-- Версия 1.01 от 02.11.2023 -->

<template>
  <vb-button-link
    v-if="tag === 'a'"
    href="#"
    role="button"
    class="btn-modal"
    :theme="theme"
    :size="size"
    :block="block"
    :square="square"
    :icon="icon"
    :without-btn-class="withoutBtnClass"
    :additional-classes="additionalClasses"
    data-toggle="modal"
    :data-target="'#' + targetId"
    @click="$emit('click')"
  >
    <slot></slot>
  </vb-button-link>
  <vb-button
    v-else
    class="btn-modal"
    type="button"
    :theme="theme"
    :size="size"
    :block="block"
    :square="square"
    :icon="icon"
    :badge="badge"
    :additional-classes="additionalClasses"
    data-toggle="modal"
    :data-target="'#' + targetId"
    @click="$emit('click')"
  >
    <slot></slot>
  </vb-button>
</template>

<script>
import VbButton from "./BS46Button";
import VbButtonLink from "./BS46ButtonLink";
export default {
  name: "VbModalButton",
  components: { VbButtonLink, VbButton },
  props: {
    targetId: String,
    tag: String,
    theme: String,
    size: String,
    block: Boolean,
    square: Boolean,
    icon: [Object, String],
    badge: Object,
    additionalClasses: String,
    withoutBtnClass: Boolean,
  },
};
</script>
