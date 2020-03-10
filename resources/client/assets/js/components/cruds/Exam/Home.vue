<template>
    <section style="min-height: 700px;" class="container-fluid">
        <section class="content-header text-center">
            <h3 class="pt-5">Welcome to PTE Mock Test Center!</h3>
        </section>

        <section class="content col-md-12 m-2">
            <div class="row">
                <div class="col-xs-12">
                    <p>Congratulations! You have made the right choice by opting to take a mock test in a PTE-like Mock Test Center facility before registering for the actual PTE.</p>
                    <p>So, before you begin this test, you should know how this experience is going to help you perform better on the D-day:</p>
                    <p>1. This test center is a replica of the actual PTE Test Center and hence it will help you get familiar with the testing conditions during the actual PTE.</p>
                    <p>2. Many aspirants often complain about the distraction due to noise caused by other aspirants during the Speaking section. The mock test experience certainly helps in managing the concentration level during the Speaking section.</p>
                    <p>3. A lot of aspirants cite poor time management in Reading and Listening sections as a reason for not performing well on the PTE. Well, this mock test certainly gives a fair idea about how one should go about managing their time on these two sections, in particular.</p>
                    <p>4. Aspirants tend to forget or misinterpret the ID required to sit in a PTE exam. For instance, there are cases reported daily where aspirants have been sent back without being allowed to take the PTE because they have either forgotten their ID proof or have brought a Driver’s License instead of a passport. Since we follow the exact same process as the one followed in the actual PTE, such unfortunate instances can be identified and avoided during the exam.</p>
                    <p>These are just a few benefits of taking the test at our Mock Test Center facility. I am sure you will discover many more benefits once you go through the entire process</p>
                    <p>Best of luck for your mock test!</p>
                    <br>

                    <div class="text-center mb-2">
                        <button
                            type="button"

                            class="btn btn-primary"
                            @click="startTest"
                        >Start Exam</button>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {
            // Code...
            checked: false
        };
    },
    computed: {
        ...mapGetters("Alert", ["errors"])
    },
    created() {
        // Code...
    },
    watch: {},
    methods: {
        ...mapActions("StudentExam", ["startExam"]),
        startTest() {
          localStorage.clear();
          this.startExam()
                .then(() => {
                    this.$router.push({ name: "exam.instructions" });
                })
                .catch(error => {
                    alert(error);
                });
        }
    }
};
</script>

<style scoped>
</style>
