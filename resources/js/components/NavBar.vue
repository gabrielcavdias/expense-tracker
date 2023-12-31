<script>
import { Link } from "@inertiajs/vue3";
export default {
    computed: {
        path() {
            return window.location.pathname.substring(1);
        },
    },
    components: {
        Link,
    },
};
</script>
<template>
    <nav
        class="fixed md:absolute bottom-0 md:bottom-auto md:top-0 md:max-w-2xl w-full grid grid-cols-3 md:flex md:gap-6 md:mt-2 bg-gray-900 md:bg-transparent border-t md:border-t-0 border-opacity-5"
    >
        <Link
            href="/"
            :class="`${
                path == '' ? 'text-amber-300' : 'text-gray-400'
            } md:hover:text-amber-200 flex flex-col md:flex-row md:gap-3 items-center justify-center  py-5 px-3`"
        >
            <i class="fa fa-house"></i>
            <span>Início</span>
        </Link>
        <Link
            href="/categories"
            :class="`${
                path == 'categories' ? 'text-amber-300' : 'text-gray-400'
            } md:hover:text-amber-200 flex flex-col md:flex-row md:gap-3 items-center justify-center  py-5 px-3`"
        >
            <i class="fa-solid fa-sign-hanging"></i>
            Categorias
        </Link>
        <button
            class="text-gray-400 md:hover:text-amber-200 flex flex-col md:flex-row md:gap-3 items-center justify-center py-5 px-3"
        >
            <i class="fa fa-user"></i>
            Conta
        </button>
    </nav>
</template>
