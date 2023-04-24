<script>
export default {
    data() {
        return {
            months: [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro",
            ],
            isSelectorOpen: false,
        };
    },
    computed: {
        monthToNumber() {
            return +this.$page.props.month;
        },
    },
    methods: {
        updateDate(month) {
            let numberMonth = this.months.indexOf(month) + 1;
            this.$emit("changeDate", { month: numberMonth });
            this.isSelectorOpen = false;
        },
        toggleSelector() {
            this.isSelectorOpen = !this.isSelectorOpen;
        },
    },
    emits: ["changeDate"],
};
</script>
<template>
    <button @click="toggleSelector" class="flex items-center gap-3 py-1 px-3">
        {{ this.months[monthToNumber - 1] }}
        <i class="fa fa-chevron-down text-sm"></i>
    </button>
    <div
        v-if="isSelectorOpen"
        class="absolute w-full z-10 top-9 -translate-x-1/2 left-1/2 overflow-hidden bg-gray-700 rounded-md grid grid-cols-2 md:grid-cols-4"
    >
        <button
            v-for="month in months"
            class="p-3 text-center hover:bg-amber-400 hover:text-gray-900"
            @click="updateDate(month)"
        >
            {{ month }}
        </button>
    </div>
</template>
