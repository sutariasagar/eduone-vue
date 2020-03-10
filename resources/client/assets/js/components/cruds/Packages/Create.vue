<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                          <strong> Create New Package </strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <form @submit.prevent="submitForm" novalidate>
                                        <div class="box">
                                            <div class="box-body">

                                                <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['title'] }">
                                                    <label for="title" class="col-md-3 col-form-label">Title <span class="text-danger">*</span> </label>
                                                    <div class="col-md-9">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="title"
                                                            placeholder="Enter Title *"
                                                            :value="item.title"
                                                            @input="updateTitle"
                                                            autocomplete="off"
                                                        >
                                                        <bootstrap-error :name="'title'" v-if="errors && errors['title']"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['price'] }">
                                                            <label for="price" class="col-md-6 col-form-label">Price <span class="text-danger">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="number"
                                                                    class="form-control w-100"
                                                                    name="price"
                                                                    placeholder="Enter Price *"
                                                                    :value="item.price"
                                                                    @input="updatePrice"
                                                                    autocomplete="off"
                                                                    min="0"
                                                                >
                                                                <bootstrap-error :name="'price'" v-if="errors && errors['price']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['status'] }">
                                                            <label for="status" class="col-md-6 col-form-label">Status<span class="text-danger">*</span></label>
                                                            <div class="col-md-6">
                                                                <v-select
                                                                    name="status"
                                                                    @input="updateStatus"
                                                                    :value="item.status"
                                                                    :options="statusEnum"
                                                                />
                                                                <bootstrap-error :name="'status'" v-if="errors && errors['status']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['tests_with_assessment'] }">
                                                            <label for="tests_with_assessment" class="col-md-6 col-form-label">Tests With Assessment <span class="text-danger">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="number"
                                                                    class="form-control w-100"
                                                                    name="tests_with_assessment"
                                                                    placeholder="Enter Tests With Assessment *"
                                                                    :value="item.tests_with_assessment"
                                                                    @input="updateTests_with_assessment"
                                                                    autocomplete="off"
                                                                    min="0"
                                                                >
                                                                <bootstrap-error :name="'tests_with_assessment'" v-if="errors && errors['tests_with_assessment']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['video_tutorials'] }">
                                                            <label for="video_tutorials" class="col-md-6 col-form-label">Video Tutorials <span class="text-danger">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="number"
                                                                    class="form-control w-100"
                                                                    name="video_tutorials"
                                                                    placeholder="Enter Video Tutorials *"
                                                                    :value="item.video_tutorials"
                                                                    @input="updateVideo_tutorials"
                                                                    autocomplete="off"
                                                                    min="0"
                                                                >
                                                                <bootstrap-error :name="'video_tutorials'" v-if="errors && errors['video_tutorials']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['practice_questions'] }">
                                                            <label for="practice_questions" class="col-md-6 col-form-label">Practice Questions <span class="text-danger">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="number"
                                                                    class="form-control w-100"
                                                                    name="practice_questions"
                                                                    placeholder="Enter Practice Questions *"
                                                                    :value="item.practice_questions"
                                                                    @input="updatePractice_questions"
                                                                    autocomplete="off"
                                                                    min="0"
                                                                >
                                                                <bootstrap-error :name="'practice_questions'" v-if="errors && errors['practice_questions']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['testcenter_mocktests'] }">
                                                            <label for="mock_tests" class="col-md-6 col-form-label">Mock Tests at testcenter <span class="text-danger">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="number"
                                                                    class="form-control w-100"
                                                                    name="mock_tests"
                                                                    placeholder="Enter Mock Tests *"
                                                                    :value="item.testcenter_mocktests"
                                                                    @input="updateTestcenterMock_tests"
                                                                    autocomplete="off"
                                                                    min="0"
                                                                >
                                                                <bootstrap-error :name="'testcenter_mocktests'" v-if="errors && errors['testcenter_mocktests']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['mock_tests'] }">
                                                            <label for="mock_tests" class="col-md-6 col-form-label">Mock Tests <span class="text-danger">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="number"
                                                                    class="form-control w-100"
                                                                    name="mock_tests"
                                                                    placeholder="Enter Mock Tests *"
                                                                    :value="item.mock_tests"
                                                                    @input="updateMock_tests"
                                                                    autocomplete="off"
                                                                    min="0"
                                                                >
                                                                <bootstrap-error :name="'mock_tests'" v-if="errors && errors['mock_tests']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['pte_vouchers'] }">
                                                            <label for="pte_vouchers" class="col-md-6 col-form-label">Pte Vouchers  <span class="text-danger">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="number"
                                                                    class="form-control w-100"
                                                                    name="pte_vouchers"
                                                                    placeholder="Enter Pte Vouchers *"
                                                                    :value="item.pte_vouchers"
                                                                    @input="updatePte_vouchers"
                                                                    autocomplete="off"
                                                                    min="0"
                                                                >
                                                                <bootstrap-error :name="'pte_vouchers'" v-if="errors && errors['pte_vouchers']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['webinar_sessions'] }">
                                                            <label for="webinar_sessions" class="col-md-6 col-form-label">Webinar Sessions <span class="text-danger">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="number"
                                                                    class="form-control w-100"
                                                                    name="webinar_sessions"
                                                                    placeholder="Enter Webinar Sessions *"
                                                                    :value="item.webinar_sessions"
                                                                    @input="updateWebinar_sessions"
                                                                    autocomplete="off"
                                                                    min="0"
                                                                >
                                                                <bootstrap-error :name="'webinar_sessions'" v-if="errors && errors['webinar_sessions']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['personal_feedback_and_assessment'] }">
                                                            <label for="personal_feedback_and_assessment" class="col-md-6 col-form-label">Personal Feedback And Assessment<span class="text-danger">*</span></label>
                                                            <div class="col-md-6">
                                                                <v-select
                                                                    name="personal_feedback_and_assessment"
                                                                    @input="updatePersonal_feedback_and_assessment"
                                                                    :value="item.personal_feedback_and_assessment"
                                                                    :options="personal_feedback_and_assessmentEnum"
                                                                />
                                                                <bootstrap-error :name="'personal_feedback_and_assessment'" v-if="errors && errors['personal_feedback_and_assessment']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['coaching_session_daily'] }">
                                                            <label for="coaching_session_daily" class="col-md-6 col-form-label">Coaching Session Daily <span class="text-danger">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="number"
                                                                    class="form-control w-100"
                                                                    name="coaching_session_daily"
                                                                    placeholder="Enter Coaching Session Daily *"
                                                                    :value="item.coaching_session_daily"
                                                                    @input="updateCoaching_session_daily"
                                                                    autocomplete="off"
                                                                    min="0"
                                                                >
                                                                <bootstrap-error :name="'coaching_session_daily'" v-if="errors && errors['coaching_session_daily']"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row" v-bind:class="{ 'has-danger': errors && errors['unique_package_name'] }">
                                                    <label for="unique_package_name" class="col-md-3 col-form-label">Unique Package Name <span class="text-danger">*</span> </label>
                                                    <div class="col-md-9">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="unique_package_name"
                                                            placeholder="Enter Unique Package Name *"
                                                            :value="item.unique_package_name"
                                                            @input="updateUnique_package_name"
                                                            autocomplete="off"
                                                        >
                                                        <bootstrap-error :name="'unique_package_name'" v-if="errors && errors['unique_package_name']"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="box-footer mt-5">
                                                <vue-button-spinner
                                                    class="btn btn-purple mr-2 mb-2"
                                                    :isLoading="loading"
                                                    :disabled="loading"
                                                >
                                                    CREATE
                                                </vue-button-spinner>
                                                <back-buttton></back-buttton>
                                            </div>
                                        </div>
                                    </form>
                                    </custom-collapse-body>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div v-bind:class="{'d-none':!showSummary,'col-md-3':showSummary}">
                <div class="card card-with-shadow custom-sidebar">
                    <item-changes :item="item"></item-changes>
                </div>

            </div>
        </div>
    </div>
