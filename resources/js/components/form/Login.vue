<template>
<div style='margin-top:60px'>
    <h1 class="h3 mb-3 font-weight-normal">Sign in to PIZZERIA</h1>
    <label for="inputEmail" class="sr-only">Email</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</div>
</template>

<script>
export default {
    mounted() {
    }
}
</script>
