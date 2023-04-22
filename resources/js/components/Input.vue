<script>
export default {
    props: {
        label: String,
        error: String,
        inputValue: String,
    },
};
</script>
<template>
    <label class="block text-gray-200 font-bold text-xl" :for="$attrs['id']">
        {{ label }}
    </label>
    <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outer-glow focus:shadow-indigo-400"
        v-bind="$attrs"
        :value="inputValue"
        @input="$emit('update:inputValue', $event.target.value)"
    />
    <div class="text-red-500 font-bold" v-if="error">
        {{ error }}
    </div>
</template>