</template>


<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        data() {
            return {
                // Code...
                showSummary: false
            }
        },
        components: {},
        computed: {
            ...mapGetters('PackagesSingle', ['item', 'loading','statusEnum','personal_feedback_and_assessmentEnum']),
            ...mapGetters('Alert', ['errors'])
        },
        created() {
            this.$eventHub.$on('toggle-called', this.toggleColumns)
        },
        mounted() {
            let context = this;
        },
        destroyed() {
            this.resetState()
        },
        methods: {
            ...mapActions('PackagesSingle', ['setItem', 'setTitle', 'setPrice', 'setStatus','setTests_with_assessment','setVideo_tutorials' ,'setPractice_questions','setMock_tests','setPte_vouchers','setWebinar_sessions','setPersonal_feedback_and_assessment','setCoaching_session_daily','setUnique_package_name','storeData', 'resetState','setTestcenter_mocktests']),
            updateTitle(e) {
                this.setTitle(e.target.value)
            },
            updatePrice(e) {
                this.setPrice(e.target.value)
            },
            updateStatus(value) {
                this.setStatus(value)
            },
            updateTests_with_assessment(e) {
                this.setTests_with_assessment(e.target.value)
            },
            updateVideo_tutorials(e) {
                this.setVideo_tutorials(e.target.value)
            },
            updatePractice_questions(e) {
                this.setPractice_questions(e.target.value)
            },
            updateMock_tests(e) {
                this.setMock_tests(e.target.value)
            },
            updatePte_vouchers(e) {
                this.setPte_vouchers(e.target.value)
            },
            updateWebinar_sessions(e) {
                this.setWebinar_sessions(e.target.value)
            },
            updatePersonal_feedback_and_assessment(value) {
                this.setPersonal_feedback_and_assessment(value)
            },
            updateCoaching_session_daily(e) {
                this.setCoaching_session_daily(e.target.value)
            },
            updateUnique_package_name(e) {
                this.setUnique_package_name(e.target.value)
            },
            updateTestcenterMock_tests(e) {
                this.setTestcenter_mocktests(e.target.value)
            },
            submitForm() {
                this.storeData()
                    .then(() => {
                        this.$router.push({name: 'packages.index'})
                        this.$eventHub.$emit('create-success')
                    })
                    .catch((error) => {
                        console.error(error)
                    })
            },
            toggleColumns(){
                this.showSummary = !this.showSummary;
            }
        }
    }
</script>


<style scoped>

</style>
