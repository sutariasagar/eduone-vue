<template>
    <div class="btn-group btn-group-xs">

        <router-link
                v-if="$can(xprops.permission_prefix + 'view')"
                :to="{ name: xprops.route + '.show', params: { id: row.id } }"
                class="btn btn-icon btn-success btn-rounded mr-2 mb-2"
                >
            <i class="fa fa-eye"></i>
        </router-link>

        <router-link
                v-if="$can(xprops.permission_prefix + 'edit')"
                :to="{ name: xprops.route + '.edit', params: { id: row.id } }"
                class="btn btn-icon btn-purple btn-rounded mr-2 mb-2">
            <i class="fa fa-pencil"></i>
        </router-link>

        <a
                v-if="$can(xprops.permission_prefix + 'delete')"
                @click="destroyData(row.id)"
                href="javascript:void(0)"
                class="btn btn-icon btn-pink btn-rounded mr-2 mb-2">
            <i class="fa fa-trash"></i>
        </a>
   </div>
</template>


<script>
export default {
    props: ['row', 'xprops'],
    data() {
        return {
            // Code...
        }
    },
    created() {
        // Code...
    },
    methods: {
        destroyData(id) {
            this.$swal({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#dd4b39',
                focusCancel: true,
                reverseButtons: true
            }).then(result => {
                if (result.value) {
                    this.$store.dispatch(
                        this.xprops.module + '/destroyData',
                        id
                    ).then(result => {
                        this.$eventHub.$emit('delete-success')
                    })
                }
            })
        }
    }
}
</script>


<style scoped>
    .btn-group > .btn:not(:last-child):not(.dropdown-toggle), .btn-group > .btn-group:not(:last-child) > .btn {
        border-top-right-radius: 100px;
        border-bottom-right-radius: 100px;
    }
    .btn-group > .btn:not(:first-child), .btn-group > .btn-group:not(:first-child) > .btn{
        border-top-left-radius: 100px;
        border-bottom-left-radius: 100px;
    }

</style>
