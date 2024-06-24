<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <span class="text-red">
            {{ message }}
        </span>
    </div>
</template>
