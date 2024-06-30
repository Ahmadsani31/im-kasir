
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Modal from "@/Components/Modal.vue";
import ProsesPesananDetail from "@/Components/Modal/ModalProsesPesananDetail.vue";

import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
const table = ref();
let dt = table.value;
// onMounted(function() {
//     dt = table.value.dt;
// });
// const page = usePage({});
// console.log(page);

const props = defineProps({
  transaksi: Object,
});

const columns = [
  {
    data: "invoice",
  },
  {
    className: "text-center  align-middle",
    data: "cashier_nama",
  },
  {
    data: "costumer_nama",
  },
  {
    className: "text-center  align-middle",
    data: "sub_harga",
    render: function (data) {
      return "Rp." + data;
    },
  },
  {
    className: "text-center  align-middle",
    data: "pajak",
    render: function (data) {
      return "Rp." + data;
    },
  },
  {
    className: "text-center  align-middle",
    data: "total_harga",
    render: function (data) {
      return "Rp." + data;
    },
  },
  {
    data: "created_at",
  },
  {
    className: "text-center  align-middle",
    data: "action",
  },
];

function print(raw) {
  // console.log(raw.transaksi_uuid);
  open(route("transaksi.print", raw.transaksi_uuid));
}

let thisModal = ref(null);
let thisModalEl = ref(false);
let transaksiUuid = ref(null);

function showModal(raw) {
  transaksiUuid.value = raw.transaksi_uuid;
  thisModal.value.show();
  thisModalEl.value = true;
  console.log(transaksiUuid.value);
}

function closeModal(val) {
  thisModal.value.close();
  setTimeout(() => (thisModalEl.value = false), 500);
}
</script>

<template>
  <Head title="Katagori" />

  <AuthenticatedLayout>
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Laporan</h5>
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
            <div class="row align-items-center">
              <div class="col">
                <h5>Data laporan</h5>
              </div>
            </div>
          </div>
          <div class="card-body table-border-style">
            <div class="table-responsive">
              <DataTable
                :data="transaksi.data"
                :columns="columns"
                :options="{ select: true, pageLength: 5 }"
                class="display table text-center"
                ref="table"
              >
                <thead>
                  <tr>
                    <th class="text-center">Invoice</th>
                    <th class="text-center">Cashier</th>
                    <th class="text-center">Costumer</th>
                    <th class="text-center">Sub Harga</th>
                    <th class="text-center">Pajak</th>
                    <th class="text-center">Total Harga</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <template #column-7="props">
                  <button
                    type="button"
                    class="btn btn-sm btn-primary me-2"
                    @click="showModal(props.rowData)"
                  >
                    <i class="ph-duotone ph-eye"></i>
                  </button>
                  <button
                    type="button"
                    class="btn btn-sm btn-danger"
                    @click="print(props.rowData)"
                  >
                    <i class="ph-duotone ph-file"></i>
                  </button>
                </template>
              </DataTable>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
  <Modal title="Proses Makanan" ref="thisModal">
    <template v-if="thisModalEl" #body>
      <ProsesPesananDetail
        :transaksiuuid="transaksiUuid"
        @childToParentModal="closeModal"
      />
    </template>
  </Modal>
</template>
<style>
@import "datatables.net-bs5";
</style>
