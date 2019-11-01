<template>
    <div v-if="tweet" class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-header p-3 w-100 d-flex">
                        {{tweet.user.name}}
                    </div>
                    <div class="card-body">
                            {{tweet.text}}
                    </div>
                    <div class="card-footer py-1 d-flex justify-content-end bg-white">
                        <div class="d-flex align-items-center">
                                <i class="fas fa-heart fa-fw text-primary"></i>
                                <p class="mb-0 text-secondary">10</p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
import { OK } from '../util'

export default {
    props: {
        id: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            tweet: []
        }
    },
    methods: {
        async fetchTweet() {
            const response = await axios.get(`/api/tweets/${this.id}`)

            if(response.status !== OK) {
                this.$store.commit('error/setConde', response.status)
                return false
            }
            console.log(response)
            this.tweet = response.data
        }
    },
    watch: {
        $route: {
            async handler () {
                await this.fetchTweet()
            },
            immediate: true
        }
    }

}
</script>