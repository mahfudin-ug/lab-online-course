<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron" v-if="course.instructor">
                    <h1 class="display-4">Forum: <small class="text-muted">{{ course.title }}</small> </h1>
                    <p class="lead">By {{ course.instructor.name }}</p>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <chat-box />
                    </div>
                    <div class="col-md-5">
                        <chat-user-list />
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['courseId'],
        data() {
            return {
                course: {},
                isJoin: false
            }
        },

        mounted() {
            this.getCourse()
        },

        methods: {
            getCourse() {
                axios.get(`/api/course/${this.courseId}`).then(res => {
                    this.course = res.data

                    console.log(this.course)
                })
            },

        }
    }
</script>
