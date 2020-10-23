<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">{{ course.title }}</h1>
                    <p class="lead">By {{ course.instructor.name }}</p>
                    <hr class="my-4">
                    <p>{{ course.desc }}</p>
                    <a @click="registerCourse" v-if="!isJoin" class="btn btn-primary btn-lg" role="button">Register Now</a>
                </div>

                <div class="accordion" id="accordionExample">
                    <h1 v-if="course.contents.length > 0">You will learn: </h1>
                    <h1 v-else>No Content in this course</h1>
                    <div class="card" v-for="(content, index) in course.contents" :key="index">
                        <div class="card-header" :id="'heading'+ index">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" :data-target="'#collapse'+ index" aria-expanded="false" :aria-controls="'collapse'+ index">
                            {{ content.title }}
                            </button>
                        </h2>
                        </div>
                        <div :id="'collapse'+ index" class="collapse" :aria-labelledby="'heading'+ index">
                        <div class="card-body">
                            {{ content.desc }}
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

            registerCourse() {
                axios.post(`/api/course/${this.courseId}/register`).then(res => {
                    console.log(res)
                })
            }
        }
    }
</script>
