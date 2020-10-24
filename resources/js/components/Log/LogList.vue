<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">Log Activity</h1>
                    <p class="lead">All activity in this website</p>
                </div>

                <div class="accordion list-box" id="accordionExample">
                    <div class="card" v-for="(log, index) in logs" :key="index">
                        <div class="card-header" :id="'heading'+ index">
                        <p class="mb-0">
                            <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" :data-target="'#collapse'+ index" aria-expanded="false" :aria-controls="'collapse'+ index">
                                <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1"><span class="text-muted">{{ log.created_at }} : </span>{{  log.description }}</p>
                                <small class="text-muted">{{ log.causer ? log.causer.name : 'SYSTEM' }}</small>
                                </div>
                            </button>
                        </p>
                        </div>
                        <div :id="'collapse'+ index" class="collapse" :aria-labelledby="'heading'+ index">
                        <p class="card-body" style="white-space: pre-wrap">
                            {{ log.properties }}

                        </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                logs: [],
                loadingAnswer: false,
            }
        },

        mounted() {
            this.getCourseList()
        },

        methods: {
            getCourseList() {
                axios.get('/api/log').then(res => {
                    this.logs = res.data

                })
            },

        }
    }
</script>
