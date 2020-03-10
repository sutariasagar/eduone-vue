<template>
    <section class="card">
        <custom-data-table :columns="columns" :url="'/api/v1/exams/'+$route.params.id+'/students'" :id="'StudentsDataTable'" :childButtons=true :load="loadTables" :xprops="xprops"></custom-data-table>
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
                {data: 'first_name', name: 'first_name', searchable: true, label: "First Name", group: 'basic', visible:true},
                {data: 'middle_name',name: 'middle_name', searchable: true, label: "Middle Name",group: 'advanced', visible:true},
                {data: 'last_name',name: 'last_name', searchable: true, label: "Last Name",group: 'advanced', visible:true},
                {data: 'email', name: 'email', searchable: true, label: "Email",group: 'advanced', visible:true},
                {data: 'phone', name: 'phone', searchable: true, label: "Phone", group: 'advanced', visible:false},
                {data: 'country', name: 'country', searchable: true, label: "Country", group: 'advanced', visible:false},
                {data: 'state',name: 'state', searchable: true, label: "State",group: 'advanced', visible:false},
                {data: 'city',name: 'city', searchable: true, label: "City",group: 'advanced', visible:false},                
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
                            anchor.attr('link','/'+context.xprops.route + '/' + context.$route.params.id + '/students' + id + '/review' );
                            anchor.attr('route',context.xprops.route);
                            anchor.attr('student_id',id);
                            anchor.attr('exam_id',context.$route.params.id);
                            anchor.attr('action','review');
                            anchor.append('<i class="fa fa-eye"></i>');
                            anchor.addClass('btn btn-icon btn-success btn-rounded mr-2 mb-2 custom-student-link')
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