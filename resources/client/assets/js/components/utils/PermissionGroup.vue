<template>

    <ul class="-col-group col-md-6 p-3" v-bind:class="{ 'col-md-12': groupName === 'undefined' }" name="ColumnGroup">
        <label class="-col-group-title text-center text-black text-capitalize">
            {{ groupName }}
        </label>
        <li v-for="col in columns" class="">
            <div class="form-group row">
                <div class="col-md-3">
                    <input
                            type="checkbox"
                            :name="groupName"
                            @change=""
                            class="form-control">
                </div>
                <label  class="col-md-9 col-form-label">
                    {{ col.label}}
                </label>
            </div>
        </li>
    </ul>

</template>
<script>

</script>