<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">
            <!-- <a href="#" class="d-flex justify-content-center">
                            <ApplicationLogo class="img-fluid brand-logo" />
                        </a> -->
            <slot />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
