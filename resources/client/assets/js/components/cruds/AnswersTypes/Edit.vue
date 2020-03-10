<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                            <strong> Update Answers Type</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <form-skeleton v-if="!loadTables"></form-skeleton>                                                                                
                                        <form v-else @submit.prevent="submitForm" novalidate>
                                            <div class="box">

                                                <div class="box-body">
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['title'] }">
                                                        <label for="title" class="col-md-3 col-form-label">Title <span
                                                                class="text-danger">*</span> </label>
                                                        <div class="col-md-6">
                                                            <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="title"
                                                                    placeholder="Enter Title *"
                                                                    :value="item.title"
                                                                    @input="updateTitle"
                                                            >
                                                            <bootstrap-error :name="'title'"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="configurations">Configurations *</label>
                                                        <textarea
                                                                rows="3"
                                                                class="form-control"
                                                                name="configurations"
                                                                placeholder="Enter Configurations *"
                                                                :value="item.configurations"
                                                        >
                                                        </textarea>
                                                    </div>


                                                    <div class="form-group row"
                                                                 v-bind:class="{ 'has-danger': errors && errors['segments'] }">
                                                                <label for="segments" class="col-md-3 col-form-label">Segments <span
                                                                        class="text-danger">*</span> </label>
                                                                <div class="col-md-6">
                                                                    <draggable tag="ul" :list="item.configurations" class="list-group">
                                                                        <li
                                                                                class="list-group-item"
                                                                                v-for="(configuration, index) in item.configurations"
                                                                                :key="index"
                                                                        >
                                                                            <label class="cui-utils-control cui-utils-control-checkbox"
                                                                                   :for="configuration.key">{{configuration.title}}
                                                                                <input type="checkbox"
                                                                                       :checked="configuration.chosen"
                                                                                       :id="configuration.key">
                                                                                <span class="cui-utils-control-indicator"></span>
                                                                                <span class="pull-right">
                                                                                    <i :class="configuration.icon">&nbsp;</i>
                                                                                </span>
                                                                            </label>
                                                                        </li>
                                                                    </draggable>
                                                                </div>
                                                            </div>

                                                </div>

                                                <div class="box-footer mt-5">
                                                    <vue-button-spinner
                                                            class="btn btn-purple mr-2 mb-2"
                                                            :isLoading="loading"
                                                            :disabled="loading"
                                                    >
                                                        UPDATE
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
    import draggable from 'vuedraggable'
    import formSkeleton from '../../utils/skeleton/Form.vue';

    export default {
        data() {
            return {
                // Code...
                showSummary: false,
                loadTables: false
            }
        },
        components: {
            draggable,
            formSkeleton
        },
        computed: {
            ...mapGetters('AnswersTypesSingle', ['item', 'loading']),
            ...mapGetters('Alert', ['errors'])
        },
        created() {
            this.$eventHub.$on('rules-update', this.showTable)                                    
            this.fetchData(this.$route.params.id)
            this.$eventHub.$on('toggle-called', this.toggleColumns)
        },
        destroyed() {
            this.resetState()
        },
        watch: {
            "$route.params.id": function () {
                this.resetState()
                let app = this
                this.fetchData(this.$route.params.id).then(function(){
                app.loadTables = true;
            });
            }
        },
        methods: {
            ...mapActions('AnswersTypesSingle', ['updateData', 'resetState', 'setTitle', 'setConfigurations','fetchData']),
            updateTitle(e) {
                this.setTitle(e.target.value)
            },
            showTable(){
                let app = this
                this.fetchData(this.$route.params.id).then(function(){
                    app.loadTables = true;
                });
            },
            updateConfigurations(configurations) {
                this.setConfigurations(configurations)
            },
            submitForm() {
                let configurations = JSON.parse(JSON.stringify(this.item.configurations));
                for(let index in configurations) {
                    configurations[index].chosen = jQuery("#" + configurations[index].key).is(":checked");
                }
                this.updateConfigurations(configurations);
                this.updateData()
                    .then(() => {
                        this.$router.push({name: 'answers_types.index'})
                        this.$eventHub.$emit('update-success')
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
