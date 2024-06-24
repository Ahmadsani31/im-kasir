<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { DataTable } from "datatables.net-vue3";
import Swal from "sweetalert2";

import { Head, Link, router } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";

export default {
  name: "Produk",
  components: {
    AuthenticatedLayout,
    Head,
    DataTable,
    Link,
  },
  props: {
    produk: Object,
    katagori: Object,
  },
  data() {
    return {
      selectedRow: "",
      katagori_id: "",
      columns: [
        {
          data: "DT_RowIndex",
          title: "No",
          searchable: false,
          orderable: false,
        },
        { data: "gambar", title: "Gambar" },
        { data: "nama", title: "Nama" },
        { data: "harga", title: "Harga" },
        { data: "tanggal", title: "Tanggal" },
        { data: "action", title: "Action" },
      ],
      dt: null,
      csrfToken: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  mounted() {
    this.dt = this.$refs.tableCom.dt;
  },
  methods: {
    clickReload() {
      //   const table = this.$refs.tableCom.dt;
      //   // table.ajax.url("produk").load();
      //   console.log("table: %o", table.ajax.reload);
      this.dt.ajax.reload(null, false);
    },
    onChangeKat(val) {
      this.katagori_id = val.target.value;
      this.clickReload();
    },
    showEdit(id) {
      router.get("/produk/" + id + "/edit");
    },
    deleteProd(id) {
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
          router.delete(`/produk/${id}`, {
            preserveScroll: true,
            onSuccess: (page) => {
              this.clickReload();
            },
          });
        }
      });
    },
  },
};
</script>

<template>
  <Head title="Produk" />

  <AuthenticatedLayout>
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Produk</h5>
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
                <h5>Data Produk</h5>
              </div>
              <div class="col-auto">
                <Link
                  :href="route('produk.create')"
                  class="btn btn-sm btn-primary"
                  >Tambah</Link
                >
              </div>
            </div>
          </div>
          <div class="card-body table-border-style">
            <select
              id="katagori_id"
              class="form-control"
              @change="onChangeKat($event)"
            >
              <option value="">Pilih Katagori</option>
              <option
                v-for="(kat, index) in katagori"
                :value="kat.katagori_id"
                :key="index"
              >
                {{ kat.nama }}
              </option>
            </select>
            <div class="table-responsive">
              <DataTable
                :ajax="{
                  url: '/datatable',
                  method: 'POST',
                  data: function (d) {
                    d._token = csrfToken;
                    d.tabel = 'penelitian_institusi';
                    d.kat = katagori_id;
                  },
                }"
                :columns="columns"
                :options="{
                  select: true,
                  processing: true,
                  serverSide: true,
                }"
                class="table text-center"
                ref="tableCom"
              >
                <template #column-5="props">
                  <Link
                    :href="`/meja/${props.rowData.produk_id}/edit`"
                    class="btn btn-sm btn-primary me-2"
                  >
                    <i class="ph-duotone ph-pen"></i>
                  </Link>
                  <button
                    type="button"
                    class="btn btn-sm btn-danger"
                    @click="deleteProd(props.rowData.produk_id)"
                  >
                    <i class="ph-duotone ph-trash"></i>
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
