<template>
    <div>
        <header class="sticky-top">
            <navbar></navbar>
        </header>
        <main>
            <div class="container" style="padding-top: 1rem;">
                <message></message>
                <router-view></router-view>
            </div>
        </main>
        <footer class="fixed-bottom"> 
            <footer-component></footer-component>
        </footer>
    </div>
</template>

<script>
import Message from './components/Message.vue';
import Navbar from './components/Navbar.vue';
import FooterComponent from './components/Footer.vue';
import { UNAUTHORIZED , INTERNAL_SERVER_ERROR } from './util';

export default {
    components: {
        Message,
        Navbar,
        FooterComponent
    },
    computed: {
        errorCode() {
            return this.$store.state.error.code
        }
    },
    watch: {
        errorCode: {
            async handler(val) {
                if(val === INTERNAL_SERVER_ERROR) {
                    this.$router.push('/500')
                } else if(val === UNAUTHORIZED) {
                    await axios.get('/api/refresh-token')
                    this.$store.commit('auth/setUser', null)
                    this.$router.push('/login')
                }
            },
            immediate: true,
            $route() {
                this.$store.commit('error/setCode', null)
            }
        }
    }
}
</script>
