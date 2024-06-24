<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage, Head } from "@inertiajs/vue3";
import { ref } from "vue";

const urlImg = ref();
// const page = usePage();
const props = defineProps({
  meja: Object,
  gambar: String,
});

const form = useForm({
  nama: props.meja.nama ?? "",
  jenis: props.meja.jenis ?? "",
  harga: props.meja.harga ?? "",
  gambar: "",
});

const jenisMeja = [
  { id: "STD", text: "Standar" },
  { id: "VIP", text: "VVIP" },
];

// function submit() {
//     form.post(route('katagori.save'))
// }

function previewImage(e) {
  const file = e.target.files[0];
  urlImg.value = URL.createObjectURL(file);
}
</script>

<template>
  <Head title="Katagori Tambah" />

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
            <h5>Data Meja</h5>
          </div>
          <div class="card-body">
            <form @submit.prevent="form.post(route('meja.save'))">
              <div class="d-flex justify-content-center">
                <img
                  v-if="gambar"
                  class="img-radius img-fluid wid-150"
                  :src="gambar"
                  alt="User image"
                />
                <img
                  v-if="urlImg"
                  class="img-radius img-fluid wid-150"
                  :src="urlImg"
                  alt="User image"
                />
              </div>
              <div class="form-file mb-3">
                <label class="form-label" for="gambar">Gambar</label>
                <input
                  type="file"
                  @input="form.gambar = $event.target.files[0]"
                  @change="previewImage"
                  class="form-control"
                  :class="form.errors.gambar ? 'is-invalid' : ''"
                  aria-label="file example"
                  id="gambar"
                />
                <progress
                  v-if="form.progress"
                  :value="form.progress.percentage"
                  max="100"
                >
                  {{ form.progress.percentage }}%
                </progress>
                <div v-if="form.errors.gambar" class="invalid-feedback">
                  {{ form.errors.gambar }}
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="Nama">Nama</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.nama"
                  :class="form.errors.nama ? 'is-invalid' : ''"
                  id="Nama"
                  placeholder="Nama Produk"
                />
                <div v-if="form.errors.nama" class="invalid-feedback">
                  {{ form.errors.nama }}
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="jenis">Jenis</label>
                <select
                  id="jenis"
                  class="form-control"
                  v-model="form.jenis"
                  :class="form.errors.jenis ? 'is-invalid' : ''"
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
                <div v-if="form.errors.jenis" class="invalid-feedback">
                  {{ form.errors.jenis }}
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="Harga">Harga Per Jam</label>
                <input
                  type="number"
                  v-model="form.harga"
                  class="form-control"
                  :class="form.errors.harga ? 'is-invalid' : ''"
                  id="Harga"
                  placeholder="Harga"
                />
                <div v-if="form.errors.harga" class="invalid-feedback">
                  {{ form.errors.harga }}
                </div>
              </div>
              <div class="d-grid gap-2 mt-2">
                <button class="btn btn-primary" type="submit">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
