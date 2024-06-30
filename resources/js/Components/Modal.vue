<script setup lang="ts">
import { onMounted, ref } from "vue";
import { Modal } from "bootstrap";
defineProps({
  title: {
    type: String,
    default: "<<Title goes here>>",
  },
});
let modalEle = ref(null);
let thisModalObj = null;

onMounted(() => {
  thisModalObj = new Modal(modalEle.value, {
    backdrop: "static",
    keyboard: false,
  });
});
function _show() {
  console.log("open modal");
  thisModalObj.show();
}

function _close() {
  console.log("close modal");
  thisModalObj.hide();
}

defineExpose({ show: _show, close: _close });
</script>

<template>
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby=""
    aria-hidden="true"
    ref="modalEle"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
          <button type="button" class="btn-close" @click="_close"></button>
        </div>
        <slot name="body" />
      </div>
    </div>
  </div>
</template>