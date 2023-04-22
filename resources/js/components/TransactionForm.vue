<script>
import Input from "./Input.vue";
import Select from "./Select.vue";
import { router } from "@inertiajs/vue3";
export default {
    props: {
        categories: Object,
        close: Function,
    },
    data() {
        return {
            value: "",
            type: "expense",
            categoryList: this.categories.filter(
                (cat) => cat.type == "expense"
            ),
            date: new Date().toISOString().substring(0, 10),
            valueInputType: "text",
        };
    },
    watch: {
        type() {
            this.changeCats();
        },
    },
    methods: {
        submit() {
            const form = document.querySelector("#new_transaction");
            let formData = new FormData(form);
            let data = {};
            for (let [key, value] of formData) {
                data[key] = value;
            }
            data["category_id"] = data.category;
            delete data.category;
            const isThereEmptyFields =
                !Object.values(data).filter((value) => value == "").length == 0;
            if (isThereEmptyFields) return;
            const exp = /^\w{0,3}\W?\s?(\d+)[.,](\d+)?,?(\d+)?$/g;
            const replacer = (f, group1, group2, group3) => {
                return group3
                    ? `${group1}${group2}.${group3}`
                    : `${group1}.${group2}`;
            };
            data["value"] = data.value.replace(exp, replacer);
            router.post("/transaction/store", data);
            this.close();
        },
        moneyMask() {
            this.value = new Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(Number(this.value) || 0);
        },
        unMask() {
            const exp = /^\w{0,3}\W?\s?(\d+)[.,](\d+)?,?(\d+)?$/g;
            const replacer = (f, group1, group2, group3) => {
                return group3
                    ? `${group1}${group2}.${group3}`
                    : `${group1}.${group2}`;
            };
            this.value = this.value.replace(exp, replacer);
        },
        changeCats() {
            this.categoryList = this.categories.filter(
                (cat) => cat.type == this.type
            );
        },
    },
    components: {
        Input,
        Select,
    },
};
</script>
<template>
    <form
        class="grid gap-2 my-4 text-gray-200"
        @submit.prevent="submit"
        id="new_transaction"
    >
        <Input label="Título" type="text" name="title" id="title" />
        <Input
            label="Valor"
            :type="valueInputType"
            name="value"
            id="value"
            v-model:inputValue="this.value"
            @blur="() => moneyMask()"
            @focus="() => unMask()"
        />
        <Input
            label="Data"
            type="date"
            name="date"
            id="date"
            v-model:inputValue="this.date"
        />
        <Select
            label="Tipo"
            name="type"
            id="type"
            v-model:inputValue="this.type"
        >
            <option value="expense">Despesa</option>
            <option value="income">Receita</option>
        </Select>
        <Select label="Categoria" name="category" id="category">
            <option v-for="cat in categoryList" :value="cat.id" selected>
                {{ cat.title }}
            </option>
        </Select>
        <button
            type="submit"
            class="mt-8 bg-amber-400 hover:bg-amber-300 transition-all duration-300 text-white p-3 rounded-md"
        >
            Enviar
        </button>
    </form>
</template>
