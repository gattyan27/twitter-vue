<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header p-3 w-100 d-flex">
                        {{item.user.name}}
                    </div>
                    <div class="card-body">
                        <router-link to="#" style="text-decoration: none; color: black">
                            {{item.text}}
                        </router-link>
                    </div>
                    <div class="card-footer py-1 d-flex justify-content-end bg-white">
                        <router-link to="#">...</router-link>
                        <div class="d-flex align-items-center">
                                <i class="fas fa-heart fa-fw text-primary"></i>
                                <p class="mb-0 text-secondary">10</p>
                        </div>
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
    }
}
</script>
