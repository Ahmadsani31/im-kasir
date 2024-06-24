<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

// const page = usePage();

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post("/login", {
    onFinish: () => form.reset("password"),
  });
};

const imageUrl = (url) => {
  // return url.replace("public/", "storage/");
  return window.location.origin + "/" + url;
};
</script>
<style>
.text-red {
  color: red;
}
</style>
<template>
  <GuestLayout>
    <Head title="Log in" />

    <div class="row">
      <div class="d-flex justify-content-center">
        <div class="auth-header">
          <h2 class="text-secondary mt-5"><b>I'm Kasir</b></h2>
        </div>
      </div>
    </div>
    <div class="d-grid">
      <button
        type="button"
        class="btn mt-2 bg-light-primary bg-light text-muted"
      >
        <img
          :src="imageUrl('assets/images/authentication/google-icon.svg')"
          alt="image"
        />Sign In With Google Google
      </button>
    </div>
    <div class="saprator mt-3">
      <span>or</span>
    </div>
    <div
      v-if="form.errors.login_failed"
      class="alert alert-danger"
      role="alert"
    >
      {{ form.errors.login_failed }}
    </div>
    <h5 class="my-4 d-flex justify-content-center">
      Sign in with Email address
    </h5>
    <form @submit.prevent="submit">
      <div class="form-floating mb-3">
        <TextInput
          id="email"
          type="email"
          v-model="form.email"
          autofocus
          autocomplete="username"
          placeholder="Email address"
        />
        <InputLabel for="signin-email" value="Email" />

        <InputError :message="form.errors.email" />
      </div>
      <div class="form-floating mb-3">
        <TextInput
          id="password"
          type="password"
          v-model="form.password"
          autocomplete="current-password"
          placeholder="Password"
        />
        <InputLabel for="password" value="Password" />
        <InputError :message="form.errors.password" />
      </div>
      <div class="d-flex mt-1 justify-content-between">
        <div class="form-check">
          <Checkbox
            name="remember"
            id="customCheckc1"
            v-model:checked="form.remember"
          />
          <label class="form-check-label text-muted" for="customCheckc1"
            >Remember me</label
          >
        </div>
        <!-- <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="text-secondary"
        >
          Forgot your password?
        </Link> -->
      </div>
      <div class="d-grid mt-4">
        <PrimaryButton
          :class="{ 'btn-light-warning': form.processing }"
          :disabled="form.processing"
        >
          Log in
        </PrimaryButton>
      </div>
    </form>
    <hr />
    <Link href="/register" class="d-flex justify-content-center"
      >Don't have an account?
    </Link>
  </GuestLayout>
</template>
