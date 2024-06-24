<script setup>
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';

    import GoogleLogo from '@/Components/GoogleLogo.vue';

    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/vue3';

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="auth-header">
                    <h2 class="text-secondary mt-5"><b>Sign up</b></h2>
                    <p class="f-16 mt-2">Enter your credentials to continue</p>
                </div>
            </div>
        </div>
        <button type="button" class="btn mt-2 bg-light-primary bg-light text-muted" style="width: 100%">
            <GoogleLogo> Sign Up With Google</GoogleLogo>
        </button>
        <div class="saprator mt-3">
            <span>or</span>
        </div>
        <h5 class="my-4 d-flex justify-content-center">Sign Up with Email address</h5>
        <form @submit.prevent="submit">
                    <div class="form-floating mb-3">
                <TextInput id="name" type="text" v-model="form.name" required
                    autofocus autocomplete="name" placeholder="Name" />
                                  <InputLabel for="name" value="Name" />

                <InputError :message="form.errors.name" />
                    </div>
             
          
            <div class="form-floating mb-3">


                <TextInput id="email" type="email" v-model="form.email" required
                    autocomplete="username" placeholder="Email Address" />
                        <InputLabel for="email" value="Email" />

                <InputError :message="form.errors.email" />
            </div>
            <div class="form-floating mb-3">

                <TextInput id="password" type="password" v-model="form.password" required
                    autocomplete="new-password" placeholder="Password" />
                    <InputLabel for="password" value="Password" />



                <InputError :message="form.errors.password" />
            </div>
            <div class="form-floating mb-3">
             <TextInput
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Password"
                />
                  <InputLabel for="password_confirmation" value="Confirm Password" />
                <InputError :message="form.errors.password_confirmation" />
            </div>

            <div class="d-grid mt-4">
                       <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
        <hr>
        <Link :href="route('login')" class="d-flex justify-content-center">
        Already registered?
        </Link>
    </GuestLayout>
</template>
