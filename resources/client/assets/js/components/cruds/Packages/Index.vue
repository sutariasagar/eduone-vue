<template>
    <section class="card" >
        <custom-data-table :columns="columns" :url="'/api/v1/packages'" :id="'PackagesDataTable'" :load="loadTables" :xprops="xprops"></custom-data-table>
    </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'
import components from '../../dtmodules'
    
var context;
export default {
    components,
    data() {
        return {
            xprops: {
                module: 'PackagesIndex',
                route: 'packages',
                permission_prefix: 'package_',
                eventbus: new Vue()
            },
            columns: [
                {data: 'id', name: 'id', label: "Id", searchable: true, group: 'basic', visible:true},
                {data: 'title', name: 'title', searchable: true, label: "Title", group: 'basic'},
                {data: 'price', name: 'price', searchable: true, label: "Price", group: 'advanced', sortable: true, orderable: "false"},
                {data: 'status', name: 'status',searchable: true, label: 'Status', sortable: true ,group: 'advanced', visible:true, orderable: "false"},
                {data: 'tests_with_assessment', name: 'tests_with_assessment', searchable: true, label: "Tests With Assessment", group: 'advanced', visible:false, sortable: true, orderable: "false"},
                {data: 'video_tutorials', name: 'video_tutorials', searchable: true, label: "Video Tutorials", group: 'advanced', visible:false, sortable: true, orderable: "false"},
                {data: 'practice_questions', name: 'practice_questions',searchable: true, label: 'Practice Questions', sortable: true ,group: 'advanced', visible:false, orderable: "false"},
                {data: 'mock_tests', name: 'mock_tests', searchable: true, label: "Mock Tests", group: 'advanced', visible:false, sortable: true, orderable: "false"},
                {data: 'pte_vouchers', name: 'pte_vouchers', searchable: true, label: "Pte Vouchers ", group: 'advanced', visible:false, sortable: true, orderable: "false"},
                {data: 'webinar_sessions', name: 'webinar_sessions',searchable: true, label: 'Webinar Sessions', sortable: true ,group: 'advanced', visible:false, orderable: "false"},
                {data: 'personal_feedback_and_assessment', name: 'personal_feedback_and_assessment', searchable: true, label: "Personal Feedback And Assessment", group: 'advanced', visible:false, sortable: true, orderable: "false"},
                {data: 'coaching_session_daily', name: 'coaching_session_daily', searchable: true, label: "Coaching Session Daily", group: 'advanced', visible:false, sortable: true, orderable: "false"},
                {data: 'unique_package_name', name: 'unique_package_name',searchable: true, label: 'Unique Package Name', sortable: true ,group: 'advanced', visible:false, orderable: "false"},
                {data: 'created_at', name: 'created_at', searchable: true, visible:false, label: "Created At", group: 'advanced'},
                {data: 'updated_at', name: 'updated_at', searchable: true, visible:false, label: "Updated At", group: 'advanced'},
                {data: 'created_by', name: 'created_by.name', searchable: true, visible:false, label: "Created By", group: 'advanced'},
                {data: 'updated_by', name: 'updated_by.name', searchable: true, visible:false, label: "Updated By", group: 'advanced'},
                {
                    data: 'action',
                    orderable: false,
                    searchable: false,
                    name: 'action',
                    group: 'basic',
                    visible: 'true',
                    label: "Action",
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
            loadTables: false
        }
    },
    created() {
        this.$root.relationships = this.relationships
        this.$eventHub.$on('rules-update', this.showTable)
    },
    destroyed() {
        this.resetState()
    },
    mounted() {
        context = this;
    },
    computed: {
        ...mapGetters('PackagesIndex', ['data', 'total', 'loading', 'relationships']),
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
        ...mapActions('PackagesIndex', ['fetchData', 'setQuery', 'resetState']),
        showTable() {
            this.loadTables = true;
        }
    }
}
</script>


<style scoped>

</style>