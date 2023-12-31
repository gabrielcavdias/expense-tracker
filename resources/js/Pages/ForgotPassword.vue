<script>
import { Head, router } from '@inertiajs/vue3'
export default {
    data() {
        return {
            email: '',
        }
    },
    components: {
        Head,
    },
    methods: {
        sendForgotEmail() {
            router.post('/forgot-password', { email: this.email })
        },
    },
}
</script>
<template>
    <div class="grid h-screen place-items-center px-2 md:px-0">
        <Head title="Esqueci minha senha"></Head>
        <form
            @submit.prevent="sendForgotEmail"
            class="mt-4 w-full bg-white p-8 rounded-xl mx-2 md:mx-0"
        >
            <label for="email" class="mt-2 block text-gray-900 font-bold">
                Email:
            </label>
            <input
                type="email"
                name="email"
                id="email"
                v-model="this.email"
                class="w-full p-3 rounded border-b-2 border-amber-600 focus:outline-none"
                required
            />
            <div class="mt-2 flex justify-center items-center">
                <button
                    class="bg-amber-500 hover:bg-amber-400 transition-all duration-300 text-white px-6 py-3 rounded-xl md:rounded-md"
                >
                    Enviar
                </button>
            </div>
        </form>
    </div>
</template>
