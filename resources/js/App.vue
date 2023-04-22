<script>
import Transactions from "./components/Transactions.vue";
import TransactionSingle from "./components/TransactionSingle.vue";
import FlashMessage from "./components/FlashMessage.vue";
import { useRouterStore } from "./stores/router";
export default {
    data() {
        return {
            routerStore: useRouterStore(),
        };
    },
    components: {
        Transactions,
        TransactionSingle,
        FlashMessage,
    },
};
</script>
<template>
    <ul class="mt-4 mb-6 grid gap-2">
        <FlashMessage
            v-for="message in routerStore.messages"
            :error="message.error"
        >
            {{ message.content }}
        </FlashMessage>
    </ul>
    <Transition name="slide">
        <Transactions v-if="routerStore.currentRoute == 'transactions'" />
    </Transition>
    <Transition name="slide">
        <TransactionSingle
            :transaction_id="routerStore.transaction_id"
            v-if="routerStore.currentRoute == 'transactionSingle'"
        />
    </Transition>
</template>
<style scoped>
.slide-enter-active,
.slide-leave-active {
    transform: translate(0);
    opacity: 1;
    transition: 0.5s ease;
}

.slide-enter-from,
.slide-leave-to {
    transform: translateX(-50vw);
    opacity: 0;
}
</style>
