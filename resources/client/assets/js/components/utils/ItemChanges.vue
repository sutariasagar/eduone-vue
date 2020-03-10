<template>

    <div class="card-body">
        <div class="p-1 accordion" role="tab">

            <div class="border-bottom-white" role="tab" v-b-toggle.information>
                <div class="card-title ">
                      <span class="accordion-indicator pull-right">
                        <i class="plus fa fa-plus"></i>
                        <i class="minus fa fa-minus"></i>
                      </span>
                    <h4>
                        <strong>Summary</strong>

                    </h4>

                </div>
            </div>
        </div>
        <b-collapse id="information" class="mt-1" visible>

                <div class="mt-4 col-md-12">
                    <item-details :heading="'Title'" :value="item.title"></item-details>
                    <item-details v-if="item.created_by" :heading="'Created By'" :value="item.created_by.name"></item-details>
                    <item-details :heading="'Created At'" :value="item.created_at"></item-details>
                    <item-details v-if="item.updated_by" :heading="'Last Updated By'" :value="item.updated_by.name"></item-details>
                    <item-details :heading="'Last Updated At'" :value="item.updated_at"></item-details>
                </div>

        </b-collapse>
    </div>


</template>


<script>
import ItemDetails from '../utils/ItemDetails.vue';
    export default {
        data() {
            return {
                // Code...
            }
        },
        components: {
            ItemDetails
        },
        props: ['item'],
        created() {
            // Code...
        }
    }
</script>


<style scoped>
    .row-alert {
        padding: 10px;
    }
    .access-information-inner{
        background-color: #e4e9f0;
    }
</style>
