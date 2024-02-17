<!-- Версия 1.01 от 02.11.2023 -->

<template>
  <div
    :class="offcanvasClass"
    :id="id"
    tabindex="-1"
    :aria-labelledby="id + 'Label'"
    aria-hidden="true"
    :data-backdrop="staticBackdrop ? 'static' : ''"
    :data-keyboard="staticBackdrop ? false : true"
  >
    <div :class="modalDialogClass" :style="offcanvasWidth">
      <div :class="modalContentClass">
        <div v-if="header" class="modal-header offcanvas-header">
          <slot v-if="noTitle" name="offcanvas-header"></slot>
          <h5 v-else class="modal-title" :id="id + 'Label'">
            <slot name="offcanvas-header"></slot>
          </h5>
          <button
            v-if="!noCloseButton"
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body offcanvas-body">
          <slot></slot>
        </div>
        <div v-if="footer" class="modal-footer offcanvas-footer">
          <slot name="offcanvas-footer"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from "jquery";

export default {
  name: "VbOffcanvas",
  props: {
    id: String,
    header: Boolean,
    footer: Boolean,
    scrollable: Boolean,
    noTitle: Boolean,
    noCloseButton: Boolean,
    noBackdrop: Boolean,
    noKeyboard: Boolean,
    staticBackdrop: Boolean,
    openedWidth: String,
    theme: String,
    noEffectPoint: String,
    // closedWidth: String,
  },
  data() {
    return {
      backdrop: null,
    };
  },
  computed: {
    offcanvasClass() {
      let offcanvasClass = "modal fade offcanvas offcanvas-start";
      if (this.noEffectPoint) {
        offcanvasClass += " offcanvas-" + this.noEffectPoint;
      }
      return offcanvasClass;
    },
    modalDialogClass: function () {
      let modalDialogClass = "modal-dialog";
      if (this.scrollable) {
        modalDialogClass += " modal-dialog-scrollable";
      }
      if (
        this.expandSize &&
        ["sm", "md", "lg", "xl"].includes(this.expandSize)
      ) {
        modalDialogClass += ` offcanvas-${this.expandSize}`;
      }
      return modalDialogClass;
    },
    modalContentClass() {
      let modalContentClass = "modal-content";
      if (this.theme) {
        modalContentClass += " bg-" + this.theme;
      }
      return modalContentClass;
    },
    offcanvasWidth: function () {
      let offcanvasStyle = {};
      offcanvasStyle.width = this.openedWidth ? this.openedWidth : "15rem";
      return offcanvasStyle;
    },
  },
  methods: {
    toggleBackdropAndOffcanvasVisibility() {
      let offcanvas = document.getElementById(this.id);
      let offcanvasShown = offcanvas.classList.contains("show");
      let backdrop = document.querySelector(".modal-backdrop");
      let backdropShown = false;
      if (backdrop && backdrop.classList.contains("show")) {
        backdropShown = true;
      }
      if (
        (window.innerWidth >= 576 && this.noEffectPoint === "sm") ||
        (window.innerWidth >= 768 && this.noEffectPoint === "md") ||
        (window.innerWidth >= 992 && this.noEffectPoint === "lg") ||
        (window.innerWidth >= 1200 && this.noEffectPoint === "xl")
      ) {
        // Увеличение экрана шире контрольной точки
        if (offcanvasShown) {
          if (document.body?.classList.contains("modal-open")) {
            document.body.classList.remove("modal-open");
            document.body.style = null;
          }
          let timerId = setTimeout(() => {
            // Удаление правого поля, добавляемого слушателем Bootstrap'а
            offcanvas.style.paddingRight = null;
            clearTimeout(timerId);
          }, 0);
          if (backdropShown) {
            this.backdrop = backdrop;
            backdrop.remove();
          }
        } else {
          offcanvas.style.display = "block";
        }
      }

      if (
        (window.innerWidth < 576 && this.noEffectPoint === "sm") ||
        (window.innerWidth < 768 && this.noEffectPoint === "md") ||
        (window.innerWidth < 992 && this.noEffectPoint === "lg") ||
        (window.innerWidth < 1200 && this.noEffectPoint === "xl")
      ) {
        // Уменьшение экрана уже контрольной точки
        if (offcanvasShown) {
          document.body.classList.add("modal-open");
          document.body.style.paddingRight = "17px";
          if (!backdropShown) {
            document.body.append(this.backdrop);
          }
        } else {
          offcanvas.style.display = "none";
        }
      }
    },
  },
  created() {
    window.addEventListener(
      "resize",
      this.toggleBackdropAndOffcanvasVisibility
    );
  },
  mounted() {
    $("#" + this.id)
      .modal({
        show: false,
        backdrop:
          !this.noBackdrop && this.staticBackdrop ? "static" : !this.noBackdrop,
        keyboard: !this.staticBackdrop && !this.noKeyboard,
      })
      .on("show.bs.modal", () => {
        this.$emit("show-modal");
      })
      .on("shown.bs.modal", () => {
        this.$emit("shown-modal");
      })
      .on("hide.bs.modal", () => {
        this.$emit("hide-modal");
      })
      .on("hidden.bs.modal", () => {
        this.$emit("hidden-modal");
      });
  },
};
</script>

<style lang="scss">
/* Переопределение Bootstrap */
.modal.offcanvas {
  &.fade {
    .modal-dialog {
      margin: 0;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      max-width: unset;
      display: flex;
      transition: transform 0.3s ease-in-out;
      transform: translate(-100%, 0);

      &.modal-dialog-scrollable {
        max-height: 100%;

        .modal-content {
          max-height: 100%;
        }
      }

      .modal-content {
        border: none;
        border-radius: unset;
      }
    }
  }

  &.show {
    .modal-dialog {
      transform: none;
    }
  }

  @mixin offcanvas-no-effect {
    opacity: unset;
    position: unset;
    display: unset;
    overflow: unset;
    z-index: unset;

    .modal-dialog {
      position: unset;
      transform: none;
      width: unset !important;

      .modal-content {
        .offcanvas-header {
          display: none;
        }

        .offcanvas-body {
          padding: 0;

          .navbar-nav {
            flex-direction: row;
          }
        }
      }

      &.modal-dialog-scrollable {
        .modal-content {
          overflow: unset;

          .offcanvas-body {
            overflow-y: unset;
          }
        }
      }
    }
  }

  @media (min-width: 576px) {
    &.offcanvas-sm {
      @include offcanvas-no-effect;
    }
  }

  @media (min-width: 768px) {
    &.offcanvas-md {
      @include offcanvas-no-effect;
    }
  }

  @media (min-width: 992px) {
    &.offcanvas-lg {
      @include offcanvas-no-effect;
    }
  }

  @media (min-width: 1200px) {
    &.offcanvas-xl {
      @include offcanvas-no-effect;
    }
  }
}
</style>
