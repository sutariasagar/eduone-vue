<template>
    <div class="cui-layout-footer">
        
        <div class="cui-footer">
            <div class="cui-footer-inner">
                <div class="cui-footer-bottom">
                    <div class="row">
                        <div class="col-md-4">
                            <!--<a href="https://themeforest.net/item/clean-ui-html-bootstrap-admin-template/22827565?ref=mediatec_software" target="_blank" class="btn btn-danger btn-sm">-->
                                <!--Buy Pro 21$-->
                            <!--</a>-->
                        </div>
                        <div class="col-md-8">
                            <div class="cui-footer-company">
                                <img class="cui-footer-company-logo" src="/cleanui/components/dummy-assets/common/img/techpure.png" title="Techpure Software">
                                <span>
                                    © 2019 <a href="http://techpure.co.uk/" target="_blank">Techpure</a>
                                    <br>
                                    All rights reserved.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {

        data() {
            return {
                showScroll: false,
                isIndex:true,
            }
        },
        watch: {
            "$route": function () {
                console.log(this.$route);
                let route = this.$route.name;
                if(route.includes('index')){
                    this.isIndex=true;
                }else{
                    this.isIndex=false;
                }
            },
        },
        methods: {
            handleScroll (event) {
                // Any code to be executed when the window is scrolled
                if ($(document).scrollTop() > 250) {
                    this.showScroll=true;
                }else{
                    this.showScroll=false;
                }
            },
            toggleSummary(event){
                this.$eventHub.$emit('toggle-called');
                //console.log("toggle summary called");
            }
        },
        created () {
            window.addEventListener('scroll', this.handleScroll);
        },
        destroyed () {
            window.removeEventListener('scroll', this.handleScroll);
        }
    }
</script>

<style scoped="">
    /* FOOTER */
    .cui-utils-scroll-top{
        border-radius: 25px;
    }
    .cui-footer {
        padding: 0 2.3rem;
        max-width: 120rem;
        margin: 0 auto;
    }

    @media (max-width: 767px) {
        .cui-footer {
            padding: 0 0.76rem;
        }
    }

    .cui-footer-inner {
        background: #e4e9f0;
        -webkit-border-radius: 5px 5px 0 0;
        border-radius: 5px 5px 0 0;
        padding: 0rem 1rem 1rem;
    }

    .cui-footer-bottom {
        padding-top: 1rem;
    }

    .cui-footer-company {
        padding-left: 3.84rem;
        position: relative;
        display: block;
        float: right;
    }

    @media (max-width: 767px) {
        .cui-footer-company {
            float: none;
            margin-top: 2.3rem;
        }
    }

    .cui-footer-company-logo {
        position: absolute;
        top: -5px;
        right:125px;
        width:90px;
    }

    .float{
        position:fixed;
        width:40px;
        height:40px;
        top:80px;
        right:40px;
        background-color:#0C9;
        color:#FFF;
        border-radius:50px;
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }

    .my-float{
        margin-top:15px;
    }
</style>