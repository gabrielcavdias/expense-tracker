<script>
import Layout from '../layout/Layout.vue'
import { router, Head } from '@inertiajs/vue3'

export default {
    components: {
        Layout,
        Head,
    },
    methods: {
        sendVerifyEmail() {
            router.post('/verify/send')
        },
    },
}
</script>
<template>
    <Head title="Confirmação de e-mail"></Head>
    <Layout>
        <div class="text-white flex flex-col items-center gap-2">
            <p class="text-center">
                Por favor verifique seu e-mail, caso não tenha recebido o e-mail
                de notificação, por favor clique abaixo:
            </p>
            <button
                @click="sendVerifyEmail"
                class="bg-amber-500 hover:bg-amber-400 transition-all duration-300 text-white px-6 py-3 rounded-xl md:rounded-md"
            >
                Reenviar código de notificação
            </button>
        </div>
    </Layout>
</template>
