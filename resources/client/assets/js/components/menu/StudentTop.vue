<template>
<b-navbar toggleable="lg" type="dark" variant="info" class="cstnavbar navbar navbar-expand-md navbar-dark pl-5">
<!-- <b class="cstnavbar navbar navbar-expand-md navbar-dark pl-5"> -->
			<a class="navbar-brand" href="/admin/dashboard">
				<img src="/cleanui/components/dummy-assets/common/img/logo-student.png" alt="Logo">
			</a>
             <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

			<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button> -->
    <b-collapse id="nav-collapse" is-nav>
    <b-navbar-nav>
        <ul class="navbar-nav mr-auto nav-left">
					<li class="nav-item active">
						<a class="nav-link" href="https://www.ptetopper.com/pricing-pte-vouchers/" target="_blank">Buy PTE Voucher</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://www.ptetopper.com/pte-mock-test-center-2/" target="_blank">Book Mock Center Test</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://www.ptetopper.com/blog/" target="_blank">Download Brochures</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://www.ptetopper.com/blog/" target="_blank">Blog</a>
					</li>
				</ul>
    </b-navbar-nav>
    <b-navbar-nav class="ml-auto">
				<ul class="navbar-nav nav-right mr-3">
                     <b-dropdown id="ddown-left" left class="nav-item dropdown">
                        <template slot="button-content" class="dropdown-toggle check" >
                              <span class=" custom-avatar">
                                <img v-if="item.profile_image && item.profile_image.id"  :src="'/storage/'+item.profile_image.id+'/'+item.profile_image.file_name"  class="rounded-circle" alt="">
                                <img v-else  src="/cleanui/components/dummy-assets/common/img/avatars/1.jpg"  class="rounded-circle" alt="">
                              </span>
                        </template>

							<b-dropdown-item class="dropdown-item" href="/admin/me">
                            Profile
                            </b-dropdown-item>
							<div class="dropdown-divider"></div>
                            <b-dropdown-item class="dropdown-item" href="/admin/changepassword">
                            Change Password
                            </b-dropdown-item>
							<div class="dropdown-divider"></div>
                            <b-dropdown-item href="#logout" onclick="$('#logout').submit()" class="dropdown-item">Logout</b-dropdown-item>

                    </b-dropdown>
				</ul>
      </b-navbar-nav>
    </b-collapse>
</b-navbar>
    <!-- <nav class="cui-menu-top">

      <div class="cui-menu-top-inner">
        <div class="cui-menu-top-logo">
          <a href="/admin/dashboard">
           <img
                                class="cui-menu-left-logo-default"
                                src="/cleanui/components/dummy-assets/common/img/left-menu-logo.png"
                                alt=""
                        />
          </a>
        </div>
        <div class="cui-menu-top-scroll">
          <ul class="cui-menu-top-list cui-menu-top-list-root">
            <li class="cui-menu-top-item cui-menu-top-colorful-success">
              <a href="javascript: void(0);" class="cui-menu-right-action-toggle">
                <span class="cui-menu-top-icon icmn-cog"></span>
                <span class="cui-menu-top-title">Buy PTE Voucher</span>
              </a>
            </li>
            <li class="cui-menu-top-item cui-menu-top-colorful-danger">
              <a href="https://docs.cleanuitemplate.com/" target="_blank">
                <span class="cui-menu-top-icon icmn-books"></span>
                <span class="cui-menu-top-title"> Book Mock Center Test</span>
              </a>
            </li>
            <li class="cui-menu-top-item cui-menu-top-colorful-danger">
              <a href="https://docs.cleanuitemplate.com/" target="_blank">
                <span class="cui-menu-top-icon icmn-books"></span>
                <span class="cui-menu-top-title">Download brochures</span>
              </a>
            </li>
            <li class="cui-menu-top-item cui-menu-top-colorful-danger">
              <a href="https://docs.cleanuitemplate.com/" target="_blank">
                <span class="cui-menu-top-icon icmn-books"></span>
                <span class="cui-menu-top-title">Blog</span>
              </a>
            </li>
              <li class="cui-menu-top-item cui-menu-top-submenu cui-menu-top-colorful-default left-30">
                <a href="javascript: void(0);" class="p-1">
                  <span class="cui-topbar-avatar">
                    <img v-if="item.profile_image && item.profile_image.id"  :src="'/storage/'+item.profile_image.id+'/'+item.profile_image.file_name"  class="rounded-circle" alt="">
                    <img v-else  src="/cleanui/components/dummy-assets/common/img/avatars/1.jpg"  class="rounded-circle" alt="">
                    </span>
                </a>
                <ul class="cui-menu-top-list">
                <li class="cui-menu-top-item cui-menu-top-submenu">
                    <router-link :to="{ name: 'student.profile' }"><i class="dropdown-icon icmn-user"></i>Profile</router-link>
                    <a href="#logout" onclick="$('#logout').submit()"><i class="dropdown-icon icmn-exit"></i>Logout</a>
                    </li>
                </ul>
              </li>
            </ul>

          </div>
      </div>
    </nav> -->
