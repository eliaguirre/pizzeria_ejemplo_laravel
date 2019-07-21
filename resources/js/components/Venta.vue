<template>
<form>
    <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title  text-center">Pizzeria la pizzeria</h5>
                    <h5 class="card-title  text-center">Ticket de compra</h5>
                    <ul class="list-group list-group-flush">
                        <table class="table table-sm">
                            <tbody>
                                <tr v-for="n in pizzas_in_order" :key="n.id">
                                    <td>{{n.cantidad}}</td>
                                    <td>{{n.name}}</td>
                                    <td>{{ Number.parseFloat(n.price*n.cantidad).toFixed(2) }}</td>
                                    <td>
                                        <a href="#" class="text text-danger" v-on:click="eliminar(n)"> del </a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">Total: </td>
                                    <td colspan="2">{{ showTotal()}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </ul>
                </div>
            </div>
            <button type="button" class="btn btn-primary mt-4 float-right" v-on:click="guardar()"> Save </button>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div v-for="n in pizzas" class="col-md-3 mt-2" v-on:click="addPizzaToOrder(n)">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{n.name}}</h5>
                            <p class="card-text">{{n.price}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</template>

<script>
export default {
    data() {
        return {
            orden: {
                pizzas: [],
            },
            isShowingAdd: false,
            pizzas: [],
            pizzas_in_order: {},
            validationErrors: ''
        }
    },
    methods: {
        showPizzas() {
            this.$http.get('/venta/pizzas/list').then(response => {
                this.pizzas = response.body;
            }, response => {});
        },
        addPizzaToOrder(pizza) {
            if (!this.pizzas_in_order.hasOwnProperty(pizza.id)) {
                this.pizzas_in_order[pizza.id] = {
                    name: pizza.name,
                    id: pizza.id,
                    price: pizza.price,
                    cantidad: 0
                }
            }
            this.pizzas_in_order[pizza.id].cantidad += 1;
            this.$forceUpdate()
        },
        showTotal() {
            var total = 0;
            for (var i in this.pizzas_in_order) {
                total += this.pizzas_in_order[i].cantidad * this.pizzas_in_order[i].price
            }
            return  Number.parseFloat(total).toFixed(2)
        },
        guardar() {
            this.$http.post('/venta/order/add', {
                pizzas: this.pizzas_in_order,
            }).then(response => {
                this.validationErrors = '';
                this.pizzas_in_order = {};
                this.$forceUpdate()
            }).catch(error => {
                console.log(error);
                if (error.status == 422) {
                    this.validationErrors = error.data.errors;
                }
            });
        },
        eliminar(pizza) {
            if (this.pizzas_in_order.hasOwnProperty(pizza.id)) {
                this.pizzas_in_order[pizza.id].cantidad -= 1;
                if (this.pizzas_in_order[pizza.id].cantidad <= 0) {
                    delete this.pizzas_in_order[pizza.id];
                }
                this.$forceUpdate()
            }
        }
    },
    created() {
        this.showPizzas();
    }
}
</script>
