<template>
    <footer class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" v-if="isLogin">
                    <button class="" @click="logout">Logout</button>
                </li>
            </ul>
        </div>
    </footer>
</template>

<script>
export default {
    methods: {
        async logout () {
            await this.$store.dispatch('auth/logout');

            this.$router.push('/login');
        }
    },
    computed: {
        isLogin () {
            return this.$store.getters['auth/check'];
        }
    }
}
</script>