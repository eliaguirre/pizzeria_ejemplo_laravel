<template>
<form>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary float-right" @click="isShowingAdd ^= true">Add user</button>
        </div>
    </div>
    <hr />
    <div class="" v-show="isShowingAdd">
        <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
        <div class="form-group">
            <label> Email </label>
            <input type="email" class="form-control" v-model="user_temp.email" />
        </div>
        <div class="form-group">
            <label> Name </label>
            <input type="text" class="form-control" v-model="user_temp.name" />
        </div>
        <div class="form-group">
            <label> Role </label>
            <select class="form-control" v-model="user_temp.role">
                <option>Choose one</option>
                <option value="venta">Ventas</option>
                <option value="admin">Administrador</option>
            </select>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> Password </label>
                    <input type="password" class="form-control" v-model="user_temp.password" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label> Confirm password </label>
                    <input type="password" class="form-control" v-model="user_temp.repassword" />
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-default" @click="isShowingAdd ^= true"> Cancel </button>
        <button type="button" class="btn btn-primary" v-on:click="guardar()"> Guardar </button>
    </div>
    <table class="table" v-show="!isShowingAdd">
        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Role</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="n in users">
                <td>{{ n.email }}</td>
                <td>{{ n.name }}</td>
                <td>{{ n.role.toUpperCase() }}</td>
                <td><a href="#" class="text text-danger" v-on:click="eliminar(n)"> delete </a></td>
            </tr>
        </tbody>
    </table>
</form>
</template>

<script>
export default {
    data() {
        return {
            user_temp: {
                email: '',
                name: '',
                role: '',
                password: '',
                repassword: ''
            },
            isShowingAdd: false,
            users: [],
            validationErrors: ''
        }
    },
    methods: {
        showUsers() {
            this.$http.get('/admin/users/list').then(response => {
                this.users = response.body;
            }, response => {});
        },
        guardar() {
            this.$http.post('/admin/users/add', {
                email: this.user_temp.email,
                name: this.user_temp.name,
                role: this.user_temp.role,
                password: this.user_temp.password,
                password_confirmation: this.user_temp.repassword,
            }).then(response => {
                this.user_temp.email = '';
                this.user_temp.role = '';
                this.user_temp.name = '';
                this.user_temp.password = '';
                this.user_temp.repassword = '';
                this.validationErrors = '';
                this.users = response.body;
                this.isShowingAdd = false;
            }).catch(error => {
                console.log(error);
                if (error.status == 422) {
                    this.validationErrors = error.data.errors;
                }
            });
        },
        eliminar(user) {
            this.$http.post('/admin/users/delete', {
                id: user.id
            }).then(response => {
                this.users = response.body;
            }, response => {
                alert('Error');
            });
        }
    },
    created() {
        this.showUsers();
    }
}
</script>
