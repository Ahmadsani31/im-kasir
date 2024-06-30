
<script>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

import Swal from "sweetalert2";

export default {
  name: "CardMakanan",
  components: {},
  emits: ["setLoading", "unsetLoading"],
  props: {
    produk: Object,
  },
  data() {
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
    return { Toast };
  },
  methods: {
    formatPrice(value) {
      let val = value / 1;
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    addCart(id) {
      this.$emit("setLoading");
      router.post(
        route("cart.add"),
        {
          produk_id: id,
        },
        {
          preserveState: true,
          preserveScroll: true,
          onSuccess: (page) => {
            console.log(page);
            //   thisModal.value.close();
            this.$emit("unsetLoading");
            this.Toast.fire({
              icon: "success",
              title: "Pesanan Berhasil Ditambahkan",
            });
          },
        }
      );
    },
  },
};
</script>
<template>
  <div class="card">
    <div class="card-header pb-3">
      <h5 class="font-bold">Produk Makanan</h5>
      <input
        type="seacrh"
        class="form-control mt-2"
        placeholder="Tulis nama makanan/minuman"
      />
    </div>
    <div class="card-body pt-3">
      <div
        class="border rounded p-1 mt-0"
        style="height: 600px; overflow-x: hidden"
      >
        <div class="row">
          <div
            class="col-sm-6 col-lg-4 col-xxl-3"
            v-for="(row, i) in produk.data"
            :key="i"
          >
            <div class="card border">
              <div class="card-body p-2">
                <div class="position-relative">
                  <img :src="row.gambar" alt="img" class="img-fluid w-100" />
                  <div class="position-absolute top-0 end-0 p-2">
                    <span class="badge text-bg-info text-uppercase"
                      >Available</span
                    >
                  </div>
                </div>
                <ul class="list-group list-group-flush my-2">
                  <li class="list-group-item px-0 py-2">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1 me-2">
                        <h6 class="mb-1">{{ row.nama }}</h6>
                      </div>
                      <div class="flex-shrink-0">
                        <span class="badge text-bg-info">{{ row.jenis }}</span>
                      </div>
                    </div>
                  </li>
                  <div
                    class="d-flex align-items-center justify-content-between mt-3"
                  >
                    <h4 class="mb-0">
                      <b> Rp.{{ formatPrice(row.harga) }}</b>
                    </h4>
                    <button
                      @click="addCart(row.produk_id)"
                      class="btn btn-primary text-uppercase"
                    >
                      <i class="ti ti-shopping-cart"></i>
                    </button>
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>