import axios from "axios";
import { defineStore } from "pinia";
export const useTransactionsStore = defineStore("transactions", {
    state() {
        return {
            list: [],
            categories: [],
        };
    },
    actions: {
        async fetchTransactions() {
            try {
                let response = await axios.get("/api/transactions");
                this.list = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        async fetchCategories() {
            try {
                let response = await axios.get("/api/categories");
                this.categories = response.data;
            } catch (error) {
                console.log(error);
            }
        },
    },
});
