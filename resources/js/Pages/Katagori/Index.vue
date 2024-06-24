<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";

const props = defineProps({
  katagori: Object,
});

// const katagori = props.katagori;
// const num = (katagori.current_page - 1) * katagori.per_page;

// console.log(num);

const search = ref("");
const table = ref();

function formatPrice(value) {
  let val = value / 1;
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function show(id) {
  router.get("/katagori/" + id + "/edit");
}

const columns = [
  {
    data: "katagori_id",
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
    data: "nama",
  },

  {
    data: "created_at",
  },
];

onMounted(() => {
  //   this.table.dt()
  //   .on( 'select', function ( e, dt, type, indexes ) {
  //       var rowData = dt.rows( indexes ).data().toArray();
  //       console.log(rowData);
  //   } )
});
</script>

<template>
  <Head title="Katagori" />

  <AuthenticatedLayout>
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Katagori</h5>
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
                <h5>Data Katagori</h5>
              </div>
              <div class="col-auto">
                <Link
                  :href="route('katagori.create')"
                  class="btn btn-sm btn-primary"
                  >Tambah</Link
                >
              </div>
            </div>
          </div>
          <div class="card-body table-border-style">
            <div class="table-responsive">
              <DataTable
                :data="katagori.data"
                :columns="columns"
                :options="{ select: true }"
                class="table text-center"
                ref="table"
                width="100%"
              >
                <thead>
                  <tr>
                    <th width="10" class="text-center">No</th>
                    <th class="text-center">Gambar</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <template #column-4="props">
                  <button
                    type="button"
                    class="btn btn-sm btn-primary me-2"
                    @click="show(props.rowData.katagori_id)"
                  >
                    Edit
                  </button>
                  <button
                    type="button"
                    class="btn btn-sm btn-danger"
                    @click="delete props.rowData"
                  >
                    Delete
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
