<script>
import { router } from "@inertiajs/vue3";
import { computed, reactive, ref } from "vue";

import Swal from "sweetalert2";

export default {
  name: "CardPesanan",
  components: {},
  emits: ["setLoading", "unsetLoading"],
  props: {
    cart: Object,
    pesanan: Number,
    totalHgr: Number,
  },
  data() {
    const state = reactive({
      hargaMakanan: computed(() =>
        this.cart.data.reduce((acc, item) => acc + item.harga * item.jumlah, 0)
      ),
      jumlahMakanan: computed(() =>
        this.cart.data.reduce((acc, item) => acc + item.jumlah, 0)
      ),
    });
    return {
      jam: localStorage.jamMeja,
      jumlah: 0,
      totHarga: 0,
      state,
    };
  },
  methods: {
    formatPrice(value) {
      let val = value / 1;
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    decreaseValue(id) {
      this.$emit("setLoading");
      router.post(
        route("cart.decrease"),
        {
          cart_id: id,
        },
        {
          preserveState: true,
          preserveScroll: true,
          onSuccess: (page) => {
            //   thisModal.value.close();
            this.$emit("unsetLoading");
            Toast.fire({
              icon: "success",
              title: "Berhasil Update Cart",
            });
          },
        }
      );
    },
    increaseValue(id) {
      this.$emit("setLoading");
      router.post(
        route("cart.increase"),
        {
          cart_id: id,
        },
        {
          preserveState: true,
          preserveScroll: true,
          onSuccess: (page) => {
            //   thisModal.value.close();
            this.$emit("unsetLoading");
            Toast.fire({
              icon: "success",
              title: "Berhasil Update Cart",
            });
          },
        }
      );
    },
    deleteCard(id) {
      return new Swal({
        title: "Perhatian!",
        text: "Kamu Yakin Ingin Menghapus Pesanan ini?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Tidak",
        confirmButtonText: "Iya",
        customClass: {
          cancelButton: "order-1 right-gap",
          confirmButton: "order-2",
        },
      }).then((result) => {
        if (result.isConfirmed) {
          this.$emit("setLoading");

          router.delete(`/cart/${id}/delete`, {
            preserveScroll: true,
            onSuccess: (page) => {
              console.log(page);
              //   thisModal.value.close();
              this.$emit("unsetLoading");
              Toast.fire({
                icon: "success",
                title: "Pesanan Berhasil Dihapus",
              });
            },
          });
        }
      });
    },
    emptyCart() {
      return new Swal({
        title: "Perhatian!",
        text: "Kamu Yakin Ingin Menghapus Semua Pesanan?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Tidak",
        confirmButtonText: "Iya",
        customClass: {
          cancelButton: "order-1 right-gap",
          confirmButton: "order-2",
        },
      }).then((result) => {
        if (result.isConfirmed) {
          this.$emit("setLoading");

          router.delete(route("cart.destroy"), {
            preserveScroll: true,
            onSuccess: (page) => {
              console.log(page);
              //   thisModal.value.close();
              this.$emit("unsetLoading");
              Toast.fire({
                icon: "success",
                title: "Semua Pesanan Berhasil Dihapus",
              });
            },
          });
        }
      });
    },
  },
};

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  },
});
</script>
<template>
  <div class="card">
    <div class="card-body">
      <div class="row g-3">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <h5 class="font-bold mb-0">Pesanan Makanan</h5>
          <button
            @click="emptyCart"
            class="btn btn-sm btn-light-danger d-flex align-items-center gap-2"
          >
            <i class="ph-duotone ph-trash"></i> Empty Cart
          </button>
        </div>

        <div
          class="border rounded p-1 h-100 mt-0"
          style="max-height: 350px; overflow-x: hidden"
        >
          <table class="table table-sm text-center mb-0">
            <thead>
              <tr>
                <th class="p-0">#</th>
                <th class="p-0">Nama</th>
                <th class="p-0">Jumlah</th>
                <th class="p-0">Harga</th>
                <th class="p-0">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-if="cart.data.length > 0"
                v-for="(row, idx) in cart.data"
                :key="idx"
              >
                <th><img :src="row.gambar" alt="img" width="40" /></th>
                <td>{{ row.nama_produk }}</td>
                <td>
                  <div class="btn-group btn-group-sm border" role="group">
                    <button
                      type="button"
                      @click="decreaseValue(row.cart_id)"
                      class="btn btn-link-dark"
                    >
                      <i class="ti ti-minus"></i>
                    </button>
                    <input
                      class="wid-35 text-center border-0 m-0 form-control rounded-0 shadow-none"
                      type="text"
                      v-model="row.jumlah"
                      required
                    />
                    <button
                      type="button"
                      @click="increaseValue(row.cart_id)"
                      class="btn btn-link-dark"
                    >
                      <i class="ti ti-plus"></i>
                    </button>
                  </div>
                </td>
                <td>Rp.{{ formatPrice(row.harga) }}</td>
                <td>
                  <button
                    class="avtar avtar-s btn-link-danger"
                    @click="deleteCard(row.cart_id)"
                  >
                    <i class="ph-duotone ph-trash"></i>
                  </button>
                </td>
              </tr>
              <tr v-else>
                <td colspan="5" class="text-center">pesanan makanan kosong</td>
              </tr>
            </tbody>
          </table>
        </div>
        <table v-if="state.jumlahMakanan">
          <thead>
            <tr>
              <th style="text-align: end">Jumlah</th>
              <th class="text-center">{{ state.jumlahMakanan }}</th>
            </tr>
            <tr>
              <th style="text-align: end">Total Harga</th>
              <th class="text-center">
                Rp.{{ formatPrice(state.hargaMakanan) }}
              </th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</template>