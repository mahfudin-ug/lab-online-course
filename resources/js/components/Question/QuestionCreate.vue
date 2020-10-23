<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">Ask Question</h1>
                    <p class="lead">Feel free to ask if you have any trouble in this web</p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Question Subject</label>
                            <input v-model="subjectInput" :disabled="loadingForm" type="text" class="form-control" placeholder="Enter subject" required>
                            <small class="form-text text-muted">Only your main idea of question</small>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea v-model="descInput" :disabled="loadingForm" class="form-control" rows="3" placeholder="Explain your question here"></textarea>
                        </div>

                        <button @click="submitQuestion" :disabled="loadingForm" type="button" class="btn btn-primary">{{ loadingForm ? 'Loading...' : 'Submit' }}</button>

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
                loadingForm: false,
                subjectInput: '',
                descInput: '',

            }
        },

        mounted() {
        },

        methods: {
            submitQuestion() {
                let title = this.subjectInput.trim();
                let desc = this.descInput.trim();

                if (title == '' || desc == '') {
                    alert('Subject and Description field is required bro.')
                    return
                }

                this.loadingForm = true
                axios.post(`/api/question/`, {title, desc})
                    .then(res => {
                        console.log(res)
                        this.loadingForm = false
                        this.subjectInput = ''
                        this.descInput = ''
                    })

            }

        }
    }
</script>
