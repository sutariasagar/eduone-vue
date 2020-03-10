<template>
    <div class="cui-layout cstbody">        
        <right-menu></right-menu>
        <top-student-menu></top-student-menu>
        <div class="cui-layout student">
            
            <div class="cui-layout-content">
                <bread-crumbs></bread-crumbs>
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
    import topStudentMenu from '../components/menu/StudentTop.vue';
    import breadCrumbs from '../components/StudentBreadCrumbs.vue';    
    import appFooter from '../components/StudentFooter.vue';
    import App from "../App.vue";
    export default {
        name: 'full',
        components: {
            App,
            leftMenu,
            rightMenu,
            topMenu,
            breadCrumbs,
            appFooter,
            topStudentMenu
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
