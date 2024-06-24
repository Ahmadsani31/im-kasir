<script setup>
import { router, useForm } from "@inertiajs/vue3";
import { ref, defineEmits } from "vue";
import Swal from "sweetalert2";
// const props = defineProps({
//   produks: Object,
// });

// const nama = props.produks.item;
// console.log(nama);

const emit = defineEmits(["childToParentModal"]);

const produk_id = ref("");
const nama = ref("");

function childMethod(meja_id, val) {
  form.meja_id = meja_id;
  console.log(meja_id);
  getProduk(val);
}

defineExpose({
  childMethod,
});

const props = defineProps({
  dataProduk: Object,
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

function formatPrice(value) {
  let val = value / 1;
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

const dateObj = new Date();
const currentDate =
  dateObj.getDate() + "/" + dateObj.getMonth() + "/" + dateObj.getFullYear();

const jenisPembayaran = [
  { id: "Cash", text: "Cash" },
  { id: "Credit", text: "Kartu Kredit" },
  { id: "Debit", text: "Kartu Debit" },
  { id: "Gopay", text: "Gopay" },
  { id: "Qris", text: "Qris" },
];

const form = useForm({
  methode_bayar: "",
});
const changeMonay = ref(0);

const kembalian = (e) => {
  changeMonay.value = props.dataProduk.total - e.target.value;
  console.log(changeMonay.value);
};
</script>
<template>
  <form @submit.prevent="submit">
    <div class="modal-body">
      <div class="d-flex align-items-center justify-content-between mb-2">
        <h4 class="font-bold mb-0">{{ dataProduk.invoice }}</h4>
        <h4 class="font-bold mb-0">{{ currentDate }}</h4>
      </div>
      <div class="card mb-0">
        <div class="card-body p-3">
          <h5 class="font-bold mb-0">Pesanan Meja</h5>
          <div class="border rounded p-1 h-100 mt-0">
            <table class="table table-sm text-center">
              <thead>
                <tr>
                  <th class="p-0">Foto</th>
                  <th class="p-0">Nama</th>
                  <th class="p-0">Jam</th>
                  <th class="p-0">Harga</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(row, idx) in dataProduk.meja" :key="idx">
                  <th><img :src="row.gambar" alt="img" width="40" /></th>
                  <td>{{ row.nama }}</td>
                  <td>{{ dataProduk.jam }}</td>
                  <td>Rp.{{ formatPrice(row.harga) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card mt-0">
        <div class="card-body p-3">
          <h5 class="font-bold mb-0">Pesanan Makanan</h5>
          <div class="border rounded p-1 h-100 mt-0">
            <table class="table table-sm text-center">
              <thead>
                <tr>
                  <th class="p-0">#</th>
                  <th class="p-0">Nama</th>
                  <th class="p-0">Jumlah</th>
                  <th class="p-0">Harga</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(roww, idxx) in dataProduk.cart" :key="idxx">
                  <th><img :src="roww.gambar" alt="img" width="40" /></th>
                  <td>{{ roww.nama_produk }}</td>
                  <td>
                    {{ roww.jumlah }}
                  </td>
                  <td>Rp.{{ formatPrice(roww.harga) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="row">
          <div class="col-6">
            <p class="text-muted mb-1 text-start">Total Pesanan</p>
          </div>
          <div class="col-6">
            <p class="f-w-600 mb-1 text-end">
              {{ dataProduk.pesanan }} Makanan
            </p>
          </div>
          <div class="col-6">
            <p class="text-muted mb-1 text-start">Sub Total :</p>
          </div>
          <div class="col-6">
            <p class="f-w-600 mb-1 text-end">
              Rp. {{ formatPrice(dataProduk.harga) }}
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
              Rp.{{ formatPrice(dataProduk.pajak) }}
            </p>
          </div>
          <div class="col-6">
            <p class="f-w-600 mb-1 text-start">Grand Total :</p>
          </div>
          <div class="col-6">
            <p class="f-w-600 mb-1 text-end">
              Rp.{{ formatPrice(dataProduk.total) }}
            </p>
          </div>
          <hr />
          <div class="col-6">
            <p class="f-w-600 mb-1 text-start">Kembalian</p>
          </div>
          <div class="col-6">
            <p class="f-w-600 mb-1 text-end">
              Rp.{{ formatPrice(changeMonay) }}
            </p>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label for="mtd_bayar" class="form-label">Jenis Pembayaran</label>
        <select
          id="mtd_bayar"
          class="form-control"
          v-model="form.methode_bayar"
          required
        >
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
      <div class="mb-3">
        <label class="form-label">Bayar</label>
        <input type="number" class="form-control" @keyup="kembalian" required />
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
