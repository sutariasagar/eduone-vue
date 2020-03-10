<template>
    <div>
        <div class="top-buttons pull-right">
        <b-button
                    class="btn btn-icon btn-purple btn-rounded m-2"
                    @click="modalShow = !modalShow"
            >
                <i class="icmn-plus "></i>
            </b-button>
            
            <b-modal v-model="modalShow" title="Speaking">
            <form @submit.prevent="submitForm" novalidate style="min-height: 100px">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group row" >
                            <label for="chapter" class="col-md-3 col-form-label">Chapter <span class="text-danger">*</span> </label>
                            <div class="col-md-9">
                                <v-select
                                    name="chapter"
                                    placeholder="Enter Chapter *" 
                                />
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="topic" class="col-md-3 col-form-label">Topic  </label>
                            <div class="col-md-9">
                                <v-select
                                    name="topic"
                                    placeholder="Enter Topic *"
                                />
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="sub_topic" class="col-md-3 col-form-label">Sub Topic </label>
                            <div class="col-md-9">
                                <v-select
                                    name="sub_topic"
                                    placeholder="Enter Sub Topic *"
                                />
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="min_question" class="col-md-3 col-form-label">Min Question<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input
                                    type="number"
                                    class="form-control"
                                    name="min_question"
                                    placeholder="Enter Min Question *"
                                >
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="max_question" class="col-md-3 col-form-label">Max Question<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input
                                    type="number"
                                    class="form-control"
                                    name="max_question"
                                    placeholder="Enter Max Question *"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </b-modal>
        </div>
        <div class="card-header">

            <span class="cui-utils-title">
              <strong>{{ total }} records found</strong>
                <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
            </span>
            <button class="ml-2 p-2 badge badge-warning badge-rounded" v-if="hasFilters" @click="clearFilters">
                Clear Filters
            </button>
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-lg-12">
                    <!--<h5 class="text-black"><strong>Lorem Ipsum for the text</strong></h5>-->
                    <p class="text-muted"></p>

                    <div class="mb-5">
                        <table class="table table-hover nowrap display" :id="id">
                            <thead>

                            <tr>
                                <th v-on:keydown.enter.prevent='noop' v-for="(column, index) in columns" v-bind:class="{ searchable: column.searchable }">{{ column.label }}

                                    <b-dropdown v-if="column.searchable" text="" ref="ddown"  class="custom-filter" variant="link" no-caret>
                                        <template slot="button-content"><i class="fa fa-filter" v-bind:class="{ 'custom-text-color': getValueFromState(index) }"></i><span class="sr-only">Search</span></template>
                                        <div class="input-group input-group-sm">

                                                <input :value="getValueFromState(index)" type="search" class="form-control ml-1" :ref="column.name" :column-name="column.name"
                                                       :placeholder="'Search '+column.label" @click="focus($event)" @keydown.enter="search($event)">
                                                <span class="input-group-btn">
                                                  <button type="submit" class="btn btn-default fa fa-search custom-background mr-2 ml-2 mt-2" @click="search($event)"></button>
                                                </span>

                                        </div>
                                        <!--<input size="sm" class="form-input" v-model="keyword" @keydown.enter="search" :placeholder="`Search ${field}...`"/>-->
                                    </b-dropdown>
                                </th>
                            </tr>

                            </thead>

                            <tfoot>
                            <tr>
                            <th v-for="column in columns" v-bind:class="{ searchable: column.searchable }">{{ column.label }}
                            </th>
                            </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <b-modal ref="myModalRef" :hide-footer='true' :ok-only='true' header-class='custom-sidebar-no-hover' ok-title="Apply" button-size="sm" centered id="modal1" title="Show/Hide Columns" v-if="dtHandle">
            <div class="">
                <div class="-col-group-container row border-muted-1">
                    <column-group v-for="(columns, groupName) in colGroups"
                                  ref="colGroups" :key="groupName"
                                  :group-name="groupName" :columns="columns" :dtTable="dtHandle">
                    </column-group>
                </div>
                <div class="-col-group-container row mt-3">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-purple pull-right mr-4" @click="hideModal"> Apply </button>
                        <button class="btn btn-sm btn-orange pull-right mr-4" @click="restoreColumns">Set Default </button>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import dt from 'datatables.net-bs4';
    import 'datatables.net-autofill-bs4';
    //import 'datatables.net-editor-bs4';
    import 'datatables.net-buttons-bs4';
    import '../dtmodules/buttons.colVis.min';
    import 'datatables.net-colreorder-bs4';
    import 'datatables.net-fixedcolumns-bs4';
    import 'datatables.net-fixedheader-bs4';
    import 'datatables.net-keytable-bs4';
    import 'datatables.net-responsive-bs4';
    import 'datatables.net-rowgroup-bs4';
    import 'datatables.net-rowreorder-bs4';
    import 'datatables.net-scroller-bs4';
    import 'datatables.net-select-bs4';
    import ColumnGroup from '../dtmodules/ColumnGroup.vue';
    import groupBy from 'lodash/groupBy'
