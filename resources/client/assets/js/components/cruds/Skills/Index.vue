<template>
    <section class="card" >
        <custom-data-table :columns="columns" :url="'/api/v1/skills'" :id="'SkillsDataTable'" :load="loadTables" :xprops="xprops"></custom-data-table>
    </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

var context;
export default {
    data() {
        return {
            xprops: {
                module: 'SkillsIndex',
                route: 'skills',
                permission_prefix: 'skill_',
                eventbus: new Vue()
            },
            columns: [
                {data:'id', name: 'id', label: "Id", searchable: true, group: 'basic', visible:true},
                {data:'title', name: 'title', searchable: true, label: "Title", group: 'basic'},
                {data:'created_at', name: 'created_at', searchable: true, visible:true, label: "Created At", group: 'advanced'},
                {data:'updated_at', name: 'updated_at', searchable: true, label: "Updated At", group: 'advanced'},
                {data:'created_by', name: 'created_by.name', searchable: true, visible:false, label: "Created By", group: 'advanced'},
                {data:'updated_by', name: 'updated_by.name', searchable: true, visible:false, label: "Updated By", group: 'advanced'},
                {
                    data:'action',
                    orderable: false,
                    searchable: false,
                    name: 'action',
                    label: "Action",
                    group: 'basic',
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
                    className: "action dt-body-right"

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
        ...mapGetters('SkillsIndex', ['data', 'total', 'loading', 'relationships']),
    },
    methods: {
        ...mapActions('SkillsIndex', ['fetchData', 'setQuery', 'resetState']),
        showTable() {
            this.loadTables = true;
        }
    }
}
</script>


<style scoped>

</style>
