<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import { Head, Link, router } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";

const props = defineProps({
  meja: Object,
});
localStorage.jamMeja = 1;
const Hours = new Date().getHours();

function formatPrice(value) {
  let val = value / 1;
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function show(id) {
  router.get("/katagori/" + id + "/edit");
}
const valJam = ref(Hours);

const jenisMeja = [
  { id: "STD", text: "Standar" },
  { id: "VIP", text: "VVIP" },
];

const jam = [
  { id: "01", text: "01" },
  { id: "02", text: "02" },
  { id: "03", text: "03" },
  { id: "04", text: "04" },
  { id: "05", text: "05" },
  { id: "06", text: "06" },
  { id: "07", text: "07" },
  { id: "08", text: "08" },
  { id: "09", text: "09" },
  { id: "10", text: "10" },
  { id: "11", text: "11" },
  { id: "12", text: "12" },
  { id: "13", text: "13" },
  { id: "14", text: "14" },
  { id: "15", text: "15" },
  { id: "16", text: "16" },
  { id: "17", text: "17" },
  { id: "18", text: "18" },
  { id: "19", text: "19" },
  { id: "20", text: "20" },
  { id: "21", text: "21" },
  { id: "22", text: "22" },
  { id: "23", text: "23" },
  { id: "24", text: "24" },
];

const onChangejenis = (val) => {
  if (val == "") {
    delete val.target.value;
  }

  router.get(
    route("transaksi"),
    {
      jenis: val.target.value,
    },
    {
      replace: true,
      preserveState: true,
    }
  );
  console.log(val.target.value);
};

onMounted(() => {
  //   this.table.dt()
  //   .on( 'select', function ( e, dt, type, indexes ) {
  //       var rowData = dt.rows( indexes ).data().toArray();
  //       console.log(rowData);
  //   } )
});
</script>

<template>
  <Head title="Transaksi" />

  <AuthenticatedLayout>
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Transaksi</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item" aria-current="page">Home</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="row g-4">
              <div class="col-md-6">
                <select
                  id="jenis"
                  class="form-control"
                  @change="onChangejenis($event)"
                >
                  <option value="">Pilih Jenis</option>
                  <option
                    v-for="(kat, index) in jenisMeja"
                    :value="kat.id"
                    :key="index"
                  >
                    {{ kat.text }}
                  </option>
                </select>
              </div>
              <div class="col-md-6">
                <select
                  id="jenis"
                  class="form-control"
                  @change="onChangejenis($event)"
                  v-model="valJam"
                >
                  <option value="">Pilih Jam</option>
                  <option
                    v-for="(row, index) in jam"
                    :value="row.id"
                    :key="index"
                  >
                    {{ row.text }}
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div
                class="col-sm-6 col-lg-4 col-xxl-3"
                v-for="(row, i) in meja.data"
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
                      <div class="position-absolute top-0 end-0 p-2">
                        <span class="badge text-bg-primary text-uppercase"
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
                      <li class="list-group-item px-0 py-2">
                        <div class="d-flex align-items-center">
                          <div class="flex-grow-1 me-2">
                            <p class="mb-0">Harga</p>
                          </div>
                          <div class="flex-shrink-0">
                            <p class="text-muted mb-0">
                              Rp.{{ formatPrice(row.harga) }}
                            </p>
                          </div>
                        </div>
                      </li>
                    </ul>
                    <Link
                      :href="route('transaksi.pesanan', row.meja_id)"
                      class="btn btn-sm btn-outline-primary mb-2"
                      >Pesan</Link
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
<style>
@import "datatables.net-bs5";
</style>
