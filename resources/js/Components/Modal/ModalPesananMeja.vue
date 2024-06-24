<script setup>
import { router, useForm } from "@inertiajs/vue3";
import { ref, defineEmits } from "vue";
// const props = defineProps({
//   produks: Object,
// });

// const nama = props.produks.item;
// console.log(nama);

const emit = defineEmits(["childToParentModal"]);

const produk_id = ref("");
const nama = ref("");

function decreaseValue() {
  if (form.jumlah > 0) {
    form.jumlah--;
  }
}

function increaseValue() {
  form.jumlah++;
}

function childMethod(meja_id, val) {
  form.meja_id = meja_id;
  console.log(meja_id);
  getProduk(val);
}

defineExpose({
  childMethod,
});

const form = useForm({
  meja_id: "",
  produk_id: produk_id,
  harga: "",
  jumlah: 1,
});

const getProduk = (val) => {
  axios
    .post("/produk-all", {
      id: val,
    })
    .then((res) => {
      nama.value = res.data.item.nama;
      form.produk_id = res.data.item.produk_id;
      form.harga = res.data.item.harga;
      console.log(res.data);
    });
};

function submit() {
  router.post(route("transaksi.cart"), form, {
    preserveState: true,
    preserveScroll: true,
    onSuccess: (page) => {
      //   thisModal.value.close();
      Toast.fire({
        icon: "success",
        title: "Pesanan Berhasil Ditambahkan",
      });
      emit("childToParentModal");
    },
    onProgress: (progress) => {
      console.log(progress);
    },
  });
}
</script>
<template>
  <form @submit.prevent="submit">
    <div class="modal-body">
      <h3 class="text-center mb-4">{{ nama ?? "" }}</h3>
      <div class="mb-3 row">
        <label class="col-form-label col-lg-3 col-sm-12 text-lg-end"
          >Jumlah <span class="text-danger">*</span></label
        >
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="btn-group btn-group-sm mb-2 border" role="group">
            <button
              type="button"
              @click="decreaseValue(1)"
              class="btn btn-link-dark"
            >
              <i class="ti ti-minus"></i>
            </button>
            <input
              class="text-center border-0 m-0 form-control rounded-0 shadow-none"
              type="text"
              v-model="form.jumlah"
              required
            />
            <button
              type="button"
              @click="increaseValue(1)"
              class="btn btn-link-dark"
            >
              <i class="ti ti-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        Close
      </button>
      <!-- <button
        type="button"
        @click="($event) => $emit('do-stm')"
        class="btn btn-info"
      >
        Simpan
      </button> -->
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
</template>
