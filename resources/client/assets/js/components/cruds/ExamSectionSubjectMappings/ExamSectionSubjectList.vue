<template>
    <section class="card">
        <custom-data-table class="table table-responsive" :columns="columns" :url="'/api/v1/exams'" :id="'ExamsDataTable'" :load="loadTables" :xprops="xprops"></custom-data-table>
    </section>
</template>


<script>
    import { mapGetters, mapActions } from 'vuex'
    var context;


    export default {
        data() {
            return {
                xprops: {
                    module: 'ExamsIndex',
                    route: 'exams',
                    permission_prefix: 'exam_',
                    eventbus: new Vue()
                },
                columns: [
                    {data: 'id', name: 'id', label: "Id", group: 'basic', visible:false},
                    {data: 'title', name: 'title', searchable: true, label: "Title", group: 'basic',},
                    {data: 'question_pool', label: 'Question Pool', name: 'question_pool', sortable: true,group: 'advanced', orderable: "false",searchable: true, },
                    {data: 'duration_min', label: 'Min Duration', name: 'duration_min', sortable: true,group: 'advanced', orderable: "false",searchable: true, },
                    {data: 'duration_max', label: 'Max Duration', name: 'duration_max', sortable: true,group: 'advanced', orderable: "false",searchable: true, },
                    {data: 'status', label: 'Status', name: 'status', sortable: true,group: 'advanced', orderable: "false",searchable: true, visible:false },
                    {data: 'exam_type', label: 'Exam type', name: 'exam_type', sortable: true,group: 'advanced', orderable: "false",searchable: true, visible:false },
                    {data: 'can_see_solution', label: 'Can see solution', name: 'can_see_solution', colStyle: 'width: 50px;',group: 'advanced', orderable: "false",searchable: true, visible:false },
                    {data: 'instruction_type', label: 'Instruction type', name: 'instruction_type', sortable: true,group: 'advanced', orderable: "false",searchable: true,  visible:false},
                    {data:'created_at', name: 'created_at', searchable: true, visible:false, label: "Created At", group: 'advanced'},
                    {data:'updated_at', name: 'updated_at', searchable: true, label: "Updated At", group: 'advanced', visible:false},
                    {data:'created_by', name: 'created_by.name', searchable: true, visible:false, label: "Created By", group: 'advanced'},
                    {data:'updated_by', name: 'updated_by.name', searchable: true, visible:false, label: "Updated By", group: 'advanced'},
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        name: 'action',
                        group: 'basic',
                        label: "Action",
                        visible: 'true',
                        "render": function (data, type, row, meta) {

                            let id = row.id;
                            var div = $("<div></div>");
                            div.addClass('btn-group btn-group-xs');
                            if (ability.can(context.xprops.permission_prefix + 'view')) {
                                let anchor = $('<a></a>');
                                anchor.attr('href', 'javascript:void(0)');
                                anchor.attr('link','/'+context.xprops.route + '/' + id);
                                anchor.attr('route',context.xprops.route);
                                anchor.attr('params',id);
                                anchor.attr('action','show');
                                anchor.append('<i class="fa fa-eye"></i>');
                                anchor.addClass('btn btn-icon btn-success btn-rounded mr-2 mb-2 custom-link')
                                div.append(anchor)
                            }
                            if (ability.can(context.xprops.permission_prefix + 'edit')) {
                                let anchor = $('<a></a>');
                                anchor.attr('href', 'javascript:void(0)');
                                anchor.attr('link', '/'+context.xprops.route + '/' + id + '/edit');
                                anchor.attr('route',context.xprops.route);
                                anchor.attr('params',id);
                                anchor.attr('action','edit');
                                anchor.append('<i class="fa fa-pencil"></i>');
                                anchor.addClass('btn btn-icon btn-purple btn-rounded mr-2 mb-2 custom-link')
                                div.append(anchor)
                            }
                            if (ability.can(context.xprops.permission_prefix + 'delete')) {
                                let anchor = $('<a></a>');
                                anchor.attr('href', 'javascript:void(0)');
                                anchor.attr('deleteid', id);
                                anchor.append('<i class="fa fa-trash"></i>');
                                anchor.addClass('btn btn-icon btn-pink btn-rounded mr-2 mb-2 custom-delete')
                                div.append(anchor)
                            }
                            return div.html()

                        },
                        "className": "action",
                    }
                ],
                loadTables: false,

            }
        },
        created() {
            this.$root.relationships = this.relationships
            this.$eventHub.$on('rules-update', this.showTable)
        },
        mounted() {
            context = this;
        },
        destroyed() {
            this.resetState()
        },
        computed: {
            ...mapGetters('ExamsIndex', ['data', 'total', 'loading', 'relationships']),
        },
        watch: {
            query: {
                handler(query) {
                    this.setQuery(query)
                },
                deep: true
            }
        },
        methods: {
            ...mapActions('ExamsIndex', ['fetchData', 'setQuery', 'resetState']),
            showTable() {
                this.loadTables = true;
            }
        }
    }
</script>


<style scoped>

</style>
