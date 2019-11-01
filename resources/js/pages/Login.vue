<template>
    <div class="container">
        <div class="row justify-content-center d-flex">
            <div class="flex-column" style="padding-bottom: 1rem;">
                <ul class="tab">
                    <li 
                        class="tab__item"
                        :class="{'tab__item--active': tab === 1}"
                        @click="tab = 1"
                    >Login</li>
                    <li
                        class="tab__item"
                        :class="{'tab__item--active': tab === 2}"
                        @click="tab = 2"
                    >Register</li>
                </ul>
            </div>
            <div class="col-md-8 flex-column">
                <div class="card">
                    <div class="card-body" v-show="tab === 1">
                        <form class="form" @submit.prevent="login">
                            <div v-if="loginErrors" class="errors">
                                <ul v-if="loginErrors.email">
                                    <li v-for="msg in loginErrors.email" :key="msg">{{ msg }}</li>
                                </ul>
                                <ul v-if="loginErrors.password">
                                    <li v-for="msg in loginErrors.password" :key="msg">{{ msg }}</li>
                                </ul>
                            </div>
                            <div class="form-group row">
                                <label for="login-email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <input type="text" class="col-md-6" id="login-email" v-model="loginForm.email">
                            </div>
                            <div class="form-group row">
                                <label for="login-password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <input type="password" class="col-md-6" id="lagin-password" v-model="loginForm.password">
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="button btn-primary">login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" v-show="tab === 2">
                        <form class="form" @submit.prevent="register">
                            <div v-if="registerErrors" class="errors">
                                <ul v-if="registerErrors.name">
                                    <li v-for="msg in registerErrors.name" :key="msg">{{ msg }}</li>
                                </ul>
                                <ul v-if="registerErrors.email">
                                    <li v-for="msg in registerErrors.email" :key="msg">{{ msg }}</li>
                                </ul>
                                <ul v-if="registerErrors.password">
                                    <li v-for="msg in registerErrors.password" :key="msg">{{ msg }}</li>
                                </ul>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Name</label>
                                <input type="text" class="col-md-6" id="username" v-model="registerForm.name">
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <input type="text" class="col-md-6" id="email" v-model="registerForm.email">
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <input type="password" class="col-md-6" id="password" v-model="registerForm.password">
                            </div>
                            <div class="form-group row">
                                <label for="password-confirmation" class="col-md-4 col-form-label text-md-right">Password (confirm)</label>
                                <input type="password" class="col-md-6" id="password-confirmation" v-model="registerForm.password_confirmation">
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="button btn-primary">register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    data() {
        return {
            tab: 1,
            loginForm: {
                email: '',
                password: ''
            },
            registerForm: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus,
            loginErrors: state => state.auth.loginErrorMessages,
            registerErrors: state => state.auth.registerErrorMessages,
        })
    },
    methods: {
        async login() {
            await this.$store.dispatch('auth/login', this.loginForm)

            if(this.apiStatus) {
                this.$router.push('/')
            }
        },
        async register() {
            // authストアのregisterアクションを呼び出す
            await this.$store.dispatch('auth/register', this.registerForm)

            // トップページに移動する
            if(this.apiStatus) {
                this.$router.push('/')
            }
        },
        clearError() {
            this.$store.commit('auth/setLoginErrorMessages', null)
            this.$store.commit('auth/setRegisterErrorMessages', null)
        },
        created() {
            this.clearError();
        }
    },
}
</script>