<script>
import { Head } from "@inertiajs/vue3";
import TransactionInfo from "../components/TransactionInfo.vue";
import Layout from "../layout/Layout.vue";
export default {
    props: {
        category: Object,
    },
    components: {
        Head,
        TransactionInfo,
        Layout,
    },
    methods: {
        total() {
            let total = this.category.transactions
                .map((transaction) => transaction.value)
                .reduce((prev, cur) => prev + cur, 0);
            return new Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(Number(total));
        },
    },
};
</script>
<template>
    <Head :title="`Categoria ${category.title}`"></Head>
    <Layout>
        <div class="mt-4 flex flex-col gap-2 justify-center items-center">
            <p class="text-gray-200 font-bold">
                {{ this.category.type == "expense" ? "Gastos" : "Receitas" }}
                totais no mês:
            </p>
            <span
                :class="`${
                    this.category.type == 'expense'
                        ? 'text-red-600'
                        : 'text-green-500'
                } font-bold text-3xl`"
                >{{ this.total() }}</span
            >
        </div>
        <h2 class="text-gray-200 font-bold text-3xl my-5 px-2 md:px-0">
            {{ category.title }}
            <span class="block text-gray-400 font-normal text-sm">
                ({{ this.category.type == "expense" ? "Despesa" : "Receita" }})
            </span>
        </h2>
        <ul
            class="grid gap-3 max-h-4/5-screen overflow-auto px-2 md:px-0"
            v-if="this.category.transactions.length > 0"
        >
            <TransactionInfo
                :id="transaction.id"
                :title="transaction.title"
                :category="category.title"
                :category_id="category.id"
                :color="category.color"
                :value="transaction.value"
                :icon="category.icon"
                :type="transaction.type"
                :key="transaction.id"
                v-for="transaction in this.category.transactions"
            />
        </ul>
        <div
            v-if="this.category.transactions.length == 0"
            class="text-amber-400 font-bold text-center text-xl h-50vh grid place-items-center"
        >
            Sem
            {{ this.category.type == "expense" ? "despesas" : "receitas" }} de
            {{ category.title }} nesse mês.
        </div>
    </Layout>
</template>
