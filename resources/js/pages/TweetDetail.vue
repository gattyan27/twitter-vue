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
                                <button 
                                class="tweet__action tweet__action--like"
                                :class="{ 'tweet_action--likes': tweet.liked_by_user }"
                                title="Like tweet"
                                @click.prevent="onLikeClick"
                            >
                                <i class="fas fa-heart fa-fw text-primary"></i>
                            </button>
                            <p class="mb-0 text-secondary">{{ tweet.likes_count }}</p>
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
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        }
    },
    methods: {
        async fetchTweet() {
            const response = await axios.get(`/api/tweets/${this.id}`)

            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status)
                return false
            }
            this.tweet = response.data
        },
        onLikeClick() {
            if(! this.isLogin) {
                alert('いいね機能を使うにはログインしてください。')
                return false
            }

            if(this.tweet.liked_by_user) {
                this.unlike()
            } else {
                this.like()
            }
        },
        async like() {
            const response = await axios.put(`/api/tweets/${this.id}/like`)

            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

            this.$set(this.tweet, 'likes_count', this.tweet.likes_count + 1)
            this.$set(this.tweet, 'liked_by_user', true)
        },
        async unlike() {
            const response = await axios.delete(`/api/tweets/${this.id}/like`)

            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

            this.$set(this.tweet, 'likes_count', this.tweet.likes_count - 1)
            this.$set(this.tweet, 'liked_by_user', false)
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