<template>
    <div class="cui-layout cui-layout-has-sider">
        <left-menu></left-menu>
        <right-menu></right-menu>
        <div class="cui-layout">
            <top-menu></top-menu>
            <div class="cui-layout-content">
                <!--@include('partials.breadcrumbs')-->
                <div class="cui-utils-content">
                    <event-hub></event-hub>
                    <router-view></router-view>
                </div>
            </div>
            <app-footer></app-footer>
        </div>
    </div>
</template>

<script>

    import leftMenu from '../components/menu/Left.vue';
    import rightMenu from '../components/menu/Right.vue';
    import topMenu from '../components/menu/Top.vue';
    import appFooter from '../components/Footer.vue';
    import App from "../App.vue";
    export default {
        name: 'full',
        components: {
            App,
            leftMenu,
            rightMenu,
            topMenu,
            appFooter
        },
        data() {
            return {
                // Code...
            }
        },
        computed: {
            name() {
                return this.$route.name;
            },
            list() {
                return this.$route.matched;
            }
        }
    };
</script>
