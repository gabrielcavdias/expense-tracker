<script>
import { router, Link, Head } from "@inertiajs/vue3";
import DateSelector from "../components/DateSelector.vue";

export default {
    methods: {
        logout() {
            router.delete("/logout");
        },
        changeDate(date) {
            router.post("/config/date", { month: date.month });
        },
    },
    computed: {
        path() {
            return window.location.pathname.substring(1);
        },
    },
    components: {
        Link,
        Head,
        DateSelector,
    },
};
</script>
<template>
    <header class="mt-5 flex justify-between items-start px-2 md:px-0 relative">
        <Link href="/" class="text-amber-400 text-xl hover:text-amber-300">
            <i class="fa-solid fa-house"></i>
        </Link>
        <h1 class="text-gray-200 text-xl mb-4 flex gap-2">
            <DateSelector @changeDate="changeDate" />
        </h1>
        <button
            class="text-amber-400 text-xl hover:text-amber-300 transition-all duration-300"
            @click="logout"
        >
            <i class="fa-solid fa-right-from-bracket"></i>
        </button>
    </header>
    <slot></slot>
    <div
        class="fixed bottom-0 w-full grid md:hidden grid-cols-3 bg-gray-900 border-t border-opacity-5"
    >
        <Link
            href="/"
            :class="`${
                path == '' ? 'text-amber-300' : 'text-gray-400'
            } flex flex-col items-center justify-center py-5 px-3`"
        >
            <i class="fa fa-house"></i>
            <span>Início</span>
        </Link>
        <Link
            href="/categories"
            :class="`${
                path == 'categories' ? 'text-amber-300' : 'text-gray-400'
            } flex flex-col items-center justify-center py-5 px-3`"
        >
            <i class="fa-solid fa-sign-hanging"></i>
            Categorias
        </Link>
        <button
            class="text-gray-400 flex flex-col items-center justify-center py-5 px-3"
        >
            <i class="fa fa-user"></i>
            Conta
        </button>
    </div>
</template>
