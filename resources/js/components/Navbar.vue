<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <router-link class="navbar-brand" to="/">
                VueTwitter
            </router-link>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Right Side Of Navbar -->
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item" v-if="isLogin">
                            <button class="btn btn-md btn-primary">
                                ツイート
                            </button>
                        </li>
                        <li class="nav-item">
                            <router-link class="col-md-8 mb-3 text-right" to="/users">ユーザ一覧</router-link>
                        </li>
                        <li class="nav-item" v-if="isLogin">
                            <img src="../../../public/user_image.png" alt="profile_image" class="rounded-circle" width="50" height="50">
                        </li>
                        <li class="nav-item" v-if="isLogin">
                            <router-link class="col-md-8 mb-3 text-right" to="#">プロフィール</router-link>
                        </li>
                        <li class="nav-item" v-else>
                            <router-link class="col-md-8 mb-3 text-right" to="/login">
                                Login / Register
                            </router-link>
                        </li>
                    </ul>
                </div>
            
        </div>
    </nav>
</template>

<script>
export default {
    computed: {
        isLogin () {
            return this.$store.getters['auth/check'];
        },
        username () {
            return this.$store.getters['auth/username'];
        }
    }
}
</script>