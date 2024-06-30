<script setup>
import { router, useForm } from "@inertiajs/vue3";
import { ref, defineEmits, computed, reactive, onMounted } from "vue";
import Swal from "sweetalert2";

const emit = defineEmits(["childToParentModal"]);

const props = defineProps({
  transaksiuuid: String,
});

const invoice = ref(null);
const currentDate = ref(null);
const cartMeja = ref(Object);
const cartPesanan = ref(Object);
const cashier_nama = ref(null);
const costumer_nama = ref(null);
const metode_bayar = ref(null);
const jumlahMakanan = ref(0);
const subTotal = ref(0);
const pajak = ref(0);
const grandTotal = ref(0);
const bayar = ref(0);
const kembalian = ref(0);
const transaksi_uuid = ref(null);

onMounted(() => {
  loadTransaksi();
});

const loadTransaksi = async () => {
  console.log(props.transaksiuuid);
  await axios
    .post("/laporan/transaksi", {
      transaksiuuid: props.transaksiuuid,
    })
    .then(function (response) {
      console.log(response.data);
      invoice.value = response.data.items.invoice;
      currentDate.value = response.data.items.tanggal;
      currentDate.value = response.data.items.tanggal;
      cartMeja.value = response.data.items.dataMeja;
      cartPesanan.value = response.data.items.makanan;
      jumlahMakanan.value = response.data.items.totalMakanan;
      subTotal.value = response.data.items.sub_harga;
      pajak.value = response.data.items.pajak;
      grandTotal.value = response.data.items.total_harga;
      bayar.value = response.data.items.bayar;
      kembalian.value = response.data.items.kembalian;
      cashier_nama.value = response.data.items.cashier_nama;
      costumer_nama.value = response.data.items.costumer_nama;
      metode_bayar.value = response.data.items.metode_bayar;
      transaksi_uuid.value = response.data.items.transaksi_uuid;
    })
    .catch(function (error) {
      console.log(error);
    });
};

function formatPrice(value) {
  let val = value / 1;
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function print(raw) {
  // console.log(raw.transaksi_uuid);
  open(route("transaksi.print", transaksi_uuid.value));
}
</script>
<template>
  <div class="modal-body">
    <div class="d-flex align-items-center justify-content-between mb-2">
      <h4 class="font-bold mb-0">{{ invoice }}</h4>
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
              <tr v-for="(row, idx) in cartMeja" :key="idx">
                <th><img :src="row.gambar" alt="img" width="40" /></th>
                <td>{{ row.nama }}</td>
                <td>{{ row.durasi }}</td>
                <td>Rp.{{ formatPrice(row.harga) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div v-if="cartPesanan.length > 0" class="card m-0">
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
              <tr v-for="(roww, idxx) in cartPesanan" :key="idxx">
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
          <p class="f-w-600 mb-1 text-end">{{ jumlahMakanan }}</p>
        </div>
        <div class="col-6">
          <p class="text-muted mb-1 text-start">Sub Total :</p>
        </div>
        <div class="col-6">
          <p class="f-w-600 mb-1 text-end">Rp. {{ formatPrice(subTotal) }}</p>
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
          <p class="f-w-600 mb-1 text-end">Rp.{{ formatPrice(pajak) }}</p>
        </div>
        <div class="col-6">
          <p class="f-w-600 mb-1 text-start">Grand Total :</p>
        </div>
        <div class="col-6">
          <p class="f-w-600 mb-1 text-end">Rp.{{ formatPrice(grandTotal) }}</p>
        </div>
        <hr />
        <div class="col-6">
          <p class="f-w-600 mb-1 text-start">Kembalian</p>
        </div>
        <div class="col-6">
          <p class="f-w-600 mb-1 text-end">Rp.{{ formatPrice(kembalian) }}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <p class="text-muted mb-1 text-start">Cashier</p>
      </div>
      <div class="col-6">
        <p class="f-w-600 mb-1 text-end">{{ cashier_nama }}</p>
      </div>
      <div class="col-6">
        <p class="text-muted mb-1 text-start">Custumer</p>
      </div>
      <div class="col-6">
        <p class="f-w-600 mb-1 text-end">{{ costumer_nama }}</p>
      </div>
      <div class="col-6">
        <p class="text-muted mb-1 text-start">Jenis Pembayaran</p>
      </div>
      <div class="col-6">
        <p class="f-w-600 mb-1 text-end">{{ metode_bayar }}</p>
      </div>
      <div class="col-6">
        <p class="text-muted mb-1 text-start">Bayar</p>
      </div>
      <div class="col-6">
        <p class="f-w-600 mb-1 text-end">Rp.{{ formatPrice(bayar) }}</p>
      </div>
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
    <button type="button" @click="print" class="btn btn-primary">Print</button>
  </div>
</template>
<style>
.swal2-container {
  z-index: 10000;
}
</style>