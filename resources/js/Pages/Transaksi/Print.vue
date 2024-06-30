<template>
  <Head title="Print" />
  <div id="printMe">
    <div class="ticket">
      <img src="./logo.png" alt="Logo" />
      <p class="centered">Im-Kasir <br />Address line 1 <br />Address line 2</p>
      <p style="margin-top: 15px; margin-bottom: 0">Meja :</p>
      <table class="body">
        <thead>
          <tr>
            <th class="quantity">Q.</th>
            <th class="description">Description</th>
            <th class="price">$$</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(meja, imj) in dataMeja" :key="imj">
            <td class="quantity">{{ meja.durasi }}</td>
            <td class="description">{{ meja.nama }}</td>
            <td class="price">Rp{{ meja.harga }}</td>
          </tr>
        </tbody>
      </table>
      <p style="margin-top: 15px; margin-bottom: 0">Makanan :</p>
      <table class="body">
        <thead>
          <tr>
            <th class="quantity">Q.</th>
            <th class="description">Description</th>
            <th class="price">$$</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(makan, imm) in makanan" :key="imm">
            <td class="quantity">{{ makan.jumlah }}</td>
            <td class="description">{{ makan.nama }}</td>
            <td class="price">Rp{{ makan.harga }}</td>
          </tr>
        </tbody>
      </table>
      <hr />
      <table class="footer">
        <thead>
          <tr>
            <th class="description">Cashier</th>
            <th class="price">{{ this.cashier_nama }}</th>
          </tr>
          <tr>
            <th class="description">Costumer</th>
            <th class="price">{{ this.costumer_nama }}</th>
          </tr>
          <tr>
            <th class="description">Sub Harga</th>
            <th class="price">Rp.{{ formatPrice(this.sub_harga) }}</th>
          </tr>
          <tr>
            <th class="description">Pajak</th>
            <th class="price">Rp.{{ formatPrice(this.pajak) }}</th>
          </tr>
          <tr>
            <th class="description">Total</th>
            <th class="price">Rp.{{ formatPrice(this.total_harga) }}</th>
          </tr>
          <tr>
            <th class="description">Bayar</th>
            <th class="price">Rp.{{ formatPrice(this.bayar) }}</th>
          </tr>
          <tr>
            <th class="description">Kembaliam</th>
            <th class="price">Rp.{{ formatPrice(this.kembalian) }}</th>
          </tr>
        </thead>
      </table>

      <p class="centered">Thanks for your purchase! <br />im-kasir</p>
    </div>
  </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
export default {
  data() {
    return {
      output: null,
    };
  },
  props: {
    makanan: {
      type: Object,
      required: true,
    },
    dataMeja: {
      type: Object,
      required: true,
    },
    invoice: String,
    cashier_nama: String,
    costumer_nama: String,
    sub_harga: Number,
    pajak: Number,
    bayar: Number,
    total_harga: Number,
    kembalian: Number,
  },
  mounted() {
    print();
    console.log("mounted!");
  },
  methods: {
    async print() {
      // Pass the element id here
      await this.$htmlToPaper("printMe");
    },
    formatPrice(value) {
      let val = value / 1;
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
  },
};
</script>
<style>
* {
  font-size: 12px;
  font-family: "Times New Roman";
}

td,
th,
tr,
table {
  border-collapse: collapse;
}
table.body {
  border-top: 1px solid black;
}

td.description,
th.description {
  width: 175px;
  max-width: 175px;
}

td.quantity,
th.quantity {
  width: 40px;
  max-width: 40px;
  word-break: break-all;
}

td.price,
th.price {
  width: 80px;
  max-width: 80px;
  word-break: break-all;
}

.centered {
  text-align: center;
  align-content: center;
}

.ticket {
  width: 255px;
  max-width: 255px;
}

img {
  max-width: inherit;
  width: inherit;
}

@media print {
  .hidden-print,
  .hidden-print * {
    display: none !important;
  }
}
</style>