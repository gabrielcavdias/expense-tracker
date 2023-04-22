<script>
import { Head } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
        };
    },
    methods: {
        register() {
            router.post("/register", this.form);
        },
    },
    props: {
        errors: Object,
    },
    components: {
        Head,
    },
};
</script>
<template>
    <div class="grid h-screen place-items-center">
        <Head title="Registro"></Head>

        <!-- Logo -->
        <form
            @submit.prevent="register"
            class="w-full bg-white p-8 rounded-xl mx-2 md:mx-0"
        >
            <label for="name" class="mt-2 block text-gray-900 font-bold"
                >Nome:</label
            >
            <input
                type="text"
                name="name"
                id="name"
                v-model="form.name"
                class="w-full p-3 rounded border-b-2 border-amber-600 focus:outline-none"
            />
            <div class="text-red-500 font-bold" v-if="errors.name">
                {{ errors.name }}
            </div>
            <label for="email" class="mt-2 block text-gray-900 font-bold"
                >Email:</label
            >
            <input
                type="email"
                name="email"
                id="email"
                v-model="form.email"
                class="w-full p-3 rounded border-b-2 border-amber-600 focus:outline-none"
            />
            <div class="text-red-500 font-bold" v-if="errors.email">
                {{ errors.email }}
            </div>
            <label for="password" class="mt-2 block text-gray-900 font-bold"
                >Senha:</label
            >
            <input
                type="password"
                name="password"
                id="password"
                v-model="form.password"
                class="w-full p-3 rounded border-b-2 border-amber-600 focus:outline-none"
            />
            <div class="text-red-500 font-bold" v-if="errors.password">
                {{ errors.password }}
            </div>
            <label
                for="password_confirmation"
                class="mt-2 block text-gray-900 font-bold"
                >Confirmar senha:</label
            >
            <input
                type="password"
                name="password_confirmation"
                id="password"
                v-model="form.password_confirmation"
                class="w-full p-3 rounded border-b-2 border-amber-600 focus:outline-none"
            />
            <div class="mt-2 grid">
                <button
                    class="bg-amber-500 hover:bg-amber-400 transition-all duration-300 text-white p-3 rounded-full md:rounded-md flex md:block items-center justify-center aspect-square md:aspect-auto"
                >
                    Registrar
                </button>
            </div>
        </form>
    </div>
</template>