//    import BButton from "bootstrap-vue/src/components/button/button";
    export default {
        props: ['tableData', 'columns', 'url', 'id', 'load', 'xprops'],
        components:{
            ColumnGroup
        },
        data() {
            return {
                rows: [],
                dtHandle: null,
                colOrder: this.colReorder,
                total: 0,
                intial: true,
                colModal: false,
                storeItemPath: "",
                hasFilters: false,
                state: {},
                modalShow:false
            }
        },
        watch: {
            load: {
                handler: function(val, oldVal) {
                    if(val)
                        this.createDataTable()
                },
                deep: true
            },
            state: {
                handler: function(state, oldState) {
                    if(state)
                        this.checkIfFilters(state)
                },
                deep: true
            }
        },
        computed: {
            colGroups() {
                return groupBy(
                    this.columns.filter(col => col.label || col.title),
                    'group'
                )
            },
        },
        mounted() {
            let vm = this;
            this.hasFilters = false;
            $("#"+vm.id).on( 'draw.dt', function () {
                $('tbody', this).on( 'click', '.custom-delete', function(){
                    vm.destroyData($(this).attr('deleteid'))
                });

                $('tbody', this).on( 'click', '.custom-link', function(){
                    vm.$router.push({ name: $(this).attr('route')+'.'+$(this).attr('action'), params: { id: $(this).attr('params') } })
                });

            } );

        },
        methods: {
            hideModal() {
                this.$refs.myModalRef.hide()
            },
            showColumnSettingPopUp(){
                this.$refs.myModalRef.show()
            },
            restoreColumns(){
                $(".buttons-colvisRestore").trigger('click');
                this.dtHandle.draw();
                this.hideModal();
            },
            getValueFromState(column){
                let state = $("#"+this.id).DataTable().state();
                this.state = state;
                if(state){
                    if(state.columns[column].search.search){
                        this.hasFilters = true;
                        return state.columns[column].search.search;
                    }
                    else{
                        return "";
                    }
                }else{
                    //vm.hasFilters = false;
                    return "";
                }
                //let stateData = JSON.parse(localStorage.getItem( 'DataTables_' + settings.sInstance+'_/admin'+vm.$router.currentRoute.path));
            },
            checkIfFilters(state){
                let vm = this;
                vm.hasFilters = false;
                state.columns.forEach(function(column){
                    if(column.search.search){
                        vm.hasFilters = true;
                    }
                })
                if(state.search.search){
                    vm.hasFilters = true;
                }
            },
            clearFilters(){
                this.dtHandle.search('').columns().search('').draw();
            },
            createDataTable() {
                let vm = this;

                let scrollY = (Math.floor(
                    window.innerHeight - this.$el.getBoundingClientRect().top
                ) - 140);
                if (scrollY < 300) {
                    scrollY = 300;
                }
                // Fire up datatables with our desired config
                // and store a reference handle to our component's
                // data element so we can reference it later..

                    vm.dtHandle = $("#"+vm.id).DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend:'colvisRestore',
                                text:'Restore'
                            }

                        ],
                        responsive: true,
                        serverSide: true,
                        ajax: {
                            url: this.url,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                            }
                        },
                        columns: vm.columns,
                        colReorder: true,
                        stateSave: true,
                        "fnDrawCallback": function (oSettings) {
                            vm.total = oSettings._iRecordsDisplay;
                        },
                        "language": {
                            "search": ""
                        },
                        "initComplete": function(settings, json) {
                            vm.storeItemPath = 'DataTables_' + settings.sInstance+'_/admin'+vm.$router.currentRoute.path;
                        },
                    });


                $(".dataTables_wrapper .dataTables_filter input").attr('placeholder', 'Quick Search');
                $(".dataTables_wrapper .dataTables_filter input").addClass();

            },
            focus(e){
                e.stopPropagation();
            },
            search(e){
                e.preventDefault();
                let target = e.target.parentElement.parentElement.querySelector('input').getAttribute('column-name');
                let value = e.target.parentElement.parentElement.querySelector('input').value;
                this.dtHandle.column( target+':name' ).search(value).draw();
                e.stopPropagation();
            },
            noop(e){
                e.stopPropagation();
                e.preventDefault();
            },
            routeTo(pRouteTo) {
                if(pRouteTo)
                    this.$router.push(pRouteTo)
            },

            destroyData(id) {
                let vm = this;
                this.$swal({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    confirmButtonColor: '#dd4b39',
                    focusCancel: true,
                    reverseButtons: true
                }).then(result => {
                    if (result.value) {
                        this.$store.dispatch(
                            this.xprops.module + '/destroyData',
                            id
                        ).then(result => {
                            vm.dtHandle.draw()
                            this.$eventHub.$emit('delete-success')
                        })
                    }
                })
            },
            showColumnsModal(){
                this.$refs.myModalRef.show()
            }

        }
    }
</script>
<style scoped>
    .custom-background{
        background-color: transparent !important;
        border: none;
        color: #4949e3 !important;
    }

</style>