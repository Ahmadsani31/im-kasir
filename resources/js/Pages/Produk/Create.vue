<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {
        useForm,
        usePage,
        Head
    } from '@inertiajs/vue3'
    import {
        ref
    } from 'vue';

    // const page = usePage();
    const props = defineProps({
        produk: Object,
        katagori: Object,
    });

    const form = useForm({
        katagori_id: props.produk.katagori_id ?? "",
        nama: props.produk.nama ?? "",
        harga: props.produk.harga ?? "",
        harga_jual: props.produk.harga_jual ?? "",
        stock: props.produk.stock ?? "",
        gambar: "",
        keterangan: props.produk.keterangan ?? "",
    })

    function submit() {
        form.post('/users')
    }

</script>

<template>

    <Head title="Produk Tambah" />

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
                        <h5>Tambah Produk</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="form.post('/produk/save')">
                            <div class="mb-3">
                                <label class="form-label" for="katagori_id">Katagori</label>
                                <select id="katagori_id" class="form-control" v-model="form.katagori_id"
                                    :class="form.errors.katagori_id ? 'is-invalid' : ''">
                                    <option value="">Pilih Katagori</option>
                                <option v-for="(kat, index) in katagori" :value="kat.katagori_id" :key="index" >{{kat.nama}}</option>
                                </select>
                     
                                <div v-if="form.errors.katagori_id" class="invalid-feedback">
                                    {{ form.errors.katagori_id }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Nama">Nama</label>
                                <input type="text" class="form-control" v-model="form.nama"
                                    :class="form.errors.nama ? 'is-invalid' : ''" id="Nama"
                                    placeholder="Nama Produk">
                                <div v-if="form.errors.nama" class="invalid-feedback">
                                    {{ form . errors . nama }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6"><label class="form-label" for="Harga">Harga</label>
                                    <input type="number" v-model="form.harga" class="form-control"
                                        :class="form.errors.harga ? 'is-invalid' : ''" id="Harga"
                                        placeholder="Harga">
                                    <div v-if="form.errors.harga" class="invalid-feedback">
                                        {{ form . errors . harga }}
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6"><label class="form-label" for="harga_jual">Harga Jual</label>
                                    <input type="number" v-model="form.harga_jual" class="form-control"
                                        :class="form.errors.harga_jual ? 'is-invalid' : ''" id="harga_jual"
                                        placeholder="Harga Jual">
                                    <div v-if="form.errors.harga_jual" class="invalid-feedback">
                                        {{ form . errors . harga_jual }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="Stock">Stock</label>
                                <input type="number" class="form-control"
                                    :class="form.errors.stock ? 'is-invalid' : ''" v-model="form.stock" id="Stock"
                                    placeholder="stock">
                                <div v-if="form.errors.stock" class="invalid-feedback">
                                    {{ form . errors . stock }}
                                </div>
                            </div>
                            <div class="form-file mb-3">
                                <label class="form-label" for="Stock">Gambar</label>
                                <input type="file" @input="form.gambar = $event.target.files[0]" class="form-control"
                                    :class="form.errors.gambar ? 'is-invalid' : ''" aria-label="file example">
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form . progress . percentage }}%
                                </progress>
                                <div v-if="form.errors.gambar" class="invalid-feedback">{{ form . errors . gambar }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="validationTextarea" class="form-label">Keterangan</label>
                                <textarea class="form-control" :class="form.errors.keterangan ? 'is-invalid' : ''" v-model="form.keterangan"
                                    id="validationTextarea" placeholder="Opsional"></textarea>
                                <div v-if="form.errors.keterangan" class="invalid-feedback">
                                    {{ form . errors . keterangan }}
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
