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