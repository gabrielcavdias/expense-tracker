<script>
import { Head, router, Link } from '@inertiajs/vue3'

export default {
    props: {
        errors: Object,
    },
    components: {
        Head,
        Link,
    },
    methods: {
        login() {
            router.post('/login', this.form)
        },
    },
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
        }
    },
}
</script>
<template>
    <div class="grid h-screen place-items-center px-2 md:px-0">
        <Head title="Login"></Head>
        <div class="grid gap-2">
            <div class="text-red-500 font-bold text-center" v-if="errors.auth">
                {{ errors.auth }}
            </div>
            <h2 class="text-center text-gray-200 font-bold uppercase text-xl">
                Claramente
                <span class="block"> O Logo </span>
            </h2>
            <form
                @submit.prevent="login"
                class="mt-4 w-full bg-white p-8 rounded-xl mx-2 md:mx-0"
            >
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
                <div v-if="errors.email">{{ errors.email }}</div>
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
                <Link
                    href="/forgot-password"
                    class="block mt-3 text-amber-700 underline"
                    >Esqueci minha senha</Link
                >
                <div class="mt-2 flex justify-center items-center">
                    <button
                        class="bg-amber-500 hover:bg-amber-400 transition-all duration-300 text-white px-6 py-3 rounded-xl md:rounded-md"
                    >
                        Entrar
                    </button>
                </div>
            </form>
            <Link
                href="/register"
                class="mt-4 bg-amber-500 hover:bg-amber-400 transition-all duration-300 text-white text-center px-6 py-3 rounded-xl md:rounded-md"
            >
                Cadastrar
            </Link>
        </div>
    </div>
</template>
