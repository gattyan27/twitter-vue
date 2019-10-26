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
import { mapState, mapGetters } from 'vuex';

export default {
    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus
        }),
        ...mapGetters({
            isLogin: 'auth/check'
        })
    },
    methods: {
        async logout () {
            await this.$store.dispatch('auth/logout');

            if(this.apiStatus){
                this.$router.push('/login');
            }
        }
    },
}
</script>