<script>
import { router, Link, Head } from "@inertiajs/vue3";
import DateSelector from "../components/DateSelector.vue";
import NavBar from "../components/NavBar.vue";

export default {
    methods: {
        logout() {
            router.delete("/logout");
        },
        changeDate(date) {
            router.post("/config/date", { month: date.month });
        },
    },
    components: {
        Link,
        Head,
        DateSelector,
        NavBar,
    },
};
</script>
<template>
    <header
        class="mt-5 flex justify-between items-start px-2 md:px-0 relative md:pt-16"
    >
        <div>
            <div
                class="rounded-full overflow-hidden outline outline-1 outline-amber-400 md:absolute md:top-0 md:right-2"
            >
                <img
                    src="https://www.github.com/gabrielcavdias.png"
                    alt="Foto do usuário logado"
                    class="w-14 md:w-12 h-full object-cover"
                />
            </div>
        </div>
        <h1 class="text-gray-200 text-xl mb-4 flex gap-2">
            <DateSelector @changeDate="changeDate" />
        </h1>
        <button
            class="text-amber-400 text-xl hover:text-amber-300 transition-all duration-300"
            @click="logout"
        >
            <i class="fa-solid fa-right-from-bracket md:absolute md:top-2"></i>
        </button>
    </header>
    <slot></slot>
    <NavBar />
</template>
