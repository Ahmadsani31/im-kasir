
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import IconEdit from "@/Components/Icon/EditSVG.vue";
import IconDel from "@/Components/Icon/DeleteSVG.vue";

import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
const table = ref();
let dt = table.value;
// onMounted(function() {
//     dt = table.value.dt;
// });
const page = usePage({});
console.log(page);

const props = defineProps({
  meja: Object,
});

const columns = [
  {
    data: "meja_id",
  },
  {
    data: "gambar",
    className: "text-center  align-middle",
    render: function (data) {
      return (
        '<img src="' +
        data +
        '" class="img-fluid rounded" alt="image" width="100">'
      );
    },
  },
  {
    className: "text-center  align-middle",
    data: "nama",
  },
  {
    data: "jenis",
  },
  {
    className: "text-center  align-middle",
    data: "harga",
    render: function (data) {
      return "Rp." + formatPrice(data);
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

function formatPrice(value) {
  let val = value / 1;
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
              <h5 class="m-b-10">Meja</h5>
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
                <h5>Meja Katagori {{ $page.props.auth.user.email }}</h5>
              </div>
              <div class="col-auto">
                <Link
                  :href="route('meja.create')"
                  class="btn btn-sm btn-primary"
                  >Tambah</Link
                >
              </div>
            </div>
          </div>
          <div class="card-body table-border-style">
            <div class="table-responsive">
              <DataTable
                :data="meja.data"
                :columns="columns"
                :options="{ select: true, pageLength: 5 }"
                class="display table text-center"
                ref="table"
              >
                <thead>
                  <tr>
                    <th width="10" class="text-center">No</th>
                    <th class="text-center">Gambar</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Jenis</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <template #column-6="props">
                  <Link
                    :href="`/meja/${props.rowData.meja_id}/edit`"
                    class="btn btn-sm btn-primary me-2"
                  >
                    <IconEdit />
                  </Link>
                  <button
                    type="button"
                    class="btn btn-sm btn-danger"
                    @click="delete props.rowData"
                  >
                    <IconDel />
                  </button>
                </template>
              </DataTable>
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
