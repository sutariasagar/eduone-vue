<template>
<div>
    <footer class="cstfooter p-4 mt-4">
        <a href="#" class="float" @click="toggleSummary()" v-if="!isIndex">
            <i class="fa fa-columns my-float"></i>
        </a>
			<div class="row cstmax75">
				<div class="col-md-4 links">
					<h3 class="mb-4">Other Links</h3>
					<ul class="list-unstyled">
						<li><a target="_blank" href="https://pearsonpte.com/book-now">PTE Official Website</a></li>
						<li><a target="_blank" href="https://pearsonpte.com/articles/?sort=latest">PTE Latest Update</a></li>
						<li><a target="_blank" href="https://immi.homeaffairs.gov.au/visas/getting-a-visa/visa-finder">Australian Migration Official Website</a></li>
						<li><a target="_blank" href="https://www.immigration.govt.nz/new-zealand-visas">New Zealand Migration Official Website</a></li>
					</ul>
				</div>
				<div class="col-md-4 links">
					<h3 class="mb-4">Helpful Pages</h3>
					<ul class="list-unstyled">
						<li><a target="_blank" href="https://pearsonpte.com/wp-content/uploads/2017/08/Score-Guide.pdf">PTE Score Guide (PDF)</a></li>
						<li><a target="_blank" href="https://www.ptetopper.com">Student Visa Process</a></li>
						<li><a target="_blank" href="#">Submit Video Testimonial</a></li>
						<li><a href="#">Refer a Friend</a></li>
					</ul>
				</div>
				<div class="col-md-4 links contactinfo">
					<h3 class="mb-4">Reach Us</h3>
					<ul class="list-unstyled">
						<li>We always look forward to hear from you!</li>
						<li><a href="tel:+91-9510086913" class="fg-theme"><i class="fa fa-phone"></i> &nbsp;+91 79 23242424</a></li>
						<li><a href="mailto:contact@ptetopper.com" class="fg-theme"><i class="fa fa-envelope"></i> &nbsp;contact@ptetopper.com</a></li>
						<li><a href="https://www.ptetopper.com" class="fg-theme" target="_blank"><i class="fa fa-globe"></i> &nbsp;https://www.ptetopper.com/</a></li>
					</ul>
				</div>
			</div>
		</footer>
		<div class="bottomfooter bg-white p-3">
			<div class="row cstmax75">
				<div class="col-md-6 text-left">
					<span class="cstcopyright">Copyright &copy; 2019 Techpure, UK All rights reserved.</span>
				</div>
				<div class="col-md-6 text-md-right text-sm-left">
					<ul class="list-unstyled sociallink m-0">
						<li class="d-inline-block"><a href=""><i class="fa fa-facebook-f"></i></a></li>
						<li class="d-inline-block"><a href=""><i class="fa fa-twitter"></i></a></li>
						<li class="d-inline-block"><a href=""><i class="fa fa-google-plus"></i></a></li>
						<li class="d-inline-block"><a href=""><i class="fa fa-youtube"></i></a></li>
						<li class="d-inline-block"><a href=""><i class="fa fa-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
        <a href="javascript: void(0);" v-if="showScroll" class="cui-utils-scroll-top" onclick="$('body, html').animate({'scrollTop': 0}, 500)"><i class="icmn-arrow-up"></i></a>



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
    /* For screen resolution of iPhone 5/SE */
     @media only screen and (max-width:320px){
        .cui-footer-company-logo{
            left:10px;
        }
        .cui-footer-company-logo-title1{
            margin-left:80px;
        }
        .cui-footer-company-logo-title2{
            margin-left:80px;
        }
    }
    /* For screen resolution of iPhone 6/7/8 plus */
    @media only screen and (max-width:414px){
        .cui-footer-company-logo{
            left:10px;
        }
        .cui-footer-company-logo-title1{
            margin-left:180px;
        }
        .cui-footer-company-logo-title2{
            margin-left:180px;
        }
    }


    .float{
        position:absolute;
        width:40px;
        height:40px;
        top:106px;
        right:44px;
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
