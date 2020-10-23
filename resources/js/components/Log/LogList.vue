<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">Log Activity</h1>
                    <p class="lead">All activity in this website</p>
                </div>

                <div class="accordion" id="accordionExample">
                    <div class="card" v-for="(question, index) in questions" :key="index">
                        <div class="card-header" :id="'heading'+ index">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" :data-target="'#collapse'+ index" aria-expanded="false" :aria-controls="'collapse'+ index">
                            <!-- <span class="badge badge-pill badge-success">Solve</span>
                            <span class="badge badge-pill badge-secondary">New</span>
                            <span class="badge badge-pill badge-primary">2 Answer</span> -->
                                <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1"><span class="text-muted">{{ question.created_at }} : </span>{{  question.title }}</p>
                                <small class="text-muted">Causer</small>
                                </div>
                            </button>
                        </h2>
                        </div>
                        <div :id="'collapse'+ index" class="collapse" :aria-labelledby="'heading'+ index">
                        <div class="card-body">
                            {{ question.desc }}

                        </div>
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
                questions: [],
                loadingAnswer: false,
            }
        },

        mounted() {
            this.getCourseList()
        },

        methods: {
            getCourseList() {
                axios.get('/api/question').then(res => {
                    this.questions = res.data.splice(0, 4)
                    this.questions.foreach(q => q.push({ answerInput: '' }))

                })
            },

        }
    }
</script>
