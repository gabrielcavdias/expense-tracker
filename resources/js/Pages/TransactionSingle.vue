<script>
import { Head, Link, router } from "@inertiajs/vue3";

export default {
    props: {
        transaction: Object,
    },
    methods: {
        brl(value) {
            return new Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(value);
        },
        getDate() {
            let date = new Date(this.transaction.date);
            let day = date.getDate();
            let month =
                date.getMonth() + 1 < 10
                    ? "0" + (date.getMonth() + 1)
                    : date.getMonth() + 1;
            let year = date.getFullYear();
            let str = `${day}/${month}/${year}`;
            return str;
        },
        destroyTransaction() {
            router.delete(`/transaction/${this.transaction.id}`);
        },
        back() {
            window.history.back();
        },
    },
    components: {
        Head,
        Link,
    },
};
</script>
<template>
    <Head :title="this.transaction.title"></Head>
    <div class="bg-gray-900 h-screen absolute inset-0 px-2 md:px-0">
        <section
            :class="`mt-8 ${
                this.transaction.type == 'expense'
                    ? 'bg-red-500'
                    : 'bg-green-500'
            } text-white p-5 rounded-t-lg max-w-xl mx-auto`"
            aria-labelledby="title"
        >
            <!-- Heading  -->
            <div class="text-sm flex items-center justify-between">
                <Link href="#" @click="back()" class="flex items-center gap-2">
                    <i class="fa fa-chevron-left"></i>
                    Voltar
                </Link>
                <button
                    class="text-white hover:text-red-300 text-xl"
                    @click="destroyTransaction()"
                >
                    <i class="fa fa-trash"></i>
                </button>
            </div>
            <!-- Body price -->
            <div class="mt-5">
                <span class="block text-sm text-gray-100">
                    Valor da
                    {{ transaction.type == "expense" ? "despesa" : "receita" }}
                </span>
                <p class="font-bold text-4xl mt-2">
                    {{ brl(transaction.value) }}
                </p>
            </div>
            <!-- Body details -->
            <article class="mt-4 bg-white rounded-3xl text-gray-900 p-4">
                <p class="text-sm text-gray-700">Data:</p>
                <p>{{ getDate() }}</p>
                <p class="text-sm text-gray-700">Título:</p>
                <h2 class="text-xl" id="title">{{ transaction.title }}</h2>
                <p class="text-sm text-gray-700">Categoria:</p>
                <p>{{ transaction.category.title }}</p>
            </article>
        </section>
    </div>
</template>
