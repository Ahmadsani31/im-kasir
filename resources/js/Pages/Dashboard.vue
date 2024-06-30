<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import { Head, usePage } from "@inertiajs/vue3";

const page = usePage();

function sweat() {
  Toast.fire({
    icon: "success",
    title: "Signed in successfully",
  });
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Dashboard</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item" aria-current="page">Home</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-4 col-md-6">
        <div
          class="card bg-secondary-dark dashnum-card text-white overflow-hidden"
        >
          <span class="round small"></span> <span class="round big"></span>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="avtar avtar-lg">
                  <i class="text-white ti ti-credit-card"></i>
                </div>
              </div>
              <div class="col-auto">
                <div class="btn-group">
                  <a
                    href="#"
                    class="avtar bg-secondary dropdown-toggle arrow-none"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="ti ti-dots"></i
                  ></a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><button class="dropdown-item">Import Card</button></li>
                    <li><button class="dropdown-item">Export</button></li>
                  </ul>
                </div>
              </div>
            </div>
            <span class="text-white d-block f-34 f-w-500 my-2"
              >1350 <i class="ti ti-arrow-up-right-circle opacity-50"></i
            ></span>
            <p class="mb-0 opacity-50">Total Pending Orders</p>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div
          class="card bg-primary-dark dashnum-card text-white overflow-hidden"
        >
          <span class="round small"></span> <span class="round big"></span>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="avtar avtar-lg">
                  <i class="text-white ti ti-credit-card"></i>
                </div>
              </div>
              <div class="col-auto">
                <div class="btn-group">
                  <a
                    href="#"
                    class="avtar bg-secondary dropdown-toggle arrow-none"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="ti ti-dots"></i
                  ></a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><button class="dropdown-item">Import Card</button></li>
                    <li><button class="dropdown-item">Export</button></li>
                  </ul>
                </div>
              </div>
            </div>
            <span class="text-white d-block f-34 f-w-500 my-2"
              >1350 <i class="ti ti-arrow-up-right-circle opacity-50"></i
            ></span>
            <p class="mb-0 opacity-50">Total Pending Orders</p>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-12">
        <div
          class="card bg-primary-dark dashnum-card dashnum-card-small text-white overflow-hidden"
        >
          <span class="round bg-primary small"></span>
          <span class="round bg-primary big"></span>
          <div class="card-body p-3">
            <div class="d-flex align-items-center">
              <div class="avtar avtar-lg">
                <i class="text-white ti ti-credit-card"></i>
              </div>
              <div class="ms-2">
                <h4 class="text-white mb-1">
                  $203k <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                </h4>
                <p class="mb-0 opacity-50 text-sm">Net Profit</p>
              </div>
            </div>
          </div>
        </div>
        <div class="card dashnum-card dashnum-card-small overflow-hidden">
          <span class="round bg-warning small"></span>
          <span class="round bg-warning big"></span>
          <div class="card-body p-3">
            <div class="d-flex align-items-center">
              <div class="avtar avtar-lg bg-light-warning">
                <i class="text-warning ti ti-credit-card"></i>
              </div>
              <div class="ms-2">
                <h4 class="mb-1">
                  $550K <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                </h4>
                <p class="mb-0 opacity-50 text-sm">Total Revenue</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="basicwizard" class="form-wizard row justify-content-center">
      <div class="col-sm-12 col-md-6 col-xxl-4 text-center">
        <h3>Your Are Loging {{ $page.props.auth.user.name }}</h3>
        <p class="text-muted mb-4">
          A group of people who collectively are responsible for all of the work
          necessary to produce working, validated assets.
        </p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
