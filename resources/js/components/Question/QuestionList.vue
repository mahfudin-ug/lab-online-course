<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">Question Management</h1>
                    <p class="lead">Answer with simple and understandable</p>
                </div>

                <div class="accordion list-box" id="accordionExample">
                    <h1 v-if="questions.length > 0">Please help them: </h1>
                    <h1 v-else>No question. So enjoy your time.</h1>
                    <div class="card" v-for="(question, index) in questions" :key="index">
                        <div class="card-header" :id="'heading'+ index">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" :data-target="'#collapse'+ index" aria-expanded="false" :aria-controls="'collapse'+ index">
                            <!-- <span class="badge badge-pill badge-success">Solve</span>
                            <span class="badge badge-pill badge-secondary">New</span>
                            <span class="badge badge-pill badge-primary">2 Answer</span> -->
                                <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ question.title }}</h5>
                                <small class="text-muted">3 days ago</small>
                                </div>
                            </button>
                        </h2>
                        </div>
                        <div :id="'collapse'+ index" class="collapse" :aria-labelledby="'heading'+ index">
                        <div class="card-body">
                            {{ question.desc }}

                            <hr>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ loadingForm ? 'Loading...' : 'Your Answer' }}</span>
                                </div>
                                <textarea :disabled="loadingForm" v-model="question.answerInput" @keydown="handleAnswer(question, $event)" class="form-control" placeholder="Give your answer..."></textarea>
                            </div>
                            <hr>

                            <div class="list-group">
                                <div v-for="answer in question.answers" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ answer.user.name }}</h5>
                                    </div>
                                    <p class="mb-1">{{ answer.answer }}</p>
                                    <small class="text-muted">{{ answer.created_at }}</small>
                                </div>
                            </div>

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
                loadingForm: false,
            }
        },

        mounted() {
            this.getCourseList()
        },

        methods: {
            getCourseList() {
                axios.get('/api/question').then(res => {
                    this.questions = res.data
                    this.questions.foreach(q => q.push({ answerInput: '' }))

                })
            },

            handleAnswer(question, e) {
                if (e.keyCode === 13 && !e.shiftKey) {
                    e.preventDefault()
                    this.submitAnswer(question, question.answerInput)
                }
            },

            submitAnswer(question, answer) {
                answer = answer.trim();

                if (answer == '') {
                    return
                }

                this.loadingForm = true
                axios.post(`/api/question/${question.id}/answer`, {answer})
                    .then(res => {
                        console.log(res)
                        this.loadingForm = false
                        this.getCourseList()
                    })

            }

        }
    }
</script>
