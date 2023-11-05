<!-- Версия 1.01 от 02.11.2023 -->

<template>
  <a :href="href" :class="btnClass" @click="$emit('click')">
    <vb-icon
      v-if="icon"
      :name="typeof icon === 'string' ? icon : icon.name"
      :format="icon.format"
      :type="icon.type"
    />
    <span v-if="!(icon && square)">
      <slot></slot>
    </span>
  </a>
</template>

<script>
import VbIcon from "./BS46Icon";
export default {
  name: "VbButtonLink",
  components: { VbIcon },
  props: {
    href: String,
    theme: String,
    size: String,
    block: Boolean,
    square: Boolean,
    icon: [Object, String],
    additionalClasses: String,
    withoutBtnClass: Boolean,
  },
  computed: {
    btnClass() {
      let btnClass = "";
      if (!this.withoutBtnClass) {
        btnClass += "btn";
      }
      if (this.theme) {
        btnClass += ` btn-${this.theme}`;
      }
      if (this.size && ["sm", "lg"].includes(this.size)) {
        btnClass += ` btn-${this.size}`;
      }
      if (this.block) {
        btnClass += " btn-block";
      }
      if (this.square) {
        btnClass += " btn-square";
      }
      if (this.icon) {
        btnClass += " btn-icon";
      }
      if (this.additionalClasses) {
        btnClass += ` ${this.additionalClasses}`;
      }
      return btnClass;
    },
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

@mixin btn-square-on-point {
  .icon + * {
    display: none;
  }
}

@media (min-width: 576px) {
  .btn-square-sm {
    @include btn-square;
    @include btn-square-on-point;
  }
}

@media (min-width: 768px) {
  .btn-square-md {
    @include btn-square;
    @include btn-square-on-point;
  }
}

@media (min-width: 992px) {
  .btn-square-lg {
    @include btn-square;
    @include btn-square-on-point;
  }
}

@media (min-width: 1200px) {
  .btn-square-xl {
    @include btn-square;
    @include btn-square-on-point;
  }
}
</style>
