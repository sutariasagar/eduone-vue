<template>
    <section class="card" >
        <custom-data-table :hideSettings="true" :columns="columns" :url="'/api/v1/practicequestions/seen'" :id="'practicequestions'" :load="loadTables" :xprops="xprops"></custom-data-table>
    </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'
var context;

export default {
    data() {
        return {
            xprops: {
                module: 'StudentPracticeQuestionsSeen',
                route: 'student.practicequestions',
                //permission_prefix: 'user_',
                eventbus: new Vue()
            },            
            'support-backup': true,
            columns: [
                    {data: 'id', name: 'id', label: "Id", group: 'basic', visible:false},
                    {data: 'question.title', name: 'question.title', searchable: true, label: "Title", group: 'basic'},                    
                    {data: 'question.chapter.title', name: 'question.chapter.title', searchable: true, label: "Chapter", group: 'basic'},                    
                    {data: 'question.tagged[0].tag_name', name: 'question.tagged[0].tag_name', searchable: false, label: "Difficulty Level", group: 'basic'},                    
                    // {data:'created_by', name: 'created_by.name', searchable: true, visible:false, label: "Created By", group: 'advanced'},
                    // {data:'updated_by', name: 'updated_by.name', searchable: true, visible:false, label: "Updated By", group: 'advanced'},
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        name: 'action',
                        group: 'basic',
                        label: "Action",
                        visible: 'true',
                        "render": function (data, type, row, meta) {

                            let id = row.question.id;
                            var div = $("<div></div>");
                            div.addClass('btn-group btn-group-xs');
                            
                                let anchor = $('<a></a>');
                                anchor.attr('href', 'javascript:void(0)');
                                anchor.attr('link','/admin/practicequestions/seen/'+ id);
                                anchor.attr('route',context.xprops.route);
                                anchor.attr('params',id);
                                anchor.attr('action','seenquestion');
                                anchor.append('<i class="fa fa-eye"></i>');
                                anchor.addClass('btn btn-icon btn-success btn-rounded mr-2 mb-2 custom-link')
                                div.append(anchor)                            
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
    mounted() {
        context = this;
    },
    destroyed() {
        this.resetState()
    },
    computed: {
        ...mapGetters('UsersIndex', ['data', 'total', 'loading', 'relationships']),
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
        ...mapActions('UsersIndex', ['fetchData', 'setQuery', 'resetState']),
        showTable() {
            this.loadTables = true;
        }
    }
}
</script>


<style scoped>

</style>
