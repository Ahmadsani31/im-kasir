<script setup>
const imageUrl = (url) => {
  return window.location.origin + url;
};

import { Link } from "@inertiajs/vue3";
</script>
<template lang="">
    <nav class="pc-sidebar pc-trigger">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="/dashboard" class="b-brand text-primary">
                    <!-- ========   Change your logo from here   ============ -->
                    <img :src="imageUrl('/assets/images/logo-dark.svg')" alt="" class="logo logo-lg">
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Dashboard</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item" :class="{ 'active': $page.url === '/' }">
                        <Link :href="route('dashboard')" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span><span
                            class="pc-mtext">Dashboard</span>
                        </Link>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Master</label>
                        <i class="ti ti-apps"></i>
                    </li>
                    <li class="pc-item" :class="{ 'active': $page.url.startsWith('/produk') }">
                        <Link :href="route('produk')" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-typography"></i></span>
                        <span class="pc-mtext">Produk</span>
                        </Link>
                    </li>
                    <li class="pc-item">
                        <a href="../elements/bc_color.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-color-swatch"></i></span>
                            <span class="pc-mtext">Color</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="../elements/icon-tabler.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-plant-2"></i></span>
                            <span class="pc-mtext">Icons</span>
                        </a>
                    </li>
        
                    <li class="pc-item" :class="{ 'active': $page.url.startsWith('/produk') }">
                        <Link :href="route('produk')" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-typography"></i></span>
                        <span class="pc-mtext">Produk</span>
                        </Link>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</template>


