<template>
    <div v-show="value" class="tweet-form">
        <div class="errors" v-if="errors">
            <ul v-if="errors.text">
                <li v-for="msg in errors.text" :key="msg">{{ msg }}</li>
            </ul>
        </div>
        <h2 class="title">新規投稿</h2>
        <div class="panel" v-show="loading">
            <Loader>ツイート投稿中...</Loader>
        </div>
        <form class="form" v-show="! loading" @submit.prevent="submit">
            <textarea class="form__item form-control" rows="4" v-model="text"></textarea>
            <button type="submit" class="button button--inverse">ツイート</button>
        </form>
    </div>
</template>

<script>
import { CREATED, UNPROCESSABLE_ENTITY } from '../util';
import Loader from './Loader.vue';

export default {
    components: {
        Loader
    },
    data() {
        return{
            loading: false,
            text: null,
            errors: null
        }
    },
    props: {
        value: {
            type: Boolean,
            required: true
        }
    },
    methods: {
        reset() {
            this.text = null
            this.$el.querySelector('textarea').val = null
        },
        async submit() {
            this.loading = true;

            const formData = new FormData();
            const text = this.text;
            formData.append('text', text);
            const response = await axios.post('/api/tweets', formData);

            this.loading = false;

            if(response.status === UNPROCESSABLE_ENTITY) {
                this.errors = response.data.errors
                return
            };
            this.reset();
            this.$emit('input', false);
            
            if(response.status !== CREATED) {
                this.$store.commit('error/setCode', response.status);
                return false;
            };

            this.$store.commit('message/setContent', {
                content: '新規ツイートが投稿されました',
                timeout: 6000
            })

            this.errors = null;

            this.$router.push(`/tweets/${response.data.id}`);
        }
    }
}
</script>