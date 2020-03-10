<template>
    <!-- <div class="">
        <div class="row">
            <div class="col-xl-6 mt-3">
                <div class="cui-login-block-inner pull-left col-md-12 ml-5 custom-shadow">
                    <div class="cui-login-block-form">
                        <h4 class="text-uppercase">
                            <strong>Please log in</strong>
                        </h4>
                        <br />
                        <div class="alert alert-danger" v-if="has_error">
                            <strong>Oops</strong> There are some errors in your input:
                            <br><br>
                            <ul>
                                <li>{{ message }}</li>
                            </ul>
                        </div>
                        <div class="alert alert-danger" v-if="session_expired">
                            <ul>
                                <li>{{ message }}</li>
                            </ul>
                        </div>
                        <form autocomplete="off" @submit.prevent="login" method="post">
                            <div class="form-group">
                                <label class="form-label">E-mail</label>
                                <input
                                    class="form-control"
                                    placeholder="Email or Username"
                                    v-model="email"
                                    type="email"
                                />
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                <input
                                    class="form-control password password-group"
                                    v-model="password"
                                    type="password"
                                    placeholder="Password"
                                />
                                 <div class="input-group-append" v-on:click="switchVisibility">
                                    <span class="input-group-text">
                                    <i  class="fa fa-eye"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" v-model="remember" name="remember" checked />
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="form-actions row">
                                <span class="col-md-5"><button type="submit" class=" btn custom-color">Sign In</button></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<div>
    <div class="loginform">
			<div class="logincn">
				<img src="images/loginlogo.png" class="loginlogo">
				<div class="loginwelcome mb-4">
					<div class="welcome">Welcome to</div>
					<div class="welcomeyour"><span>Your dreams</span></div>
				</div>
                <div class="alert alert-danger" v-if="has_error">
                            <strong>Oops</strong> There are some errors in your input:
                            <br><br>
                            <ul>
                                <li>{{ message }}</li>
                            </ul>
                        </div>
                        <div class="alert alert-danger" v-if="session_expired">
                            <ul>
                                <li>{{ message }}</li>
                            </ul>
                        </div>
                <form autocomplete="off" @submit.prevent="login" method="post" class="dologinform pt-4">
                            <div class="form-group">
                                <label class="cst-label font-weight-bolder m-0">E-mail</label>
                                <input
                                    class="form-control"
                                    placeholder="Email or Username"
                                    v-model="email"
                                    type="email"
                                />
                            </div>
                            <div class="form-group">
                                <label class="cst-label font-weight-bolder m-0">Password</label>
                                <div class="input-group">
                                <input
                                    class="form-control password password-group"
                                    v-model="password"
                                    type="password"
                                    placeholder="Password"
                                />
                                 <div class="input-group-append" v-on:click="switchVisibility">
                                    <span class="input-group-text">
                                    <i  class="fa fa-eye"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" v-model="remember" name="remember" checked />
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4 text-left">
                                <button class="btn bg-theme text-white rounded-pill px-4" type="submit">Login</button>                                
                            </div>
                        </form>
				<!-- <form class="dologinform pt-4">
					<div class="form-group">
		  				<label class="cst-label font-weight-bolder m-0">Email</label>
		  				<input type="text" class="cstinput form-control border-top-0 border-left-0 border-right-0 rounded-0 px-0" value="abcd@example.com">
		  			</div>
		  			<div class="form-group">
		  				<label class="cst-label font-weight-bolder m-0">Password</label>
		  				<input type="password" class="cstinput form-control border-top-0 border-left-0 border-right-0 rounded-0 px-0" value="12345">
		  			</div>
		  			<div class="mt-4 text-left">
		  				<button class="btn bg-theme text-white rounded-pill px-4">Login</button>
		  			</div>
				</form> -->
			</div>
		</div>
		<div class="loginwrapper">
			<div class="cstbackground"></div>
		</div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                email: null,
                password: null,
                remember: false,
                has_error: false,
                message:"",
                session_expired: false
            }
        },

        mounted() {
            //
            this.checkSessionMessage()
        },

        methods: {
            checkSessionMessage(){
                if(this.$route.query.sessionExpired){
                    this.session_expired = true;
                    this.message = "Your session is expired kindly login."
                }
            },
            switchVisibility(e){
            (e.target.closest('.input-group').querySelector('.password-group'))
            let element = e.target.closest('.input-group').querySelector('.password-group');
                if(e.target.closest('.input-group').querySelector('.password-group').type == 'password'){
                    e.target.closest('.input-group').querySelector('.password-group').type = 'text';
                }else{
                e.target.closest('.input-group').querySelector('.password-group').type = 'password';
                }
            },
            login() {
                let context = this;
                context.has_error = false;
                context.session_expired = false;
                axios
                    .post('/login', this.requestData(), {
                    })
                    .then(function(response) {
                        if(response.data.success){
                            context.$router.push(response.data.redirect_to);
                        }else{
                            context.has_error = true;
                            context.message = response.data.message
                        }

                    })
                    .catch(function(error) {
                        console.error(error)
                        return false;
                    });

            },
            requestData: function(){
                let obj={
                    email: this.email,
                    password: this.password,
                    remember: this.remember
                };
                return obj;
            }
        }
    }
