<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-3" v-for="course in courses">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ course.title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">By {{ course.instructor.name }}</h6>
                        <p class="card-text">{{ course.desc.substring(0,80) + '...' }}</p>
                        <a :href="'/course/'+ course.slug" class="btn btn-primary">Show Course</a>
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
                courses: [],
            }
        },

        mounted() {
            this.getCourseList()
        },

        methods: {
            getCourseList() {
                axios.get('/api/course/popular').then(res => {
                    this.courses = res.data
                })
            }
        }
    }
</script>
