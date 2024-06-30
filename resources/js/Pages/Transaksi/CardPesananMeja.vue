<script>
import { ref } from "vue";

export default {
  name: "CardPesananMeja",
  components: {},
  props: {
    meja: Object,
  },
  data() {
    return {
      jam: localStorage.jamMeja,
    };
  },
  methods: {
    formatPrice(value) {
      let val = value / 1;
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    decreaseMejaValue() {
      if (this.jam > 1) {
        localStorage.jamMeja--;
        this.jam--;
      }
    },
    increaseMejaValue() {
      this.jam++;
      localStorage.jamMeja++;
    },
  },
};
</script>
<template>
  <div class="card dashnum-card dashnum-card-small overflow-hidden">
    <span class="round bg-warning small"></span>
    <span class="round bg-warning big"></span>
    <div class="card-body p-3">
      <h5 class="font-bold mb-0">Pesanan Meja</h5>
      <div class="border rounded p-1 h-100 mt-0">
        <table class="table table-sm text-center">
          <thead>
            <tr>
              <th class="p-0">#</th>
              <th class="p-0">Nama</th>
              <th class="p-0">Durasi/Jam</th>
              <th class="p-0">Harga</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, idx) in meja" :key="idx">
              <th><img :src="row.gambar" alt="img" width="40" /></th>
              <td>{{ row.nama }}</td>
              <td>
                <div class="btn-group btn-group-sm border" role="group">
                  <button
                    type="button"
                    @click="decreaseMejaValue(jam)"
                    class="btn btn-link-dark"
                  >
                    <i class="ti ti-minus"></i>
                  </button>
                  <input
                    class="wid-35 text-center border-0 m-0 form-control rounded-0 shadow-none"
                    type="text"
                    v-model="jam"
                    required
                  />
                  <button
                    type="button"
                    @click="increaseMejaValue(jam)"
                    class="btn btn-link-dark"
                  >
                    <i class="ti ti-plus"></i>
                  </button>
                </div>
              </td>
              <td>Rp.{{ formatPrice(row.harga) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>