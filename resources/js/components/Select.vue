<script>
export default {
    inheritAttrs: false,
    props: { error: String, label: String, inputValue: String },
};
</script>
<template>
    <div class="relative">
        <label
            class="block text-gray-200 font-bold text-xl"
            :for="$attrs['id']"
        >
            {{ label }}
        </label>
        <select
            class="block appearance-none w-full bg-indigo-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-indigo-50 focus:border-gray-500"
            v-bind="$attrs"
            :value="inputValue"
            @change="$emit('update:inputValue', $event.target.value)"
        >
            <slot></slot>
        </select>
        <div
            class="pointer-events-none absolute top-1/2 translate-y-1/2 right-0 flex items-center px-2 text-gray-700"
        >
            <svg
                class="fill-current h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
            >
                <path
                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                />
            </svg>
        </div>
    </div>
    <div class="text-red-500 font-bold" v-if="error">
        {{ error }}
    </div>
</template>
