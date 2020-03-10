<template>
    <section class="card" >
        <custom-data-table :columns="columns" :url="'/api/v1/students'" :id="'StudentsDataTable'" :load="loadTables" :xprops="xprops"></custom-data-table>
    </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'


var context;
export default {
    data() {
        return {
            xprops: {
                module: 'StudentsIndex',
                route: 'students',
                permission_prefix: 'student_',
                eventbus: new Vue()
            },
            columns: [
                {data: 'id', name: 'id', label: "Id", group: 'basic', visible:false},
                {data: 'registration_id', name: 'registration_id', searchable: true, label: "Registration Id", group: 'basic', visible:true},
                {data: 'test_taker_id', name: 'test_taker_id', searchable: true, label: "Test Taker Id", group: 'basic', visible:true},
                {data: 'first_name', name: 'first_name', searchable: true, label: "First Name", group: 'basic', visible:true},
                {data: 'middle_name',name: 'middle_name', searchable: true, label: "Middle Name",group: 'advanced', visible:true},
                {data: 'last_name',name: 'last_name', searchable: true, label: "Last Name",group: 'advanced', visible:true},
                {data: 'email', name: 'email', searchable: true, label: "Email",group: 'advanced', visible:true},
                {data: 'phone', name: 'phone', searchable: true, label: "Phone", group: 'advanced', visible:false},
                {data: 'date_of_birth', name: 'date_of_birth', searchable: true, label: "Date Of Birth", group: 'basic', visible:true},
                {data: 'gender', name: 'gender', searchable: true, label: "Gender", group: 'basic', visible:true},
                {data: 'country', name: 'country', searchable: true, label: "Country", group: 'advanced', visible:false},
                {data: 'state',name: 'state', searchable: true, label: "State",group: 'advanced', visible:false},
                {data: 'city',name: 'city', searchable: true, label: "City",group: 'advanced', visible:false},
                {data: 'package',name: 'package.title', searchable: true, label: "Package",group: 'advanced', visible:false},
                {data:'created_at', name: 'created_at', searchable: true, visible:false, label: "Created At", group: 'advanced'},
                {data:'updated_at', name: 'updated_at', searchable: true, visible:false, label: "Updated At", group: 'advanced'},
                // {data:'created_by', name: 'created_by.name', searchable: true, visible:false, label: "Created By", group: 'advanced'},
                // {data:'updated_by', name: 'updated_by.name', searchable: true, visible:false, label: "Updated By", group: 'advanced'},
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
        ...mapGetters('StudentsIndex', ['data', 'total', 'loading', 'relationships']),
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
        ...mapActions('StudentsIndex', ['fetchData', 'setQuery', 'resetState']),
        showTable() {
            this.loadTables = true;
        }
    }
}
</script>


<style scoped>

</style>