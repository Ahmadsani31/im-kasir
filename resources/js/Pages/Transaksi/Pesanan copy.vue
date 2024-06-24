<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Modal from "@/Components/Modal.vue";
import ProdukTambah from "@/Components/Modal/ModalPesanan.vue";
import Swal from "sweetalert2";

import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
  meja: Object,
  produk: Object,
  cart: Object,
  harga: Number,
  pajak: Number,
  total: Number,
  pesanan: Number,
});

const meja_id = ref(props.meja.data.meja_id);
// console.log(meja.data.meja_id);

// const produks = ref([]);
const myChild = ref(null);

const page = usePage();

const Cashier = ref(page.props.auth.user.name);

function formatPrice(value) {
  let val = value / 1;
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatPrice1(e) {
  console.log(e.target.value);
  let val = e.target.value / 1;
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

let thisModal = ref(null);

function showModal(val) {
  thisModal.value.show();
  myChild.value.childMethod(meja_id.value, val);
  //   getProduk(val);
}

function closeModal(val) {
  thisModal.value.close();
}

const deleteCard = (id) => {
  Swal({
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
      router.delete(`/cart/${id}`, {
        preserveScroll: true,
      });
    }
  });
};

const emptyCart = () => {
  Swal({
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
      router.delete(route("cart.destroy"), {
        preserveScroll: true,
      });
    }
  });
};

const jenisPembayaran = [
  { id: "Cash", text: "Cash" },
  { id: "Credit", text: "Kartu Kredit" },
  { id: "Debit", text: "Kartu Debit" },
  { id: "Gopay", text: "Gopay" },
  { id: "Qris", text: "Qris" },
];

// const getProduk = (val) => {
//   axios
//     .post("/produk-all", {
//       id: val,
//     })
//     .then((res) => {
//       produks.value = res.data;
//       console.log(res.data);
//     });
// };
</script>
<template>
  <Head title="Transaksi" />
  <AuthenticatedLayout>
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col">
            <div class="page-header-title">
              <h5 class="m-b-10">Pesanan</h5>
            </div>
          </div>
          <div class="col-auto">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/">Home</a>
              </li>
              <li class="breadcrumb-item" aria-current="page">Pesanan</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h5 class="font-bold mb-0">Produk Makanan</h5>
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
                        <img
                          :src="row.gambar"
                          alt="img"
                          class="img-fluid w-100"
                        />
                        <!-- <div
                          class="position-absolute top-50 start-50 translate-middle"
                        >
                          <button
                            @click="showModal(row.produk_id)"
                            class="btn btn-primary mt-5 text-uppercase"
                          >
                            Pesan
                          </button>
                        </div> -->
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
                              <span class="badge text-bg-info">{{
                                row.jenis
                              }}</span>
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
                            @click="showModal(row.produk_id)"
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
      </div>
      <div class="col-md-4">
        <div class="card dashnum-card dashnum-card-small overflow-hidden">
          <span class="round bg-warning small"></span>
          <span class="round bg-warning big"></span>
          <div class="card-body p-3">
            <h5 class="font-bold mb-0">Pesanan Meja</h5>
            <div class="border rounded p-1 h-100 mt-0">
              <table class="table table-sm text-center">
                <thead>
                  <tr>
                    <th class="p-0">Foto</th>
                    <th class="p-0">Nama</th>
                    <th class="p-0">Harga</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(row, idx) in meja" :key="idx">
                    <th><img :src="row.gambar" alt="img" width="40" /></th>
                    <td>{{ row.nama }}</td>
                    <td>Rp.{{ formatPrice(row.harga) }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="row g-3">
              <div
                class="d-flex align-items-center justify-content-between mb-2"
              >
                <h5 class="font-bold mb-0">Pesanan Makanan</h5>
                <button
                  @click="emptyCart"
                  class="btn btn-sm btn-light-danger d-flex align-items-center gap-2"
                >
                  <i class="ph-duotone ph-trash"></i> Empty Cart
                </button>
              </div>

              <div class="border rounded p-1 h-100 mt-0">
                <table class="table table-sm text-center">
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
                    <tr v-for="(row, idx) in cart.data" :key="idx">
                      <th><img :src="row.gambar" alt="img" width="40" /></th>
                      <td>{{ row.nama_produk }}</td>
                      <td>
                        <div
                          class="btn-group btn-group-sm mb-2 border"
                          role="group"
                        >
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
                            v-model="row.jumlah"
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
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row g-3">
              <form action="">
                <div class="col-12">
                  <div class="invoice-total ms-auto">
                    <div class="row">
                      <div class="col-6">
                        <div class="mb-3">
                          <label class="form-label">Cashier</label>
                          <input
                            type="text"
                            class="form-control"
                            v-model="Cashier"
                            readonly
                          />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="mb-3">
                          <label class="form-label">Costumer</label>
                          <input type="text" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-6">
                        <p class="text-muted mb-1 text-start">Total Pesanan</p>
                      </div>
                      <div class="col-6">
                        <p class="f-w-600 mb-1 text-end">
                          {{ pesanan }} Makanan
                        </p>
                      </div>
                      <div class="col-6">
                        <p class="text-muted mb-1 text-start">Sub Total :</p>
                      </div>
                      <div class="col-6">
                        <p class="f-w-600 mb-1 text-end">
                          Rp. {{ formatPrice(harga) }}
                        </p>
                      </div>
                      <div class="col-6">
                        <p class="text-muted mb-1 text-start">Discount :</p>
                      </div>
                      <div class="col-6">
                        <p class="f-w-600 mb-1 text-end text-success">0.00</p>
                      </div>
                      <div class="col-6">
                        <p class="text-muted mb-1 text-start">Pajak 11% :</p>
                      </div>
                      <div class="col-6">
                        <p class="f-w-600 mb-1 text-end">
                          Rp.{{ formatPrice(pajak) }}
                        </p>
                      </div>
                      <div class="col-6">
                        <p class="f-w-600 mb-1 text-start">Grand Total :</p>
                      </div>
                      <div class="col-6">
                        <p class="f-w-600 mb-1 text-end">
                          Rp.{{ formatPrice(total) }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="col-md-12">
                  <div class="row mb-3">
                    <div class="col-6">
                      <div class="mb-0">
                        <label class="form-label">Jenis Pembayaran</label>
                        <select name="" id="" class="form-control" required>
                          <option value="">Pilih Jenis Pembayaran</option>
                          <option
                            v-for="(kat, index) in jenisPembayaran"
                            :value="kat.id"
                            :key="index"
                          >
                            {{ kat.text }}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-0">
                        <label class="form-label">Bayar</label>
                        <input type="number" class="form-control" required />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row align-items-end justify-content-between g-3">
                    <div class="col-sm-auto btn-page">
                      <button class="btn btn-outline-danger">Batalkan</button>
                      <button type="submit" class="btn btn-primary">
                        Proses Pesanan
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Modal title="Pilih Jumlah Makananan" ref="thisModal">
      <template #body>
        <ProdukTambah ref="myChild" @childToParentModal="closeModal" />
      </template>
    </Modal>
  </AuthenticatedLayout>
</template>