<script>
export default {
    props: ["close"],
    methods: {
        onEscape(event) {
            if (event.keyCode === 27) {
                this.close();
            }
        },
    },
    created() {
        document.addEventListener("keydown", this.onEscape);
    },
    unmounted() {
        document.removeEventListener("keydown", this.onEscape);
    },
};
</script>
<template>
    <div
        class="fixed inset-0 z-10 bg-black bg-opacity-40 grid place-items-center px-2 md:px-0"
    >
        <div class="bg-gray-900 max-w-xl w-full rounded-xl p-3">
            <div class="flex justify-end p-3 text-xl">
                <button
                    class="text-gray-500 hover:text-red-500"
                    @click="this.close"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <slot></slot>
        </div>
    </div>
</template>