</template>
<script>
    import { mapGetters, mapActions } from 'vuex'
    import Avatar from 'vue-avatar'
    export default {
        components: {
            Avatar
        },
        computed: {
            ...mapGetters('Profile', ['item','loading']),
        },
    }
</script>
<style scoped="">

/* MENU TOP */
.cui-menu-top {
    -webkit-box-flex: 0;
            flex: 0 0 256px;
    max-width: 256px;
    min-width: 256px;
    width: 256px;
    position: relative;
    z-index: 100;
    font-size: 13px;
    -webkit-transition: -webkit-transform 0.3s;
    transition: -webkit-transform 0.3s;
    transition: transform 0.3s;
    transition: transform 0.3s, -webkit-transform 0.3s;
}

.cui-menu-top-inner {
    position: fixed;
    width: 256px;
    height: 100%;
    overflow: hidden;
    background: #001529;
    -webkit-transition: width 0.3s;
    transition: width 0.3s;
}

@media (max-width: 767px) {
    .cui-menu-top-inner {
        overflow-y: auto;
    }
}

.cui-menu-top-logo {
    height: 64px;
    display: block;
    background: white;
    padding: 0px;
    padding-left: 20px;
    overflow: hidden;
}

.cui-menu-top-logo-default {
    display: block;
}

.cui-menu-top-logo-toggled {
    display: none;
}

.cui-menu-top-logo img {
    height: 48px;
    width: 140px;
}

.cui-menu-top-buy-pro {
    padding: 1.53rem;
    background: #e4e9f0;
    border-radius: 3px;
    text-align: center;
    margin: 1.53rem;
    overflow: hidden;
}

.cui-menu-top-scroll {
    position: absolute;
    top: 64px;
    height: calc(100% - 64px);
    width: 100%;
    background:white !important;
}

.cui-menu-top-list {
    list-style: none;
    padding-left: 0;
}

.cui-menu-top-list-root {
    margin: 1.53rem 0;
}

.cui-menu-top-divider {
    background: #393749;
    height: 1px;
    margin: 0 1.76rem 0.61rem;
}

