<template>
    <div class="cui-layout">                
        <top-student-menu></top-student-menu>        
        <div class="cui-layout">            
            <div class="cui-layout-content">                                
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
    import examFooter from '../components/ExamFooter.vue';
    import appFooter from '../components/Footer.vue';
    import App from "../App.vue";
    export default {
        name: 'full',
        components: {
            App,
            leftMenu,            
            topMenu,            
            examFooter,
            topStudentMenu,
            appFooter
        },
        data() {
            return {
                // Code...
            }
        },
        mounted(){
            //alert("here");
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
