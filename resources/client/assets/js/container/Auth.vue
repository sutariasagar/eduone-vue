<template>
    <div>
        <event-hub></event-hub>
        <router-view></router-view>
    </div>
    <!-- <div class="cui-layout-content">
                        
                <div
                        class="cui-login"
                        style="background-image: url(/cleanui/components/pages/common/img/login/login.png);"
                >
                    <div class="cui-login-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="cui-login-header-logo">
                                    <a href="javascript: history.back();">
                                        <img src="/cleanui/components/dummy-assets/common/img/logo.png" alt="EDU One" class="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cui-login-header-menu">
                                    <ul class="list-unstyled list-inline">


                                        <li class="list-inline-item">

                                            <router-link :to="{ name: 'login' }">
                                                Login
                                            </router-link>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <event-hub></event-hub>
                    <router-view></router-view>

                    <div class="cui-login-footer">
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item"><a href="javascript: void(0);">Terms of Use</a></li>
                            <li class="active list-inline-item"><a href="javascript: void(0);">Compliance</a></li>
                            <li class="list-inline-item"><a href="javascript: void(0);">Support</a></li>
                        </ul>
                    </div>
                </div>
        

    </div> -->
</template>

<script>
    export default {
        name: 'auth',
        data() {
            return {
                // Code...
            }
        },
        computed: {

        },
        mounted() {

        },
    };
</script>
<style scoped="">
    .cui-login-footer ul li a{
        color:black;
    }
    .cui-login{
        height:100vh;
    }
    .cui-login-header-logo img{
        max-width:none;
        max-height: none;
        width: 250px;
    }
    .cui-login-header {
    -webkit-align-self: flex-start;
        -ms-flex-item-align: start;
            align-self: flex-start;
    width: 100%;
    color: #fff;
    padding: 1.07rem !important;
}
.cui-login-footer {
    -webkit-align-self: flex-end;
        -ms-flex-item-align: end;
            align-self: flex-end;
    width: 100%;
    color: white;
    padding-left: 5.4rem;
    padding-top: 1.2rem;
    padding-bottom: 0.6rem;
}
</style>
