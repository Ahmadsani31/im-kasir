<!-- <script>

    import SidebarLayout from './SidebarLayout.vue';
    import HeaderLayout from './HeaderLayout.vue';
    import FooterLayout from './FooterLayout.vue';

export default {
  // Using a render function...
  layout: (h, page) => h(Layout, [page]),

  // Using shorthand syntax...
  layout: SidebarLayout,HeaderLayout,FooterLayout
}
</script> -->
<script setup>
import FooterLayout from "./FooterLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const imageUrl = (url) => {
  return window.location.origin + url;
};

const classSidebar = ref(null);
const smallClassSidebar = ref(null);

function hideSidebar() {
  if (classSidebar.value == true) {
    classSidebar.value = false;
  } else {
    classSidebar.value = true;
  }

  console.log(classSidebar.value);
}
function smallHideSidebar() {
  if (smallClassSidebar.value == true) {
    smallClassSidebar.value = false;
  } else {
    smallClassSidebar.value = true;
  }

  console.log(smallClassSidebar.value);
}
</script>

<template>
  <nav
    class="pc-sidebar pc-trigger"
    :class="{
      'pc-sidebar-hide': classSidebar,
      'mob-sidebar-active': smallClassSidebar,
    }"
  >
    <div class="navbar-wrapper">
      <div class="m-header">
        <a href="/dashboard" class="b-brand text-primary">
          <!-- ========   Change your logo from here   ============ -->
          <img
            :src="imageUrl('/assets/images/logo-dark.svg')"
            alt=""
            class="logo logo-lg"
          />
        </a>
      </div>
      <div class="navbar-content">
        <ul class="pc-navbar">
          <li class="pc-item pc-caption">
            <label>Dashboard</label>
            <i class="ti ti-dashboard"></i>
          </li>
          <li class="pc-item" :class="{ active: $page.url === '/' }">
            <Link :href="route('dashboard')" class="pc-link">
              <span class="pc-micon"><i class="ti ti-dashboard"></i></span
              ><span class="pc-mtext">Dashboard</span>
            </Link>
          </li>

          <li class="pc-item pc-caption">
            <label>Master</label>
            <i class="ti ti-apps"></i>
          </li>
          <li
            class="pc-item"
            :class="{ active: $page.url.startsWith('/meja') }"
          >
            <Link :href="route('meja')" class="pc-link">
              <span class="pc-micon"><i class="ti ti-typography"></i></span>
              <span class="pc-mtext">Meja</span>
            </Link>
          </li>
          <hr />
          <li
            class="pc-item"
            :class="{ active: $page.url.startsWith('/katagori') }"
          >
            <Link :href="route('katagori')" class="pc-link">
              <span class="pc-micon"><i class="ti ti-typography"></i></span>
              <span class="pc-mtext">Katagori</span>
            </Link>
          </li>
          <li
            class="pc-item"
            :class="{ active: $page.url.startsWith('/produk') }"
          >
            <Link :href="route('produk')" class="pc-link">
              <span class="pc-micon"><i class="ti ti-typography"></i></span>
              <span class="pc-mtext">Produk</span>
            </Link>
          </li>

          <li class="pc-item pc-caption">
            <label>Transaksi</label>
            <i class="ti ti-apps"></i>
          </li>
          <li
            class="pc-item"
            :class="{ active: $page.url.startsWith('/transaksi') }"
          >
            <Link :href="route('transaksi')" class="pc-link">
              <span class="pc-micon"><i class="ti ti-plant-2"></i></span>
              <span class="pc-mtext">Pesanan</span>
            </Link>
          </li>
          <li
            class="pc-item"
            :class="{ active: $page.url.startsWith('/laporan') }"
          >
            <Link :href="route('laporan')" class="pc-link">
              <span class="pc-micon"><i class="ti ti-plant-2"></i></span>
              <span class="pc-mtext">Laporan</span>
            </Link>
          </li>
          <li class="pc-item pc-caption">
            <label>System</label>
            <i class="ti ti-apps"></i>
          </li>
          <li class="pc-item">
            <Link
              href="/logout"
              method="post"
              as="button"
              type="button"
              class="btn btn-danger"
            >
              <span class="pc-micon"><i class="ti ti-logout"></i></span>
              <span class="pc-mtext">logout</span>
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <header class="pc-header">
    <div class="header-wrapper">
      <!-- [Mobile Media Block] start -->
      <div class="me-auto pc-mob-drp">
        <ul class="list-unstyled">
          <li class="pc-h-item header-mobile-collapse">
            <a
              href="javascript:void(0)"
              @click="hideSidebar"
              class="pc-head-link head-link-secondary ms-0"
              id="sidebar-hide"
            >
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
          <li class="pc-h-item pc-sidebar-popup">
            <a
              href="javascript:void(0)"
              @click="smallHideSidebar"
              class="pc-head-link head-link-secondary ms-0"
              id="mobile-collapse"
            >
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
          <li class="dropdown pc-h-item d-inline-flex d-md-none">
            <a
              class="pc-head-link head-link-secondary dropdown-toggle arrow-none m-0"
              data-bs-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="false"
              aria-expanded="false"
            >
              <i class="ti ti-search"></i>
            </a>
            <div class="dropdown-menu pc-h-dropdown drp-search">
              <form class="px-3">
                <div class="form-group mb-0 d-flex align-items-center">
                  <i data-feather="search"></i>
                  <input
                    type="search"
                    class="form-control border-0 shadow-none"
                    placeholder="Search here. . ."
                  />
                </div>
              </form>
            </div>
          </li>
        </ul>
      </div>
      <!-- [Mobile Media Block end] -->
      <div class="ms-auto">
        <ul class="list-unstyled">
          <li class="pc-h-item header-user-profile">
            <a
              class="pc-head-link head-link-primary me-0"
              href="#"
              role="button"
              style="min-width: 180px"
            >
              <img
                :src="imageUrl('/assets/images/user/avatar-2.jpg')"
                alt="user-image"
                class="user-avtar"
              />
              <span>
                <h4>{{ $page.props.auth.user.name }}</h4>
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </header>
  <div class="pc-container">
    <div class="pc-content">
      <slot />
    </div>
  </div>
  <FooterLayout />
</template>
