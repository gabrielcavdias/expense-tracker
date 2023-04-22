<script>
export default {
    data() {
        return { classes: "" };
    },
    props: {
        error: Boolean,
    },
    methods: {
        fadeout() {
            this.classes =
                "transition-all duration-300 -translate-x-24 opacity-0";
            setTimeout(() => (this.classes = "hidden"), 400);
        },
    },
};
</script>
<template>
    <li
        :class="`${classes} ${
            error ? 'bg-red-500' : 'bg-green-500'
        } text-white px-3 py-1 rounded-lg shadow-md`"
        @click="fadeout()"
    >
        <slot></slot>
    </li>
</template>
