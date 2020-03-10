<template>

        <ul class="-col-group col-md-6 p-3" v-bind:class="{ 'col-md-12': groupName === 'undefined' }" name="ColumnGroup">
            <label class="-col-group-title text-center text-black text-capitalize">
                {{ groupName === 'undefined' ? 'Mandatory Columns' : groupName }}
            </label>
            <li v-for="col in columns" class="">
                <div class="form-group row">
                    <div class="col-md-3">
                        <input
                                type="checkbox"
                                :id="uuidGen(col.name)"
                                :name="groupName"
                                :checked="isVisible(col.name)"
                                :disabled="typeof col.visible === 'string'"
                                @change="handleChange(col.name, $event.target.checked)"
                                class="form-control">
                    </div>
                    <label :for="uuidGen(col.data)" class="col-md-9 col-form-label">
                        {{ col.label}}
                        <i v-if="col.explain" class="fa fa-info-circle" style="cursor: help" :title="col.explain"></i>
                    </label>
                </div>
            </li>
        </ul>

</template>
<script>

    export default {
        name: 'ColumnGroup',
        props: {
            groupName: { type: String, required: true },
            columns: { type: Array, required: true },
            dtTable: {type: Object, required: true}
        },
        data: () => ({
            changes: [] // record the changes with a stack
        }),
        methods: {
            isVisible(col){
                let column = this.dtTable.column(col+':name');
                return column.visible();
            },
            handleChange (col, isChecked) {

                let column = this.dtTable.column(col+':name');

                // Toggle the visibility
                column.visible( ! column.visible() );
                this.dtTable.draw();
                //this.changes.push({ col, isChecked })
            },
            uuidGen (key) {
                // $vm._uid is a private property of a Vue instance
                return `-col-${this._uid}-${key}`
            },
            apply () {
                this.changes.forEach(({ col, isChecked }) => {
                    this.$set(col, 'visible', isChecked)
                })
                this.changes = [] // don't forget to clear the stack
            }
        }
    }
</script>
<style>
    .-col-group {
        display: inline-block;
        margin-bottom: 5px;
        padding: 0;
        width: 150px;
        vertical-align: top;
    }
    .-col-group-title {
        display: block;
        margin: 5px;
        padding: 5px;
        border-bottom: 1px solid #ddd;
        font-size: 18px;
    }
    .-col-group > li {
        margin-bottom: 5px;
        padding-left: 10px;
        list-style: none;
        line-height: 20px;
        font-size: 12px;
    }
    .-col-group > li > * {
        margin: 0;
        vertical-align: middle;
    }
</style>
