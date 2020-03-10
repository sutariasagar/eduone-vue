<template>
    <!-- <nav class="cui-breadcrumbs cui-breadcrumbs-bg">
        <div class="pull-right">
        Your current plan is "Practice Pack"    
        </div>
        <span class="font-size-18 d-block">
            <span  v-for="(breadcrumb, idx) in breadcrumbList" :key="idx">

                <a @click="routeTo(idx)" class="text-muted" v-if="idx+1 < breadcrumbList.length"> {{ breadcrumb.name }}  ·</a>

                <a @click="routeTo(idx)" v-else><strong > {{ breadcrumb.name }} </strong> </a>
                <small class="text-muted" v-if="breadcrumb.extra"> {{ breadcrumb.extra }} </small>
            </span>
        </span>
    </nav> -->
    <div class="shadow-sm p-4 bg-white rounded mt-4 mb-0 text-uppercase text-center w-100">        

        <span  v-for="(breadcrumb, idx) in breadcrumbList" :key="idx">

        <a href="/admin/dashboard" v-if="idx+1 < breadcrumbList.length"><b class=""> {{ breadcrumb.name }} >> </b> </a>

        <a @click="routeTo(idx)" v-else class="font-weight-lighter"> {{ breadcrumb.name }} </a>   
        
    </span>
        <span style="color:#C5446A"> >> Your Current Plan <b>{{item.package.title}}</b>     </span>
    </div>
</template>


<script>
    import { mapGetters, mapActions } from 'vuex'
    import BackButton from './BackButton.vue';
    export default {
        components:{
            BackButton
        },
        data() {
            return {
                breadcrumbList: []
            }
        },
        computed: {
            ...mapGetters('Profile', ['item','loading']),
        },
        mounted() {
            this.updateList()
        },
        created() {
            // Code...
            //console.log(this.breadcrumbList);
        },
        watch: {
            '$route' (){
                this.updateList()
            }
        },
        methods: {
            updateList() {
                this.breadcrumbList = this.$route.meta.breadcrumb;
            },
            routeTo(pRouteTo) {
                if(this.breadcrumbList[pRouteTo].link)
                  this.$router.push(this.breadcrumbList[pRouteTo].link)
            },
            routerBack() {
                this.$router.go(-1)
            }
        }
    }
</script>


<style scoped>
    /* BREADCRUMBS */
    .cui-breadcrumbs {
        padding: 0.76rem 1.53rem;
        color: #0e0b20;
    }

    .cui-breadcrumbs-bg {
        background: #fff;
        border-bottom: 1px solid #e4e9f0;
    }

    @media (max-width: 767px) {
        .cui-breadcrumbs {
            padding: 1.15rem;
        }
    }
    span a{
        cursor:pointer;
    }
    span b{
        font-weight: bolder;
    }

</style>