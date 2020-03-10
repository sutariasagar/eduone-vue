@inject('request', 'Illuminate\Http\Request')

<nav class="cui-menu-left">
    <div class="cui-menu-left-trigger cui-menu-left-trigger-action"></div>
    <div class="cui-menu-left-handler">
        <div class="cui-menu-left-handler-icon"></div>
    </div>
    <div class="cui-menu-left-inner">
        <div class="cui-menu-left-logo">
            <a href="/">
                <img
                class="cui-menu-left-logo-default"
                src="{{ asset('/cleanui/components/dummy-assets/common/img/logo-inverse.png')}}"
                alt=""
                />
                <img
                class="cui-menu-left-logo-toggled"
                src="{{ asset('/cleanui/components/dummy-assets/common/img/logo-mobile.png')}}"
                alt=""
                />
            </a>
        </div>
        <div class="cui-menu-left-scroll">
            <ul class="cui-menu-left-list cui-menu-left-list-root">

                <li class="cui-menu-left-item">
                    <router-link :to="{ name: 'dashboard.index' }">
                        <span class="cui-menu-left-icon icmn-home"></span>
                        <span class="cui-menu-left-title">Dashboard</span>
                    </router-link>
                </li>

                <li class="cui-menu-left-divider">
                    <!-- -->
                </li>

                <li class="cui-menu-left-item cui-menu-left-submenu cui-menu-left-colorful-yellow" v-if="$can('user_management_access')">
                    <a href="#">
                        <span class="cui-menu-left-icon icmn-file-text"></span>
                        <span class="cui-menu-left-title">User Management</span>
                    </a>
                    <ul class="cui-menu-left-list" style="display: none;">
                        <li class="cui-menu-left-item" v-if="$can('permission_access')">

                            <router-link :to="{ name: 'permissions.index' }">
                                <span class="cui-menu-left-icon">PI</span>
                                <span class="cui-menu-left-title">@lang('quickadmin.permissions.title')</span>
                            </router-link>
                        </li>
                        <li class="cui-menu-left-item" v-if="$can('role_access')">

                            <router-link :to="{ name: 'roles.index' }">
                                <span class="cui-menu-left-icon">RI</span>
                                <span class="cui-menu-left-title">@lang('quickadmin.roles.title')</span>
                            </router-link>
                        </li>
                        <li class="cui-menu-left-item" v-if="$can('user_access')">

                            <router-link :to="{ name: 'users.index' }">
                                <span class="cui-menu-left-icon">UI</span>
                                <span class="cui-menu-left-title">@lang('quickadmin.users.title')</span>
                            </router-link>
                        </li>

                    </ul>
                </li>

                <li class="cui-menu-left-divider">
                    <!-- -->
                </li>
                <li class="cui-menu-left-item">
                    <router-link :to="{ name: 'auth.change_password' }">
                        <span class="cui-menu-left-icon fa fa-key"></span>
                        <span class="title">@lang('quickadmin.qa_change_password')</span>
                    </router-link>
                </li>

            </ul>
        </div>
    </div>
</nav>