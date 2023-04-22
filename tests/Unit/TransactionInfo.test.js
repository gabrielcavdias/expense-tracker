import { describe, it, expect, beforeEach } from "vitest";
import { mount } from "@vue/test-utils";
import TransactionInfo from "@/components/TransactionInfo.vue";

describe("TransactionInfo.vue", () => {
    let wrapper;
    beforeEach(() => {
        wrapper = mount(TransactionInfo, {
            props: {
                title: "Coca-cola 2L retornável",
                category: "Alimentação",
                value: 7.5,
                icon: "fa fa-hamburger",
                type: "expense",
                color: "#ff00ff",
            },
        });
    });

    it("Display transaction title", () => {
        expect(wrapper.find("#title").text()).toBe("Coca-cola 2L retornável");
    });

    it("Display transaction category", () => {
        expect(wrapper.find("#category").text()).toBe("Alimentação");
    });

    it("Display transacation value", () => {
        let formatedValue = new Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(7.5);
        expect(wrapper.find("#value").text()).toBe(formatedValue);
    });

    it("Display transaction icon", () => {
        expect(wrapper.find(".fa.fa-hamburger").exists()).toBe(true);
    });

    it("Display transaction as expense", () => {
        expect(wrapper.find(".text-red-600").exists()).toBe(true);
    });
});
