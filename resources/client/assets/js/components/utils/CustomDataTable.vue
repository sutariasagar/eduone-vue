<template>
    <div>
        <div class="top-buttons pull-right" v-if="!childButtons">
            <router-link
                    v-if="$can(xprops.permission_prefix + 'create')"
                    :to="{ name: xprops.route + '.create' }"
                    class="btn btn-icon btn-create btn-rounded m-2"
            >
                <i class="icmn-plus "></i>
            </router-link>
            <a v-if="!hideSettings" @click="showColumnSettingPopUp" class="btn btn-icon btn-settings btn-rounded m-2" href="javascript:void(0)">
                <i class="icmn-cog"></i>
            </a>
        </div>
        <div class="pull-right" v-else>
            <a v-if="!hideSettings" @click="showColumnSettingPopUp" class="btn btn-icon btn-settings btn-rounded m-2" href="javascript:void(0)">
                <i class="icmn-cog"></i>
            </a>
        </div>
        <div class="card-header">

            <span class="cui-utils-title">
              <strong>{{ total }} records found</strong>
                <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
            </span>
            <button type="button" class="ml-2 p-2 badge badge-warning badge-rounded" v-if="hasFilters" @click="clearFilters">
                Clear Filters
            </button>
        </div>
        <div v-if="multiselect" class="row">
            <div class="col-md-12 ml-5">            
            <input type="radio" id="selected" value="selected" v-model="selected">
            <label for="selected">Selected</label>
            <input type="radio" id="notselected" value="notselected" v-model="selected">
            <label for="notselected">Not Selected</label>    
            </div>                                    
        </div>
        <div class="card-body pt-0" v-bind:class="{ 'p-0': childButtons}">
            <div v-bind:class="{ 'row': !childButtons, 'childButtons': childButtons }">
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
                        <button type="button" class="btn btn-purple pull-right mr-4" @click="hideModal"> Apply </button>
                        <button type="button" class="btn btn-custom-default pull-right mr-2" @click="restoreColumns">Set Default </button>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
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
    import map from 'lodash/map'
    import checkboxes from './../utils/dataTables.checkboxes.min';
