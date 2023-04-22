<script>
import Input from "./Input.vue";
import Select from "./Select.vue";
import { router } from "@inertiajs/vue3";

export default {
    data() {
        return {
            form: {
                title: "",
                type: "expense",
                color: "#f59e0b",
                icon: "fa fa-solid fa-font-awesome",
            },
        };
    },
    components: {
        Input,
        Select,
    },
    props: ["errors", "close"],
    methods: {
        submit() {
            router.post("/category/store", this.form);
            setTimeout(() => {
                console.log("Rodei");
                if (Object.entries(this.errors).length == 0) this.close();
            }, 300);
        },
    },
};
</script>
<template>
    <form class="grid gap-2 my-4 text-gray-200" @submit.prevent="submit">
        <Input
            label="Título"
            type="text"
            name="title"
            id="title"
            :error="errors.title"
            v-model:inputValue="form.title"
        />
        <Select
            label="Tipo"
            name="type"
            id="type"
            :error="errors.type"
            v-model:inputValue="form.type"
        >
            <option value="expense">Despesa</option>
            <option value="income">Receita</option>
        </Select>
        <div>
            <p
                class="block text-gray-200 font-bold text-xl"
                :for="$attrs['id']"
            >
                Cor
            </p>
            <label
                for="color"
                class="mt-2 inline-flex items-center gap-4 text-xl pr-12 cursor-pointer"
            >
                <span class="bg-main-color aspect-square w-6 border"></span>
                <p>{{ form.color }}</p>
            </label>
            <input
                type="color"
                name="color"
                id="color"
                v-model="form.color"
                class="hidden"
            />
        </div>
        <div>
            <Input
                label="Ícone"
                name="icon"
                id="icon"
                :error="errors.icon"
                v-model:inputValue="form.icon"
            />
            <span
                class="mt-2 bg-main-color w-12 aspect-square grid place-items-center rounded-full"
            >
                <i :class="`${form.icon} text-xl text-white`"></i>
            </span>
        </div>
        <button
            type="submit"
            class="mt-8 bg-amber-400 hover:bg-amber-300 transition-all duration-300 text-white p-3 rounded-md"
        >
            Enviar
        </button>
    </form>
</template>
<style scoped>
.bg-main-color {
    background-color: v-bind("form.color");
}
</style>
