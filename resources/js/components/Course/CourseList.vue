<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">Course Management</h1>
                    <p class="lead">Believe it the more you sharing, the more you have.</p>
                </div>

                <div v-if="isInstructor" class="accordion">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header" id="heading-course-form">
                            <h2 class="mb-0">
                                <h4 class=" text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-course-form" aria-expanded="false" aria-controls="collapse-course-form">
                                Create New Course
                                </h4>
                            </h2>
                        </div>
                        <div id="collapse-course-form" class="collapse" aria-labelledby="heading-course-form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Course Subject</label>
                                    <input v-model="subjectCourseInput" :disabled="loadingForm" type="text" class="form-control" placeholder="Enter subject" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea v-model="descCourseInput" :disabled="loadingForm" class="form-control" rows="3" placeholder="Explain your question here"></textarea>
                                </div>

                                <button @click="submitCourse" :disabled="loadingForm" type="button" class="btn btn-primary">{{ loadingForm ? 'Loading...' : 'Submit' }}</button>

                            </div>

                        </div>
                    </div>

                </div>
                <br>

                <div class="accordion" id="accordionExample">
                    <h1 v-if="courses.length > 0">You have share: </h1>
                    <h1 v-else>No Course Yet</h1>
                    <div class="card" v-for="(course, index) in courses" :key="index">
                        <div class="card-header" :id="'heading'+ index">
                            <div class="d-flex w-100 justify-content-between">
                                <h2 class="mb-0">
                                    <h4 class=" text-left collapsed" type="button" data-toggle="collapse" :data-target="'#collapse'+ index" aria-expanded="false" :aria-controls="'collapse'+ index">
                                    {{ course.title }}
                                    </h4>
                                </h2>

                                <div class="button-wrapper">
                                    <a v-if="isInstructor" href="#" class="btn btn-sm btn-success">Edit</a>
                                    <a :href="`/my-course/${course.slug}`" class="btn btn-sm btn-primary">Chat</a>
                                </div>
                            </div>
                        </div>
                        <div :id="'collapse'+ index" class="collapse" :aria-labelledby="'heading'+ index">
                        <div class="card-body">
                            {{ course.desc }}

                            <div class="list-group">
                                <div v-for="content in course.contents" class="list-group-item list-group-item-action flex-column align-items-start">

                                    <h5 class="mb-1">{{ content.title }}</h5>
                                    <small class="text-muted">{{ content.created_at }}</small>
                                    <hr>
                                    <p class="mb-1">{{ content.desc }}</p>
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
        props: ['userId', 'userRole'],
        data() {
            return {
                courses: [],
                loadingForm: false,
                subjectCourseInput: '',
                descCourseInput: '',
                isInstructor: false,
                isStudent: false,
            }
        },

        mounted() {
            this.getCourseList()
            this.isInstructor = this.userRole == 'INSTRUCTOR'
            this.isStudent = this.userRole == 'STUDENT'
        },

        methods: {
            getCourseList() {
                axios.get('/api/course').then(res => {
                    this.courses = res.data.reverse()
                })
            },

            submitCourse() {
                let title = this.subjectCourseInput.trim();
                let desc = this.descCourseInput.trim();

                if (title == '' || desc == '') {
                    alert('Subject and Description field is required bro.')
                    return
                }

                this.loadingForm = true
                axios.post(`/api/course/`, {title, desc})
                    .then(res => {
                        console.log(res)
                        this.loadingForm = false
                        this.subjectCourseInput = ''
                        this.descCourseInput = ''
                    })

                    this.getCourseList()
            },
        }
    }
</script>
