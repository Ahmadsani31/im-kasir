<script setup>
import { router, useForm } from "@inertiajs/vue3";
import { ref, defineEmits, computed, reactive } from "vue";
import Swal from "sweetalert2";

const emit = defineEmits(["childToParentModal", "setLoading", "unsetLoading"]);

const totalDurasi = ref(localStorage.jamMeja);

const props = defineProps({
  dataProduk: Object,
  cartPesanan: Object,
  cartMeja: Object,
  invoice: String,
});

localStorage.invoice = props.invoice;

console.log(localStorage.invoice);

const dataPesanan = props.cartPesanan.data;

const state = reactive({
  totalHargaMeja: computed(
    () => parseInt(props.cartMeja.data.harga) * parseInt(localStorage.jamMeja)
  ),
  hargaMakanan: computed(() =>
    dataPesanan.reduce((acc, item) => acc + item.harga * item.jumlah, 0)
  ),
  jumlahMakanan: computed(() =>
    dataPesanan.reduce((acc, item) => acc + item.jumlah, 0)
  ),
  subTotal: computed(
    () => parseInt(state.totalHargaMeja) + parseInt(state.hargaMakanan)
  ),
  pajak: computed(() => parseInt(state.subTotal) * 0.11),
  grandTotal: computed(() => parseInt(state.subTotal) + parseInt(state.pajak)),
});

function submit() {
  emit("setLoading");
  if (form.bayar < state.grandTotal) {
    emit("unsetLoading");
    return new Swal({
      title: "Perhatian",
      text: "Uang Pembayaran Tidak Cukup",
      icon: "warning",
      showConfirmButton: false,
      timer: 1500,
    });
    return false;
  }
  router.post(route("transaksi.save"), form, {
    preserveState: true,
    preserveScroll: true,
    onSuccess: (page) => {
      //   thisModal.value.close();
      emit("unsetLoading");
      console.log(page);
      console.log(page.props.flash.items.uuid);

      if (page.props.flash.status == false) {
        return new Swal({
          title: "Perhatian!",
          text: page.props.flash.message,
          icon: "error",
          showConfirmButton: false,
          timer: 2500,
        });
      } else {
        emit("childToParentModal");

        Toast.fire({
          icon: "success",
          title: "Pesanan Berhasil Ditambahkan",
        });
        open(route("transaksi.print", page.props.flash.items.uuid));

        router.visit(route("transaksi"), { preserveScroll: false });
      }

      console.log(localStorage.invoice);
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

const clock = reactive({
  jam: new Date(),
  currentDate: computed(
    () =>
      clock.jam.getDate() +
      "/" +
      clock.jam.getMonth() +
      "/" +
      clock.jam.getFullYear()
  ),
});

const jenisPembayaran = [
  { id: "Cash", text: "Cash" },
  { id: "Credit", text: "Kartu Kredit" },
  { id: "Debit", text: "Kartu Debit" },
  { id: "Gopay", text: "Gopay" },
  { id: "Qris", text: "Qris" },
];
const changeMonay = ref(0);

const kembalian = (e) => {
  changeMonay.value = e.target.value - state.grandTotal;
  console.log(changeMonay.value);
};

const form = useForm({
  methode_bayar: "",
  costumer: "",
  bayar: 0,
  jam: localStorage.jamMeja,
  meja_id: props.cartMeja.data.meja_id,
  invoice: props.invoice,
});
</script>
<template>
  <form @submit.prevent="submit">
    <div class="modal-body">
      <div class="d-flex align-items-center justify-content-between mb-2">
        <h4 class="font-bold mb-0">{{ props.invoice }}</h4>
        <h4 class="font-bold mb-0">{{ clock.currentDate }}</h4>
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
                <tr v-for="(row, idx) in cartMeja" :key="idx">
                  <th><img :src="row.gambar" alt="img" width="40" /></th>
                  <td>{{ row.nama }}</td>
                  <td>{{ totalDurasi }}</td>
                  <td>Rp.{{ formatPrice(row.harga) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div v-if="cartPesanan.data.length > 0" class="card m-0">
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
                <tr v-for="(roww, idxx) in cartPesanan.data" :key="idxx">
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
            <p class="f-w-600 mb-1 text-end">{{ state.jumlahMakanan }}</p>
          </div>
          <div class="col-6">
            <p class="text-muted mb-1 text-start">Sub Total :</p>
          </div>
          <div class="col-6">
            <p class="f-w-600 mb-1 text-end">
              Rp. {{ formatPrice(state.subTotal) }}
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
              Rp.{{ formatPrice(state.pajak) }}
            </p>
          </div>
          <div class="col-6">
            <p class="f-w-600 mb-1 text-start">Grand Total :</p>
          </div>
          <div class="col-6">
            <p class="f-w-600 mb-1 text-end">
              Rp.{{ formatPrice(state.grandTotal) }}
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
        <label class="form-label">Custumer</label>
        <input
          type="text"
          class="form-control"
          v-model.trim="form.costumer"
          @input="form.costumer = $event.target.value.toUpperCase()"
          placeholder="Tulis nama custumer"
          required
        />
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
        <input
          type="number"
          class="form-control"
          v-model="form.bayar"
          @keyup="kembalian"
          required
        />
      </div>
    </div>

    <div class="modal-footer">
      <button
        type="button"
        class="btn btn-secondary"
        @click="$emit('childToParentModal')"
      >
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
<style>
.swal2-container {
  z-index: 10000;
}
</style>