</script>
<style scoped="">
/* For screen resolution of iPhone 6/7/8 plus */
@media only screen and (max-width:414px) {
    .cui-login-block-inner{
        right: 20px;
    }
}
/* For screen resolution of iPhone 6/7/8 */
@media only screen and (max-width:375px) {
    .cui-login-block-inner{
        bottom: 20px;
        right: 50px;
    }
}
/* For screen resolution of iPhone 5/SE */
@media only screen and (max-width:320px) {
    .cui-login-block-inner{
        bottom: 20px;
        right:  50px;
    }
}
/* For screen resolution of Samsung galaxy5s */
@media only screen and (max-width:360px) {
    .cui-login-block-inner{
        right:  50px;
    }
}
    .custom-color{
        background-color: #00d78c;
        border-color: #00d78c;
        color:#fff
    }
    .custom-color:hover{
        background-color: #09d772;
        border-color: #09d772;
        color:#fff
    }
    .cui-utils-link-blue{
        color: #00d78c
    }
    .custom-shadow {
        -webkit-box-shadow: 0 0 1rem #e1e1e1 !important;
        box-shadow: 0 0 1rem #e1e1e1 !important;
        border-top: 5px solid #00d78c !important;
    }
    .font-16{
        font-size: 16px;
    }
    /* social icons css */
    ul.social-network {
        list-style: none;
        display: inline;
        margin-left:0 !important;
        padding: 0;
    }
    ul.social-network li {
        display: inline;
        margin: 0 5px;
    }
    .social-network a.icoYoutube:hover {
        background-color: #c4302b;
        border: 1px solid #c4302b;
        transition: all 0.4s ease-in-out;
    }
    .social-network a.icoFacebook:hover {
        background-color:#3B5998;
        border: 1px solid #3B5998;
        transition: all 0.4s ease-in-out;
    }
    .social-network a.icoTwitter:hover {
        background-color:#33ccff;
        border: 1px solid #33ccff;
        transition: all 0.4s ease-in-out;
    }
    .social-network a.icoGoogle:hover {
        background-color:#BD3518;
        border: 1px solid #BD3518;
        transition: all 0.4s ease-in-out;
    }
    .social-network a.icoLinkedin:hover {
        background-color:#007bb7;
        border: 1px solid #007bb7;
        transition: all 0.4s ease-in-out;
    }
    .social-network a.icoFacebook:hover i, .social-network a.icoTwitter:hover i,
    .social-network a.icoGoogle:hover i, .social-network a.icoYoutube:hover i, .social-network a.icoLinkedin:hover i {
        color:#fff;
    }
    a.socialIcon:hover, .socialHoverClass {
        color:#44BCDD;
    }
    .social-circle li a {
        display:inline-block;
        position:relative;
        margin:0 auto 0 auto;
        -moz-border-radius:50%;
        -webkit-border-radius:50%;
        border-radius:50%;
        text-align:center;
        width: 35px;
        height: 35px;
        font-size:15px;
        border: 1px solid rgba(0,0,0,0.3);
    }
    .social-circle li i {
        margin:0;
        line-height:34px;
        text-align: center;
    }
    .social-circle li a:hover i, .triggeredHover {
        /* -moz-transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
        -ms--transform: rotate(360deg);
        transform: rotate(360deg); */
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -ms-transition: all 0.5s;
        transition: all 0.5s ease-in-out;
    }
    .social-circle i {
        color: #000;
        -webkit-transition: all 0.8s;
        -moz-transition: all 0.8s;
        -o-transition: all 0.8s;
        -ms-transition: all 0.8s;
        transition: all 0.8s ease-in-out;
    }

</style>