.cui-menu-top-item {
    margin: 0.3rem 0 0.61rem;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.cui-menu-top-item > a {
    position: relative;
    min-height: 3.07rem;
    padding: 0.69rem 4.61rem 0.69rem 1.84rem;
    display: block;
    color: #b8beca;
}

.cui-menu-top-item > a:hover {
    color: #fff;
}

.cui-menu-top-item > a:hover .cui-menu-top-icon {
    color: #fff;
}

.cui-menu-top-item > a > .badge {
    margin-top: 0.23rem;
}

.cui-menu-top-item-active > a, .cui-menu-top-item-active:hover, .cui-menu-top-item-active:active, .cui-menu-top-item-active:focus {
    background: #0190fe;
    color: #fff;
}

.cui-menu-top-item-active > a > .cui-menu-top-icon, .cui-menu-top-item-active:hover > .cui-menu-top-icon, .cui-menu-top-item-active:active > .cui-menu-top-icon, .cui-menu-top-item-active:focus > .cui-menu-top-icon {
    color: #fff;
}

.cui-menu-top-item-disabled > a {
    cursor: default;
    background: transparent !important;
    color: #b8beca !important;
    opacity: 0.4;
}

.cui-menu-top-item-disabled > a > .cui-menu-top-icon {
    color: #74708d !important;
}

.cui-menu-top-icon {
    position: absolute;
    width: 1.53rem;
    text-align: center;
    top: 1rem;
    right: 1.53rem;
    color: #74708d;
    font-size: 13px;
    text-transform: uppercase;
    -webkit-transition: color 0.2s ease-in-out;
    transition: color 0.2s ease-in-out;
}

.cui-menu-top-submenu .cui-menu-top-item > a {
    padding-left: 3.69rem;
}

.cui-menu-top-submenu > .cui-menu-top-list {
    display: none;
    background: #000c17;
}

.cui-menu-top-submenu.cui-menu-top-item > a:after, .cui-menu-top-submenu.cui-menu-top-item > a:before {
    content: '';
    position: absolute;
    right: 50px;
    top: 20px;
    vertical-align: baseline;
    background: #b8beca;
    width: 6px;
    height: 2px;
    border-radius: 2px;
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
}

.cui-menu-top-submenu.cui-menu-top-item > a:after {
    -webkit-transform: rotate(45deg) translateX(-2px);
            transform: rotate(45deg) translateX(-2px);
}

.cui-menu-top-submenu.cui-menu-top-item > a:before {
    -webkit-transform: rotate(-45deg) translateX(2px);
            transform: rotate(-45deg) translateX(2px);
}

.cui-menu-top-submenu.cui-menu-top-item > a:hover:after, .cui-menu-top-submenu.cui-menu-top-item > a:hover:before {
    background: #0190fe;
}

.cui-menu-top-submenu-toggled.cui-menu-top-item {
    background: #000c17;
}

.cui-menu-top-submenu-toggled.cui-menu-top-item > a {
    color: #fff;
}

.cui-menu-top-submenu-toggled.cui-menu-top-item > a .cui-menu-top-icon {
    color: #fff;
}

.cui-menu-top-submenu-toggled.cui-menu-top-item > a:after {
    -webkit-transform: rotate(-45deg) translateX(-2px);
            transform: rotate(-45deg) translateX(-2px);
}

.cui-menu-top-submenu-toggled.cui-menu-top-item > a:before {
    -webkit-transform: rotate(45deg) translateX(2px);
            transform: rotate(45deg) translateX(2px);
}

.cui-menu-top-submenu-toggled.cui-menu-top-item > .cui-menu-top-icon {
    color: #fff;
}

.cui-menu-top-handler {
    position: absolute;
    right: -41px;
    top: 72px;
    width: 41px;
    height: 40px;
    cursor: pointer;
    z-index: 0;
    text-align: center;
    line-height: 40px;
    font-size: 16px;
    display: none;
    -webkit-box-pack: center;
            justify-content: center;
    -webkit-box-align: center;
            align-items: center;
    background: #001529;
    border-radius: 0 4px 4px 0;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
}

.cui-menu-top-handler-icon {
    width: 14px;
    height: 2px;
    background: #fff;
    position: relative;
}

.cui-menu-top-handler-icon:after, .cui-menu-top-handler-icon:before {
    content: '';
    display: block;
    position: absolute;
    background: #fff;
    width: 100%;
    height: 2px;
}

.cui-menu-top-handler-icon:before {
    top: -5px;
}

.cui-menu-top-handler-icon:after {
    top: 5px;
}

@media (min-width: 768px) {
    .cui-menu-top {
        position: relative;
        display: block;
        -webkit-box-flex: 0;
                flex: none;
        height: 48px;
        min-width: 0;
        max-width: none;
        width: auto;
    }
    .cui-menu-top-inner {
        position: static;
        overflow: visible;
        height: 48px;
        width: auto;
        border: none !important;
    }
    .cui-menu-top-logo {
        width: 200px;
        height: 48px;
        padding: 0px;
        padding-left: 20px;
    }
    .cui-menu-top-logo img {
        height: 48px;
    }
    .cui-menu-top-icon {
        height: 14px;
        line-height: 14px;
    }
    .cui-menu-top-scroll {
        overflow: visible;
        position: absolute;
        top: 0;
        left: 200px;
        right: 0;
        height: 48px;
        width: 200%;
        border-bottom: 1px solid transparent;
    }
    .cui-menu-top-list-root {
        margin: 0;
    }
    .cui-menu-top-list-root > .cui-menu-top-item {
        float: left;
        margin: 0;
    }
    .cui-menu-top-list-root > .cui-menu-top-item > a {
        height: 48px;
        padding: 1.07rem 1.3rem 0;
        line-height: 20px;
    }
    .cui-menu-top-list-root > .cui-menu-top-item > a .cui-menu-top-icon {
        float: left;
        position: static;
        margin: 0 0.38rem 0 0 !important;
        height: 19px;
        line-height: 19px;
        color: #74708d;
    }
    .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-submenu > a::before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-submenu > a::after {
        display: none !important;
    }
    .cui-menu-top-list-root .cui-menu-top-item {
        position: relative;
        z-index: 10;
    }
    .cui-menu-top-list-root .cui-menu-top-submenu > .cui-menu-top-list {
        position: absolute;
        z-index: 20;
        top: 100%;
        left: 0;
        display: none;
        box-shadow: 0 10px 35px -5px rgba(0, 0, 0, 0.15);
    }
    .cui-menu-top-list-root .cui-menu-top-submenu:hover {
        z-index: 20;
    }
    .cui-menu-top-list-root .cui-menu-top-submenu:hover > .cui-menu-top-list {
        display: block;
    }
    .cui-menu-top-list-root .cui-menu-top-submenu .cui-menu-top-item > a {
        padding-left: 23px !important;
    }
    .cui-menu-top-list-root .cui-menu-top-submenu .cui-menu-top-submenu > .cui-menu-top-list {
        top: 0;
        left: 100%;
    }
}

@media (max-width: 767px) {
    .cui-menu-top {
        position: fixed;
        z-index: 9999;
        height: 100%;
        top: 0;
        left: 0;
        overflow: visible;
        -webkit-transform: translateX(-256px);
                transform: translateX(-256px);
    }
    .cui-menu-top .cui-menu-top-handler {
        display: -webkit-box;
        display: flex;
    }
    .cui-menu-top-toggled-mobile .cui-menu-top {
        -webkit-transform: translateX(0);
                transform: translateX(0);
    }
}

.cui-menu-top-list-root > .cui-menu-top-item {
    position: relative;
}

.cui-menu-top-list-root > .cui-menu-top-item:before {
    content: '';
    position: absolute;
    z-index: 2;
    left: 0;
    top: 0;
    width: 2px;
    height: 100%;
    background: transparent;
}

@media (min-width: 768px) {
    .cui-menu-top-list-root > .cui-menu-top-item:before {
        left: 0;
        top: auto;
        bottom: 0;
        height: 2px;
        width: 100%;
    }
}

.cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-primary:hover:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-primary.cui-menu-top-submenu-toggled:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-primary.cui-menu-top-item-active:before {
    background-color: #0190fe;
}

.cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-secondary:hover:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-secondary.cui-menu-top-submenu-toggled:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-secondary.cui-menu-top-item-active:before {
    background-color: #6a7a84;
}

.cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-default:hover:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-default.cui-menu-top-submenu-toggled:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-default.cui-menu-top-item-active:before {
    background-color: #acb7bf;
}

.cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-info:hover:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-info.cui-menu-top-submenu-toggled:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-info.cui-menu-top-item-active:before {
    background-color: #0887c9;
}

.cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-success:hover:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-success.cui-menu-top-submenu-toggled:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-success.cui-menu-top-item-active:before {
    background-color: #46be8a;
}

.cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-warning:hover:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-warning.cui-menu-top-submenu-toggled:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-warning.cui-menu-top-item-active:before {
    background-color: #f39834;
}

.cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-danger:hover:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-danger.cui-menu-top-submenu-toggled:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-danger.cui-menu-top-item-active:before {
    background-color: #fb434a;
}

.cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-yellow:hover:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-yellow.cui-menu-top-submenu-toggled:before, .cui-menu-top-list-root > .cui-menu-top-item.cui-menu-top-colorful-yellow.cui-menu-top-item-active:before {
    background-color: yellow;
}

@media (max-width: 767px) {
    .cui-menu-top-backdrop {
        position: fixed;
        z-index: 999;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: #0e0b20;
        opacity: 0;
        visibility: hidden;
        -webkit-transition: opacity 0.2s ease-in-out;
        transition: opacity 0.2s ease-in-out;
    }
    .cui-menu-top-toggled-mobile .cui-menu-top-backdrop {
        opacity: 0.4;
        visibility: visible;
    }
}

@media (min-width: 992px) {
    .cui-menu-top-backdrop + .cui-layout .cui-utils-content,
    .cui-menu-top-backdrop + .cui-layout .cui-footer {
        padding-left: 0;
    }
}

/*  JSCROLLPNAE CUSTOM STYLES */
.cui-menu-top .jspScrollable {
    outline: none;
}

.cui-menu-top .jspScrollable:hover .jspVerticalBar {
    opacity: 0.7;
    -webkit-transition: all 0.4s ease-in-out;
    transition: all 0.4s ease-in-out;
}

.cui-menu-top .jspScrollable:hover .jspHorizontalBar {
    opacity: 0.7;
    -webkit-transition: all 0.4s ease-in-out;
    transition: all 0.4s ease-in-out;
}

.cui-menu-top .jspScrollable .jspTrack {
    left: -2px !important;
}

.cui-menu-top .jspScrollable .jspVerticalBar {
    background: transparent;
    width: 3px;
    opacity: 0;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}

.cui-menu-top .jspScrollable .jspHorizontalBar {
    background: transparent;
    height: 4px;
    opacity: 0;
    bottom: 1px;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}

.cui-menu-top .jspScrollable .jspHorizontalBar .jspDrag:after {
    background: #514d6a;
    top: 0;
    bottom: 0;
}

.cui-menu-top .jspScrollable .jspPane,
.cui-menu-top .jspScrollable .jspContainer {
    width: 100% !important;
}

.cui-menu-top .jspScrollable .jspCap {
    display: none;
}

.cui-menu-top .jspScrollable .jspTrack {
    background: transparent;
    position: relative;
    width: 2px;
    left: -5px;
}

.cui-menu-top .jspScrollable .jspDrag {
    background: transparent;
    position: relative;
    top: 0;
    left: -1px;
    width: 5px;
    cursor: pointer;
    border-radius: 0;
}

.cui-menu-top .jspScrollable .jspDrag:after {
    display: block;
    content: '';
    background: #514d6a;
    position: absolute;
    width: 100%;
    top: 4px;
    bottom: 4px;
    border-radius: 20px;
}
.cui-topbar-avatar {
        width: 2.69rem;
        height: 2.69rem;
        border-color: #d2d9e5;
        display: inline-block;
        overflow: hidden;
        -webkit-border-radius: 500px;
        border-radius: 5px;
    }

    .cui-topbar-avatar img {
        width: 100%;
        height: auto;
    }

    .cui-topbar-avatar-dropdown .dropdown-toggle {
        padding-right: 1.38rem;
        display: inline-block;
        background-color: transparent !important;
        border: none !important;
    }

    .cui-topbar-avatar-dropdown .dropdown-toggle:after {
        position: absolute;
        top: 50%;
        margin-top: -5px;
        right: 0rem;
    }
    .left-30{
        left:16%;
    }

    .btn.btn-secondary, .show > .btn.btn-secondary{
        background-color: transparent !important;
        border: none !important;
    }
.custom-avatar{
    float: left;
    margin-left: -16px;
    height: 26px;
}
.custom-avatar img{
    height: 36px;
}

</style>
