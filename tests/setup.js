import { beforeAll, afterAll, afterEach } from "vitest";
import { setupServer } from "msw/node";
import { rest } from "msw";

const transactions = [
    {
        title: "Salário",
        value: 3000,
        category: {
            title: "Salário",
            icon: "fa fa-dollar-sign",
            color: "green",
        },
        type: "income",
    },
    {
        title: "Coca-cola retornável 2L",
        value: 7.5,
        category: {
            title: "Alimentação",
            icon: "fa fa-hamburger",
            color: "#ff00ff",
        },
        type: "expense",
    },
    {
        title: "Marmita",
        value: 17,
        category: {
            title: "Alimentação",
            icon: "fa fa-hamburger",
            color: "#ff00ff",
        },
        type: "expense",
    },
];

const categories = [
    {
        title: "Alimentação",
        color: "#ff0000",
        icon: "fas fa-hamburger",
        type: "expense",
    },
    {
        title: "Salário",
        color: "green",
        icon: "fa fa-dollar-sign",
        type: "income",
    },
];
export const handlers = [
    rest.get("http://localhost:3000/api/transactions", (req, res, ctx) => {
        return res(ctx.status(200), ctx.json(transactions));
    }),
    rest.get("http://localhost:3000/api/categories", (req, res, ctx) => {
        return res(ctx.status(200), ctx.json(categories));
    }),
];

const server = setupServer(...handlers);

beforeAll(() => server.listen({ onUnHandledRequest: "error" }));

afterAll(() => server.close());

afterEach(() => server.resetHandlers());
