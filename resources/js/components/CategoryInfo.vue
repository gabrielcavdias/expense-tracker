<script>
import { Link } from "@inertiajs/vue3";
export default {
    props: {
        category: Object,
    },
    components: {
        Link,
    },
};
</script>
<template>
    <li class="flex items-center gap-3 relative">
        <span
            class="flex justify-center items-center w-12 aspect-square text-white rounded-full cursor-pointer"
            id="icon"
        >
            <i :class="this.category.icon"></i>
        </span>
        <div class="text-gray-200 md:text-xl cursor-pointer">
            <Link :href="`/category/${category.id}`" id="title">
                {{ category.title }}
            </Link>
        </div>
        <div
            :class="`ml-auto ${
                category.type == 'expense' ? 'text-red-600' : 'text-green-500'
            } md:text-2xl font-bold`"
            id="value"
        >
            {{ category.type == "expense" ? "Despesa" : "Receita" }}
        </div>
    </li>
</template>
<style scoped>
#icon {
    background-color: v-bind("category.color");
}
</style>
