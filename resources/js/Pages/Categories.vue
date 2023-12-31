<script>
import Layout from '../layout/Layout.vue'
import CategoryInfo from '../components/CategoryInfo.vue'
import CategoriesForm from '../components/CategoriesForm.vue'
import Modal from '../components/Modal.vue'
import { Head } from '@inertiajs/vue3'
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
} from 'chart.js'
import { Bar } from 'vue-chartjs'
ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)
export default {
    data() {
        return {
            isModalOpen: false,
        }
    },
    methods: {
        openModal() {
            this.isModalOpen = true
        },
        getExpensesTitles() {
            return this.categories
                .filter((category) => category.type == 'expense')
                .filter((category) => category.transactions.length > 0)
                .map((category) => category.title)
        },
        getExpensesDatasets() {
            return this.categories
                .filter((category) => category.type == 'expense')
                .filter((category) => category.transactions.length > 0)
                .map((category) =>
                    category.transactions
                        .map((tr) => tr.value)
                        .reduce((prev, cur) => prev + cur, 0)
                )
        },
        getExpensesColors() {
            return this.categories
                .filter((category) => category.type == 'expense')
                .filter((category) => category.transactions.length > 0)
                .map((category) => category.color)
        },
    },
    props: {
        categories: Object,
        errors: Object,
    },
    components: {
        Layout,
        Head,
        CategoryInfo,
        CategoriesForm,
        Modal,
        Bar,
    },
}
</script>
<template>
    <Layout>
        <Head title="Categorias" />
        <h2 class="text-gray-200 font-bold text-3xl text-center mb-8">
            Gastos no mês
        </h2>

        <Bar
            :options="{
                responsive: true,
                locale: 'br-BR',
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            }"
            :data="{
                labels: this.getExpensesTitles(),
                datasets: [
                    {
                        data: this.getExpensesDatasets(),
                        backgroundColor: this.getExpensesColors(),
                    },
                ],
            }"
        />
        <div class="flex justify-between items-center my-4 px-2 md:px-0">
            <h2 class="text-gray-200 font-bold text-3xl">Categorias</h2>

            <button
                class="bg-amber-500 hover:bg-amber-400 transition-all duration-300 text-white p-3 rounded-full md:rounded-md flex md:block items-center justify-center aspect-square md:aspect-auto"
                @click="this.openModal"
            >
                <span class="hidden md:inline"> Nova categoria </span>
                <span class="inline md:hidden">
                    <i class="fa fa-plus"></i>
                </span>
            </button>
        </div>
        <ul class="grid gap-3 max-h-4/5-screen overflow-auto px-2 md:px-0">
            <CategoryInfo
                v-for="category in this.categories"
                :category="category"
            />
        </ul>
        <Transition>
            <Modal v-if="isModalOpen" :close="() => (this.isModalOpen = false)">
                <CategoriesForm
                    :errors="this.errors ?? []"
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
