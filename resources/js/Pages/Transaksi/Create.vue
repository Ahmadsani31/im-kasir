<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage, Head } from "@inertiajs/vue3";
import { ref } from "vue";

const urlImg = ref();
// const page = usePage();
const props = defineProps({
  katagori: Object,
  gambar: String,
});

const form = useForm({
  nama: props.katagori.nama ?? "",
  gambar: "",
});

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
            <h5>Data Katagori</h5>
          </div>
          <div class="card-body">
            <form @submit.prevent="form.post(route('katagori.save'))">
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
                <label class="form-label" for="Stock">Gambar</label>
                <input
                  type="file"
                  @input="form.gambar = $event.target.files[0]"
                  @change="previewImage"
                  class="form-control"
                  :class="form.errors.gambar ? 'is-invalid' : ''"
                  aria-label="file example"
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
