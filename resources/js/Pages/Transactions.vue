<script>
import TransactionInfo from "../components/TransactionInfo.vue";
import TransactionSummary from "../components/TransactionSummary.vue";
import Modal from "../components/Modal.vue";
import TransactionForm from "../components/TransactionForm.vue";
import Layout from "../layout/Layout.vue";
import { Head } from "@inertiajs/vue3";
export default {
    props: {
        transactions: Object,
        categories: Object,
    },
    data() {
        return {
            isModalOpen: false,
        };
    },
    methods: {
        closeModal() {
            this.isModalOpen = false;
        },
    },
    computed: {
        incomes() {
            return this.transactions
                .filter((transaction) => transaction.type == "income")
                .map((transaction) => transaction.value)
                .reduce((prev, cur) => prev + cur, 0);
        },
        expenses() {
            return this.transactions
                .filter((transaction) => transaction.type == "expense")
                .map((transaction) => transaction.value)
                .reduce((prev, cur) => prev + cur, 0);
        },
    },
    components: {
        TransactionInfo,
        TransactionSummary,
        Modal,
        TransactionForm,
        Head,
        Layout,
    },
};
</script>
<template>
    <Head title="Suas transações" />
    <Layout>
        <TransactionSummary
            :incomes="incomes"
            :expenses="expenses"
            :balance="incomes - expenses"
        />
        <div class="w-full">
            <div class="flex justify-between items-center my-4 px-2 md:px-0">
                <h2 class="text-gray-200 font-bold text-3xl">Transações</h2>
                <button
                    class="bg-amber-500 hover:bg-amber-400 transition-all duration-300 text-white p-3 rounded-full md:rounded-md flex md:block items-center justify-center aspect-square md:aspect-auto"
                    @click="() => (this.isModalOpen = true)"
                >
                    <span class="hidden md:inline"> Nova transação </span>
                    <span class="inline md:hidden">
                        <i class="fa fa-plus"></i>
                    </span>
                </button>
            </div>
            <ul
                class="grid gap-3 max-h-4/5-screen overflow-auto px-2 md:px-0"
                v-if="this.transactions.length > 0"
            >
                <TransactionInfo
                    :id="transaction.id"
                    :title="transaction.title"
                    :category="transaction.category.title"
                    :category_id="transaction.category.id"
                    :color="transaction.category.color"
                    :value="transaction.value"
                    :icon="transaction.category.icon"
                    :type="transaction.type"
                    :key="transaction.id"
                    v-for="transaction in this.transactions"
                />
            </ul>
            <div
                v-if="this.transactions.length == 0"
                class="text-amber-400 font-bold text-center text-xl h-50vh grid place-items-center"
            >
                Nenhuma transação cadastrada, adicione sua primeira clicando no
                botão acima!
            </div>
        </div>
        <Transition>
            <Modal v-if="isModalOpen" :close="() => (this.isModalOpen = false)">
                <TransactionForm
                    :categories="this.categories"
                    :close="() => (this.isModalOpen = false)"
                />
            </Modal>
        </Transition>
    </Layout>
</template>
<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
