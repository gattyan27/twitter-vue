<template>
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header p-3 w-100 d-flex">
                        {{item.user.name}}
                    </div>
                    <div class="card-body">
                        <router-link :to="`/tweets/${item.id}`" style="text-decoration: none; color: black">
                            {{item.text}}
                        </router-link>
                    </div>
                    <div class="card-footer py-1 d-flex justify-content-end bg-white">
                        <div class="d-flex align-items-center">
                            <button 
                                class="tweet__action tweet__action--like"
                                :class="{ 'tweet_action--likes': item.liked_by_user }"
                                title="Like tweet"
                                @click.prevent="like"
                            >
                                <i class="fas fa-heart fa-fw text-primary"></i>
                            </button>
                            <p class="mb-0 text-secondary">{{ item.likes_count }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true
        }
    },
    methods: {
        like() {
            this.$emit('like', {
                id: this.item.id,
                liked: this.item.liked_by_user
            })
        }
    }
}
</script>
