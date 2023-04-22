<script>
import Layout from "../layout/Layout.vue";
import CategoryInfo from "../components/CategoryInfo.vue";
import CategoriesForm from "../components/CategoriesForm.vue";
import Modal from "../components/Modal.vue";
import { Head } from "@inertiajs/vue3";
export default {
    data() {
        return {
            isModalOpen: false,
        };
    },
    methods: {
        openModal() {
            this.isModalOpen = true;
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
    },
};
</script>
<template>
    <Layout>
        <Head title="Categorias" />
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
