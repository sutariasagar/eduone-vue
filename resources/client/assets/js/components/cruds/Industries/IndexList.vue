<template>
    <div v-if="!loading">
        <v-container fluid grid-list-md>
            <v-data-iterator
                    :items="data"
                    :rows-per-page-items="rowsPerPageItems"
                    :pagination.sync="pagination"
                    content-tag="v-layout"
                    row
                    wrap
            >
                <!--<template v-slot:header>-->
                <!--<v-toolbar-->
                <!--class="mb-2"-->
                <!--color="blue darken-2"-->
                <!--dark-->
                <!--flat-->
                <!--&gt;-->
                <!--<v-toolbar-title>This is a header</v-toolbar-title>-->
                <!--</v-toolbar>-->
                <!--</template>-->
                <template v-slot:item="props">
                    <v-flex
                            xs12
                            sm6
                            md4
                            lg3
                    >
                        <v-card>
                            <v-card-title class="subheading font-weight-bold">{{ props.item.title }}</v-card-title>

                            <v-divider></v-divider>

                            <v-list dense>
                                <v-list-tile>
                                    <v-list-tile-content>Title:</v-list-tile-content>
                                    <v-list-tile-content class="align-end">{{ props.item.title }}</v-list-tile-content>
                                </v-list-tile>


                            </v-list>
                        </v-card>
                    </v-flex>
                </template>
                <!--<template v-slot:footer>-->
                <!--<v-toolbar-->
                <!--class="mt-2"-->
                <!--color="blue"-->
                <!--dark-->
                <!--dense-->
                <!--flat-->
                <!--&gt;-->
                <!--<v-toolbar-title class="subheading">This is a footer</v-toolbar-title>-->
                <!--</v-toolbar>-->
                <!--</template>-->
            </v-data-iterator>
        </v-container>
    </div>
</template>


<script>
    import { mapGetters, mapActions } from 'vuex'
    import DatatableActions from '../../dtmodules/DatatableActions'
    import DatatableSingle from '../../dtmodules/DatatableSingle'
    import DatatableList from '../../dtmodules/DatatableList'
    import DatatableCheckbox from '../../dtmodules/DatatableCheckbox'


    export default {
        data() {
            return {
                rowsPerPageItems: [4, 8, 12],
                pagination: {
                    rowsPerPage: 8
                },
                xprops: {
                    module: 'IndustriesIndex',
                    route: 'industries',
                    permission_prefix: 'industry_'
                },
            }
        },
        created() {
            this.$root.relationships = this.relationships
            this.fetchData()
        },
        destroyed() {
            this.resetState()
        },
        computed: {
            ...mapGetters('IndustriesIndex', ['data', 'total', 'loading', 'relationships']),
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
            ...mapActions('IndustriesIndex', ['fetchData', 'setQuery', 'resetState']),
        }
    }
</script>


<style scoped>

</style>
