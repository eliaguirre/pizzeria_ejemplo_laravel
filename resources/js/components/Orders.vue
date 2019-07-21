<template>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Order At</th>
                <th>Pizzas</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="n in orders">
                <td>{{ n.id }}</td>
                <td>{{ n.name }}</td>
                <td>{{ n.created_at }}</td>
                <td>{{ n.pizzas  }}</td>
                <td>{{ Number.parseFloat(n.total).toFixed(2) }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
export default {
    data() {
        return {
            orders: [],
            validationErrors: ''
        }
    },
    methods: {
        show() {
            this.$http.get('/admin/orders/list').then(response => {
                this.orders = response.body;
            }, response => {});
        },
    },
    created() {
        this.show();
    }
}
</script>
