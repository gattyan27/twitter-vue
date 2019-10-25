<template>
    <div>
        <header class="sticky-top">
            <navbar></navbar>
        </header>
        <main>
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
        <footer class="fixed-bottom"> 
            <footer-component></footer-component>
        </footer>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import FooterComponent from './components/Footer.vue';

export default {
    components: {
        Navbar,
        FooterComponent
    }
}
</script>
