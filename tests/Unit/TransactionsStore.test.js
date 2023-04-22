import { createPinia, setActivePinia } from "pinia";
import { beforeEach, describe, it, expect } from "vitest";
import { useTransactionsStore } from "@/stores/transactions";

describe("Transactions store", () => {
    let transactions;
    beforeEach(() => {
        setActivePinia(createPinia());
        transactions = useTransactionsStore();
    });

    it("fetches the list of transactions", async () => {
        await transactions.fetchTransactions();
        expect(transactions.list.length).toBe(3);
    });

    it("fetches the list of categories", async () => {
        await transactions.fetchCategories();
        expect(transactions.categories.length).toBe(2);
    });
});
