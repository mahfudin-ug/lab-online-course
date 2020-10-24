<template>
    <div class="container" v-if="course.instructor && course.contents">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">{{ course.title }}</h1>
                    <p class="lead">By {{ course.instructor.name }}</p>
                    <hr class="my-4">
                    <p>{{ course.desc }}</p>
                    <a @click="registerCourse" v-if="!showJoin" class="btn btn-success btn-lg" role="button">Register Now</a>
                    <a v-if="showJoin" :href="`/my-course/${course.slug}`" class="btn btn-primary btn-lg" role="button">Join Chat</a>

                    <a @click="handlePayButton" class="btn btn-danger btn-lg" role="button">Pay Now</a>
                </div>

                <div class="accordion" id="accordionExample">
                    <h1 v-if="course.contents.length > 0">You will learn: </h1>
                    <h1 v-else>No Content in this course</h1>
                    <div class="card" v-for="(content, index) in course.contents" :key="index">
                        <div class="card-header" :id="'heading'+ index">
                        <h2 class="mb-0">
                            <h4 class="text-left collapsed" type="button" data-toggle="collapse" :data-target="'#collapse'+ index" aria-expanded="false" :aria-controls="'collapse'+ index">
                            {{ content.title }}
                            </h4>
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
                showJoin: false,
                showRegister: false,
                showPay: false,

                data_midtrans: {
                    'transaction_details' : {
                        'order_id': 'test-98241',
                        'gross_amount': 99000
                    },
                    'customer_details': {
                        'first_name' : 'John',
                        'last_name' : 'Doe',
                        'email' : 'john.doe@email.co',
                        'phone' : '098123123123',
                    }
                }
            }
        },

        mounted() {
            this.getCourse()
        },

        methods: {
            getCourse() {
                axios.get(`/api/course/${this.courseId}`).then(res => {
                    this.course = res.data
                    this.showJoin = Laravel.user.role == 'ADMIN';
                    this.showJoin = this.course.related_users.includes(Laravel.user.id);
                    this.data_midtrans.transaction_details.gross_amount = this.course.price

                })
            },

            registerCourse() {
                axios.post(`/api/course/${this.courseId}/register`).then(res => {
                    console.log(res)
                    this.showJoin = true
                })
            },

            handlePayButton: function (e) {
                console.log('hi')
                this.data_midtrans.transaction_details.order_id = `test-${new Date().getTime()}`
                axios.post('/api/payment/generate', { data: this.data_midtrans}).then(res => {
console.log(res)
                    snap.pay(res.data.data.token);

                }, err => {
                    console.log('error : ' + err)
                });
            },
        }
    }
</script>
