<script>
import { Link } from "@inertiajs/vue3";
export default {
    props: {
        id: Number,
        title: String,
        category: String,
        category_id: Number,
        color: String,
        value: Number,
        icon: String,
        type: String,
    },
    data() {
        return {};
    },
    methods: {
        brl(value) {
            return new Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(value);
        },
    },
    components: {
        Link,
    },
};
</script>
<template>
    <li class="flex items-center md:items-start gap-3 relative">
        <span
            class="flex justify-center items-center w-12 aspect-square text-white rounded-full cursor-pointer"
            id="icon"
        >
            <i :class="icon"></i>
        </span>
        <div class="text-gray-200 md:text-xl cursor-pointer">
            <Link :href="`/transaction/${id}`" id="title">
                {{ title }}
            </Link>
            <Link
                :href="`/category/${category_id}`"
                class="text-sm text-gray-500 block"
                id="category"
            >
                {{ category }}
            </Link>
        </div>
        <div
            :class="`ml-auto ${
                type == 'expense' ? 'text-red-600' : 'text-green-500'
            } md:text-2xl font-bold`"
            id="value"
        >
            {{ brl(value) }}
        </div>
    </li>
</template>
<style scoped>
#icon {
    background-color: v-bind("color");
}
</style>
