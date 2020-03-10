<template>
    <skeleton-loading>
        <row v-for="i in 4" :key="i">
            <column :span="1" :gutter="2" class="col-md-3 pl-3">
                <square-skeleton :count="3" :boxProperties="{
                        bottom: '15px',
                        height:'15px'
                    }">
                </square-skeleton>
            </column>
            <column :span="2" :gutter="5" class="col-md-9 pr-3">
                    <square-skeleton
                        :count="3"
                        :boxProperties="{
                            bottom: '15px',
                            height: '15px',
                        }"
                    >
                    </square-skeleton>
            </column>
        </row>
    </skeleton-loading>
</template>
<script>
export default {

}
</script>
