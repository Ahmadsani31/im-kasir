<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    import {
        Head,
        Link,
        router
    } from '@inertiajs/vue3';
    import {
        onMounted,
        ref,
        watch
    } from 'vue';



    const props = defineProps({
        produk: Object,
        filters: Object
    });

    const produks = ref([]);

    const produk = props.produk;
    const num = (produk.current_page - 1) * produk.per_page;


    const search = ref(props.filters.search);

    watch(search, (value) => {
        getAllProduk(value);
        // router.get(route('produk'), {
        //     search: value
        // }, {
        //     preserveState: true
        // })
        console.log(value);
    })

    onMounted(() => {
        getAllProduk()
    })

    const getAllProduk = (value) => {
        axios.get(route('produk.all'), {
                search: value
            })
            .then(res => {
                produks.value = res.data.item;
                console.log(res.data)
            })
    };

    function formatPrice(value) {
        let val = (value / 1)
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    function show(id) {
        router.get("/produk/" + id + "/edit");
    }
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
                                <Link :href="route('produk.create')" class="btn btn-sm btn-primary">Tambah</Link>
                            </div>

                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <div class="mb-3">
                                <input class="form-control" v-model="search" type="search" placeholder="Cari data"
                                    preserve-scroll>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Stock</th>
                                        <th>Keterangan</th>
                                        <th>Gambar</th>
                                        <th>Create</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(row,index) in produks.data" :key="index">
                                        <td>{{ num + index + 1 }}</td>
                                        <td> {{ row . nama }}</td>
                                        <td>Rp.{{ formatPrice(row . harga) }}<br>
                                            <span class="badge text-bg-info">
                                                Rp.{{ formatPrice(row . harga_jual) }}
                                            </span>
                                        </td>
                                        <td> {{ row . stock }}</td>

                                        <td>{{ row . keterangan ?? 'null' }}</td>
                                        <td><img v-if="row.gambar" :src="row.gambar" width="100" alt="">
                                        </td>
                                        <td>{{ row . created_at }}</td>
                                        <td>
                                            <button @click.prevent="show(row.produk_id)"
                                                class="btn btn-sm btn-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <Link :href="`show/${row.produk_id}`" class="btn btn-sm btn-warning">
                                            <i class="fas fa-trash-alt"></i>
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <Pagination :pagenation="produks" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
