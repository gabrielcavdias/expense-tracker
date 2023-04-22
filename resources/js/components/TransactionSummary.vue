<script>
export default {
    props: {
        incomes: Number,
        expenses: Number,
        balance: Number,
    },
    methods: {
        brl(value) {
            return new Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(value);
        },
    },
};
</script>
<template>
    <div
        class="grid grid-cols-2 gap-2 max-w-xs md:max-w-sm mx-auto text-gray-200"
    >
        <div class="relative col-span-2">
            <article
                class="py-3 pl-4 pr-12 rounded-xl text-sm flex flex-col items-center"
            >
                <p>
                    Saldo:
                    <span
                        class="mt-1 text-3xl md:text-4xl block font-bold"
                        id="balance"
                    >
                        {{ brl(incomes - expenses) }}
                    </span>
                </p>
            </article>
            <p
                class="text-red-500 font-bold absolute w-full text-center"
                v-if="incomes - expenses < 0"
            >
                Negativado
            </p>
        </div>
        <article class="py-3 pl-4 pr-12 rounded-xl text-sm">
            Receitas:
            <span
                class="text-xl md:text-3xl block text-emerald-500 font-bold"
                id="incomes"
            >
                {{ brl(incomes) }}
            </span>
        </article>
        <article class="py-3 pl-4 pr-12 rounded-xl text-sm">
            Despesas:
            <span
                class="text-xl md:text-3xl block text-red-500 font-bold"
                id="expenses"
            >
                {{ brl(expenses) }}
            </span>
        </article>
    </div>
</template>
