<template>
    <div class="tweet-list">
        <div class="grid">
            <tweet
                class="grid__item"
                v-for="tweet in Tweets"
                :key="tweet.id"
                :item="tweet"
                @like="onLikeClick"
            ></tweet>
        </div>
        
    </div>
</template>

<script>
import { OK } from '../util';
import Tweet from '../components/Tweet.vue';


export default {
    components: {
        Tweet,
        
    },
    data() {
        return {
            Tweets: [],
        }
    },
    methods: {
        async fetchTweets() {
            const response = await axios.get('/api/tweets')

            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

            this.Tweets = response.data
        },
        onLikeClick({ id, liked }) {
            if(! this.$store.getters['auth/check']) {
                alert('いいね機能を使うにはログインしてください。')
                return false;
            }

            if(liked) {
                this.unlike(id)
            } else {
                this.like(id)
            }
        },
        async like(id) {
            const response = await axios.put(`/api/tweets/${id}/like`)

            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

            this.Tweets = this.Tweets.map(tweet => {
                if(tweet.id == response.data.tweet_id) {
                    tweet.likes_count += 1
                    tweet.liked_by_user = true
                }
                return tweet
            })
        },
        async unlike(id) {
            const response = await axios.delete(`/api/tweets/${id}/like`)

            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

            this.Tweets = this.Tweets.map(tweet => {
                if(tweet.id == response.data.tweet_id) {
                    tweet.likes_count -= 1
                    tweet.liked_by_user = false
                }
                return tweet
            })
        }
    },
    watch: {
        $route: {
            async handler () {
                await this.fetchTweets()
            },
            immediate: true
        }
    }
}
</script>
