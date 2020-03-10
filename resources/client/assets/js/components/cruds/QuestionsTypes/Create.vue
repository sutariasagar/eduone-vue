<template>
    <div class>
        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                            <strong>Create New Questions Type</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="row card-with-shadow pt-3 custom-shadow">
                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading heading="Basic Information" to="basic"></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                        <form @submit.prevent="submitForm" novalidate>
                                            <div class="box">
                                                <div class="box-body">
                                                    <div
                                                        class="form-group row"
                                                        v-bind:class="{ 'has-danger': errors && errors['title'] }"
                                                    >
                                                        <label
                                                            for="title"
                                                            class="col-md-3 col-form-label"
                                                        >
                                                            Title
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="title"
                                                                placeholder="Enter Title *"
                                                                :value="item.title"
                                                                @input="updateTitle"
                                                            >
                                                            <bootstrap-error
                                                                :name="'title'"
                                                                v-if="errors && errors['title']"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div
                                                            class="form-group row"
                                                            v-bind:class="{ 'has-danger': errors && errors['sequence'] }"
                                                    >
                                                        <label
                                                                for="sequence"
                                                                class="col-md-3 col-form-label"
                                                        >
                                                            Sequence
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <input
                                                                    type="number"
                                                                    class="form-control"
                                                                    name="title"
                                                                    placeholder="Enter Sequence *"
                                                                    :value="item.sequence"
                                                                    @input="updateSequence"
                                                            >
                                                            <bootstrap-error
                                                                    :name="'sequence'"
                                                                    v-if="errors && errors['sequence']"
                                                            />
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
                                                        ></textarea>
                                                    </div>

                                                    <div
                                                        class="form-group row"
                                                        v-bind:class="{ 'has-danger': errors && errors['segments'] }"
                                                    >
                                                        <label
                                                            for="segments"
                                                            class="col-md-3 col-form-label"
                                                        >
                                                            Segments
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <draggable
                                                                tag="ul"
                                                                :list="item.configurations"
                                                                class="list-group"
                                                            >
                                                                <li
                                                                    class="list-group-item"
                                                                    v-for="(configuration, index) in item.configurations"
                                                                    :key="index"
                                                                >
                                                                    <label
                                                                        class="cui-utils-control cui-utils-control-checkbox"
                                                                        :for="configuration.key"
                                                                    >
                                                                        {{configuration.title}}
                                                                        <input
                                                                            type="checkbox"
                                                                            :checked="configuration.chosen"
                                                                            :id="configuration.key"
                                                                        >
                                                                        <span
                                                                            class="cui-utils-control-indicator"
                                                                        ></span>
                                                                        <span class="pull-right">
                                                                            <i
                                                                                :class="configuration.icon"
                                                                            >&nbsp;</i>
                                                                        </span>
                                                                    </label>
                                                                </li>
                                                            </draggable>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row"
                                                         v-bind:class="{ 'has-danger': errors && errors['communication_skill'] }">
                                                        <label for="communication_skill" class="col-md-3 col-form-label">Communication Skill <span
                                                            class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <v-select
                                                                label="title"
                                                                name="communication_skill"
                                                                :value="item.communication_skill"
                                                                @input="updateCommunication_skill"
                                                                :options="communicationskillsAll"
                                                                autocomplete="off"
                                                                multiple
                                                            />
                                                            <bootstrap-error :name="'communication_skill'" v-if="errors && errors['communication_skill']"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer mt-5">
                                                    <vue-button-spinner
                                                        class="btn btn-purple mr-2 mb-2"
                                                        :isLoading="loading"
                                                        :disabled="loading"
                                                    >CREATE</vue-button-spinner>
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
import { mapGetters, mapActions } from "vuex";
import draggable from "vuedraggable";

export default {
    data() {
        return {
            showSummary: false,
            selected: '',
        };
    },
    components: {
        draggable
    },
    computed: {
        ...mapGetters("QuestionsTypesSingle", ["item", "loading", "communicationskillsAll"]),
        ...mapGetters("Alert", ["errors"])
    },
    created() {
        this.$eventHub.$on('toggle-called', this.toggleColumns)
        this.fetchCommunicationskillsAll()
    },
    destroyed() {
        this.resetState();
    },
    methods: {
        ...mapActions("QuestionsTypesSingle", [
            "storeData",
            "resetState",
            "setTitle",
            "setConfigurations",
            "setCommunication_skill",
            "fetchCommunicationskillsAll",
            "setSequence"
        ]),
        updateTitle(e) {
            this.setTitle(e.target.value);
        },
        updateSequence(e) {
            this.setSequence(e.target.value);
        },
        updateConfigurations(configurations) {
            this.setConfigurations(configurations);
        },
        submitForm() {
            let configurations = JSON.parse(
                JSON.stringify(this.item.configurations)
            );
            for (let index in configurations) {
                configurations[index].chosen = jQuery(
                    "#" + configurations[index].key
                ).is(":checked");
            }
            this.updateConfigurations(configurations);
            this.storeData()
                .then(() => {
                    this.$router.push({ name: "questions_types.index" });
                    this.$eventHub.$emit("create-success");
                })
                .catch(error => {
                    console.error(error);
                });
        },
        updateCommunication_skill(value) {
            this.setCommunication_skill(value)
        },
        toggleColumns(){
            this.showSummary = !this.showSummary;
        }
    }
};
</script>


<style scoped>
</style>
