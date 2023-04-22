import { describe, it, expect, beforeEach } from "vitest";
import { mount } from "@vue/test-utils";
import TransactionSummary from "@/components/TransactionSummary.vue";

describe("TransactionSummary.vue", () => {
    let wrapper;
    const formatedValue = (value) =>
        new Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(value);
    beforeEach(() => {
        wrapper = mount(TransactionSummary, {
            props: {
                incomes: 3000,
                expenses: 2500,
                balance: 500,
            },
        });
    });

    it("Display incomes card", () => {
        expect(wrapper.find("#incomes").text()).toBe(formatedValue(3000));
    });

    it("Display expenses card", () => {
        expect(wrapper.find("#expenses").text()).toBe(formatedValue(2500));
    });

    it("Display balance card", () => {
        expect(wrapper.find("#balance").text()).toBe(formatedValue(500));
    });
});
