<template>
    <div class="tweet-list">
        <div class="grid">
            <tweet
                class="grid__item"
                v-for="tweet in Tweets"
                :key="tweet.id"
                :item="tweet"
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
            console.log(response);

            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

            this.Tweets = response.data
        }
    },
    mounted() {
        this.fetchTweets()
    }
}
</script>
