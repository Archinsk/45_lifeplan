<template>
  <div
    class="modal fade"
    :id="id"
    :ref="refModal"
    aria-hidden="true"
    aria-labelledby="signInFormModalLabel"
    tabindex="-1"
  >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" :id="id + 'Label'">{{ title }}</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <slot></slot>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-outline-primary"
            data-bs-toggle="modal"
          >
            Отмена
          </button>
          <button type="button" class="btn btn-primary" :class="{disabled: okDisabled}" @click="$emit('ok-action')">{{ okButtonTitle }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CategoriesModal",

  props: ["id", "title", "okButtonTitle", "okDisabled", "refModal"],

  data() {
    return {
      user: {
        login: "",
        password: "",
      },
      passwordHidden: true,
    };
  },
};
</script>
