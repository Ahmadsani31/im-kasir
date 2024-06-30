<script setup>
import Loading from "vue-loading-overlay";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Modal from "@/Components/Modal.vue";
import ProsesPesanan from "@/Components/Modal/ModalProsesPesanan.vue";

import CardMakanan from "./CardMakanan.vue";
import CardPesananMeja from "./CardPesananMeja.vue";
import CardPesanan from "./CardPesanan.vue";

import Swal from "sweetalert2";

import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { onMounted, onUpdated, ref } from "vue";

const props = defineProps({
  meja: Object,
  produk: Object,
  cart: Object,
  invoice: String,
});

if (!localStorage.jamMeja) {
  localStorage.jamMeja = 1;
}
// localStorage.jamMeja = jam.value;

const myChild = ref(null);

let thisModal = ref(null);
let thisModalEl = ref(false);

function showModal() {
  thisModal.value.show();
  thisModalEl.value = true;
}

function closeModal(val) {
  thisModal.value.close();
  setTimeout(() => (thisModalEl.value = false), 500);
}

const batalkan = () => {
  return new Swal({
    title: "Perhatian!",
    text: "Kamu Yakin Ingin Batalkan Pesanan?",
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
      router.delete(route("transaksi.cancel"), {
        preserveScroll: true,
        onSuccess: () => {
          router.visit(route("transaksi"), { preserveScroll: false });
        },
      });
    }
  });
};

const isLoading = ref(false);
const fullPage = ref(true);

function setLoading() {
  isLoading.value = true;
}

function unsetLoading() {
  isLoading.value = false;
}
</script>
<template>
  <Head title="Transaksi" />
  <loading
    v-model:active="isLoading"
    color="#173e43"
    backgroundColor="#d9efee"
    loader="bars"
    :is-full-page="fullPage"
  />
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
        <CardMakanan
          :produk="produk"
          @setLoading="setLoading"
          @unsetLoading="unsetLoading"
        />
      </div>
      <div class="col-md-4">
        <CardPesananMeja :meja="meja" />
        <CardPesanan
          :cart="cart"
          @setLoading="setLoading"
          @unsetLoading="unsetLoading"
        />
        <div class="card">
          <div class="card-body">
            <div class="row g-3">
              <div class="col-12">
                <div class="row align-items-end justify-content-between g-3">
                  <div class="col-sm-auto btn-page">
                    <button @click="batalkan" class="btn btn-outline-danger">
                      Batalkan
                    </button>
                    <button @click="showModal" class="btn btn-primary">
                      Proses Pesanan
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12"></div>
    </div>
  </AuthenticatedLayout>
  <Modal title="Proses Makanan" ref="thisModal">
    <template v-if="thisModalEl" #body>
      <ProsesPesanan
        ref="myChild"
        :cartMeja="props.meja"
        :cartPesanan="props.cart"
        :invoice="props.invoice"
        @childToParentModal="closeModal"
        @setLoading="setLoading"
        @unsetLoading="unsetLoading"
      />
    </template>
  </Modal>
</template>