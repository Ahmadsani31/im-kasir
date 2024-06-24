<template>
    <div class="d-flex justify-content-end">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <template
                    v-for="(link, i) in pagenation.links"
                    :key="link.label"
                >
                    <li
                        :class="`page-item ${link.active ? 'active' : ''} ${
                            link.url ?? 'disabled'
                        }`"
                    >
                        <Link
                            preserve-scroll
                            class="page-link"
                            :href="link.url ?? ''"
                            v-html="link.label"
                        />
                    </li>
                </template>
            </ul>
        </nav>
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    pagenation: Object,
});
</script>
