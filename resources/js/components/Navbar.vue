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
                        <li class="nav-item">
                            <button class="btn btn-md btn-primary">
                                ツイート
                            </button>
                        </li>
                        <li class="nav-item">
                            <router-link class="col-md-8 mb-3 text-right" to="/users">ユーザ一覧</router-link>
                        </li>
                        <li class="nav-item">
                            <img src="../../../public/user_image.png" alt="profile_image" class="rounded-circle" width="50" height="50">
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                user_name<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <router-link class="dropdown-item" to="#">プロフィール</router-link>
                                <router-link class="dropdown-item" to="/logout">ログアウト</router-link>
                            </div>
                        </li>
                        <li class="nav-item">
                            <router-link class="button button--link" to="/login">
                                Login / Register
                            </router-link>
                        </li>
                    </ul>
                </div>
            
        </div>
    </nav>
</template>