//    import BButton from "bootstrap-vue/src/components/button/button";
    export default {
        props: ['tableData', 'columns', 'url', 'id', 'load', 'xprops','childButtons','selectedRows','section','multiselect','parentId','hideSettings'],
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
                rowsSelected: this.selectedRows,
                selected: 'selected'
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
            },
            rowsSelected:{
                handler: function(state, oldState) {                    
                    // if(state){                        
                        this.rowsChanged();
                    // }else{
                    //     this.removeRows()
                    // }
                }
            },
            selected: {
                handler: function(state, oldState) {
                    if(state){
                        this.filterSelected();
                    }
                }
            }
        },
        computed: {
            ...mapGetters('QuestionSetsSingle', ['item']),
            colGroups() {
                return groupBy(
                    this.columns.filter(col => col.label || col.title),
                    'group'
                )
            },
        },
        mounted() {
            if(this.load){                
                this.createDataTable()
            }
            let vm = this;
            this.hasFilters = false;
            $("#"+vm.id).on( 'draw.dt', function () {
                $('tbody', this).on( 'click', '.custom-delete', function(){
                    vm.destroyData($(this).attr('deleteid'))
                });

                $('tbody', this).on( 'click', '.custom-link', function(){
                    vm.$router.push({ name: $(this).attr('route')+'.'+$(this).attr('action'), params: { id: $(this).attr('params') } })
                    //console.log({ name: $(this).attr('route')+'.'+$(this).attr('action'), params: { id: $(this).attr('params')} });
                });
                $('tbody', this).on( 'click', '.custom-student-link', function(){
                    //console.log("here");
                    vm.$router.push({ name: $(this).attr('route')+'.'+$(this).attr('action'), params: { id: $(this).attr('student_id'), exam_id: $(this).attr('exam_id')} })
                    //console.log({ name: $(this).attr('route')+'.'+$(this).attr('action'), params: { id: $(this).attr('student_id'), exam_id: $(this).attr('exam_id')} });
                });
                $('tbody', this).on( 'click', '.custom-edit-section-button', function(){
                    vm.editData($(this).attr('editid'))
                });

                $('tbody', this).on('click', 'input[type="checkbox"]', function(e){
                    var $row = $(this).closest('tr');
                    
                    var data = vm.dtHandle.row($row).data();


                    var rowId = data['id'];

                    // Determine whether row ID is in the list of selected row IDs
                    var index = $.inArray(parseInt(rowId), vm.rowsSelected);                    
                    if(this.checked && index === -1){
                        vm.rowsSelected.push(rowId);

                        // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                    } else if (!this.checked && index === -1){
                        //console.log("this is unchecked",vm.rowsSelected)
                        vm.rowsSelected.splice(index, 1);
                        //console.log("this is unchecked after splice",vm.rowsSelected)
                    }else if(!this.checked){
                        vm.rowsSelected.splice(index, 1);
                    }

                    if(this.checked){
                        $row.addClass('selected');
                    } else {
                        $row.removeClass('selected');
                    }

                    // Update state of "Select all" control
                    //updateDataTableSelectAllCtrl(table);

                    // Prevent click event from propagating to parent
                    e.stopPropagation();
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
            rowsChanged() {
                //console.log("yes we are in rows changed", this.section);
                //console.log(this.rowsChanged);
                this.$emit("change", {'id':this.rowsSelected,'section':this.section});
            },
            removeRow(){
                this.$emit("remove",{'id':this.rowsSelected,'section':this.section})
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
                if(vm.multiselect){
                    vm.dtHandle = $("#"+vm.id).DataTable({
                        dom: 'Bfrtip',
                        "aaSorting": ['desc'],
                        buttons: [
                            {
                                extend:'colvisRestore',
                                text:'Restore'
                            }

                        ],
                        responsive: false,
                        serverSide: true,
                        ajax: {
                            url: this.url,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                            },
                            'data': function(data){
                                data.selected = vm.selected,
                                data.parent_id = vm.parentId
                            }
                        },
                        'select': {
                            'style': 'multi'
                        },
                        'columnDefs': [{
                            'targets': 0,
                            'searchable':false,
                            'orderable':false,
                            'width':'1%',
                            'className': 'dt-body-center',
                            'render': function (data, type, full, meta){
                                let select = false;
                                //console.log("in render", vm.selectedRows);
                                 //&& $.inArray(parseInt(data),  vm.item.selectedRows[vm.section]) !== -1
                                
                                
                                    return "<input type='checkbox'>" ;
                                //}      
                            }
                        }],
                        'rowCallback': function(row, data, dataIndex){
                            // Get row ID
                            //console.log("in callback", vm.item.selectedQuestions[vm.section]);
                            var rowId = data['id'];

                            //console.log("checking is sav",  $.inArray(parseInt(rowId), vm.item.selectedQuestions[vm.section]));
                            if(vm.item.selectedQuestions && vm.item.selectedQuestions[vm.section] && $.inArray(parseInt(rowId), vm.item.selectedQuestions[vm.section]) >= 0){
                                // console.log("checking in callback", data);
                                // console.log($(row).find('input[type="checkbox"]'));
                                $(row).find('input[type="checkbox"]').prop('checked', true);
                            }else{
                                $(row).find('input[type="checkbox"]').prop('checked', false);
                            }
                        },
                        columns: vm.columns,
                        colReorder: true,
                        stateSave: true,
                        "order": [[0, 'desc']],
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
                }else{
                    vm.dtHandle = $("#"+vm.id).DataTable({
                        dom: 'Bfrtip',
                        "aaSorting": ['desc'],
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
                        "order": [[0, 'desc']],
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
                }



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
            filterSelected(){
                this.dtHandle.draw();
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
                            this.$eventHub.$emit('delete-success')
                            vm.dtHandle.ajax.url(vm.url).load()
                        })
                    }
                })
            },
            editData(id) {
                this.$eventHub.$emit('edit-custom-data',id);
            },
            showColumnsModal(){
                this.$refs.myModalRef.show()
            },
            reloadDataTable(){
                this.dtHandle.draw();
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