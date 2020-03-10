<template>
    <div>
        <nav class="cui-menu-left">
            <div class="cui-menu-left-trigger cui-menu-left-trigger-action" v-on:click="toggleLeftMenu()"></div>
            <div class="cui-menu-left-handler" style="margin-top:-50px" v-on:click="toggleLeftMobileMenu()">
                <div class="cui-menu-left-handler-icon"></div>
            </div>
            <div class="cui-menu-left-inner">
                <div class="cui-menu-left-logo">
                    <a href="/">
                        <img
                                class="cui-menu-left-logo-default"
                                src="/cleanui/components/dummy-assets/common/img/left-menu-logo.png"
                                alt=""
                        />
                        <img
                                class="cui-menu-left-logo-toggled"
                                src="/cleanui/components/dummy-assets/common/img/mobile-logo.png"
                                alt=""
                        />
                    </a>
                </div>
                <div class="cui-menu-left-scroll">
                    <ul class="cui-menu-left-list cui-menu-left-list-root">

                        <router-link :to="{ name: 'dashboard.admin' }" tag="li" class="cui-menu-left-item">
                            <a>
                                <span class="cui-menu-left-icon icmn-home"></span>
                                <span class="cui-menu-left-title">Dashboard</span>
                            </a>
                        </router-link>

                        <li class="cui-menu-left-divider" v-if="$can('user_management_access')">
                            <!-- -->
                        </li>

                        <li class="cui-menu-left-item cui-menu-left-submenu cui-menu-left-colorful-yellow" v-if="$can('user_management_access')" v-on:click="openSubMenu(this, $event)">
                            <a href="javascript:void(0)" >
                                <span class="cui-menu-left-icon icmn-user-tie"></span>
                                <span class="cui-menu-left-title">User Management</span>
                            </a>
                            <ul class="cui-menu-left-list" style="display: none;">

                                <router-link :to="{ name: 'permissions.index' }" class="cui-menu-left-item" tag="li"  v-if="$can('permission_access')">
                                    <a>
                                        <span class="cui-menu-left-icon">PI</span>
                                        <span class="cui-menu-left-title">Permissions</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'roles.index' }" class="cui-menu-left-item" tag="li"  v-if="$can('role_access')">
                                    <a>
                                        <span class="cui-menu-left-icon">RI</span>
                                        <span class="cui-menu-left-title">Roles</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'users.index' }" class="cui-menu-left-item" tag="li" v-if="$can('user_access')">
                                    <a>
                                        <span class="cui-menu-left-icon">UI</span>
                                        <span class="cui-menu-left-title">Users</span>
                                    </a>
                                </router-link>
                            </ul>
                        </li>

                        <li class="cui-menu-left-divider" v-if="$can('master_access')">
                            <!-- -->
                        </li>

                        <li class="cui-menu-left-item cui-menu-left-submenu cui-menu-left-colorful-warning" v-if="$can('master_access')" v-on:click="openSubMenu(this, $event)">
                            <a href="javascript:void(0)">
                                <span class="cui-menu-left-icon icmn-menu"></span>
                                <span class="cui-menu-left-title">Masters</span>
                            </a>
                            <ul class="cui-menu-left-list" style="display: none;">

                                <router-link :to="{ name: 'industries.index' }" class="cui-menu-left-item" tag="li" v-if="$can('industry_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-office"></span>
                                        <span class="cui-menu-left-title">Products</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'courses.index' }" class="cui-menu-left-item" tag="li" v-if="$can('course_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-office"></span>
                                        <span class="cui-menu-left-title">Courses</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'communication_skills.index' }" class="cui-menu-left-item" tag="li" v-if="$can('communication_skill_access')">
                                    <a>
                                        <span class="cui-menu-left-icon fa fa-file-text"></span>
                                        <span class="cui-menu-left-title">Communication Skills</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'enabling_skills.index' }" class="cui-menu-left-item" tag="li" v-if="$can('enabling_skill_access')">
                                            <a>
                                                <span class="cui-menu-left-icon fa fa-file-text"></span>
                                                <span class="cui-menu-left-title">Enabling Skills</span>
                                            </a>
                                </router-link>

                                <router-link :to="{ name: 'subjects.index' }" class="cui-menu-left-item"  tag="li" v-if="$can('subject_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-stack"></span>
                                        <span class="cui-menu-left-title">Subjects</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'chapters.index' }" class="cui-menu-left-item" tag="li" v-if="$can('chapter_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-file-text2"></span>
                                        <span class="cui-menu-left-title">Chapters</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'topics.index' }" class="cui-menu-left-item" tag="li" v-if="$can('topic_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-file-empty"></span>
                                        <span class="cui-menu-left-title">Topics</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'skills.index' }" class="cui-menu-left-item" tag="li" v-if="$can('skill_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-file-empty"></span>
                                        <span class="cui-menu-left-title">Skills</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'modules.index' }" class="cui-menu-left-item" tag="li" v-if="$can('module_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-file-empty"></span>
                                        <span class="cui-menu-left-title">Modules</span>
                                    </a>
                                </router-link>

                                <!--<li class="cui-menu-left-divider" v-if="$can('question_type_access')">

                                </li>

                                <li class="cui-menu-left-item" v-if="$can('question_type_access')">
                                    <router-link :to="{ name: 'question_types.index' }">
                                        <span class="cui-menu-left-icon icmn-file-empty"></span>
                                        <span class="cui-menu-left-title">Question Types</span>
                                    </router-link>
                                </li>-->

                                <router-link :to="{ name: 'questions_types.index' }" class="cui-menu-left-item" tag="li" v-if="$can('questions_type_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-file-empty"></span>
                                        <span class="cui-menu-left-title">Question Types</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'answers_types.index' }" class="cui-menu-left-item" tag="li" v-if="$can('answers_type_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-file-empty"></span>
                                        <span class="cui-menu-left-title">Answer Types</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'packages.index' }" class="cui-menu-left-item" tag="li" v-if="$can('package_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-file-empty"></span>
                                        <span class="cui-menu-left-title">Packages</span>
                                    </a>
                                </router-link>
                            </ul>
                        </li>

                        <li class="cui-menu-left-divider" v-if="$can('question_access')" >
                            <!-- -->
                        </li>

                        <li class="cui-menu-left-item cui-menu-left-submenu cui-menu-left-colorful-warning" v-if="$can('question_access')" v-on:click="openSubMenu(this, $event)">
                            <a href="javascript:void(0)">
                                <span class="cui-menu-left-icon icmn-library"></span>
                                <span class="cui-menu-left-title">Question Bank</span>
                            </a>
                            <ul class="cui-menu-left-list" style="display: none;">

                                <router-link :to="{ name: 'questions_banks.index' }" class="cui-menu-left-item" tag="li" v-if="$can('questions_bank_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-question"></span>
                                        <span class="cui-menu-left-title">Questions</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'question_sets.index' }" class="cui-menu-left-item" tag="li" v-if="$can('question_set_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-file-empty"></span>
                                        <span class="cui-menu-left-title">Question Sets</span>
                                    </a>
                                </router-link>

                            </ul>
                        </li>

                        <li class="cui-menu-left-divider" v-if="$can('learning_access')">
                            <!-- -->
                        </li>

                        <li class="cui-menu-left-item cui-menu-left-submenu cui-menu-left-colorful-warning" v-if="$can('learning_access')" v-on:click="openSubMenu(this, $event)">
                            <a href="javascript:void(0)">
                                <span class="cui-menu-left-icon icmn-file-text"></span>
                                <span class="cui-menu-left-title">Learning Material</span>
                            </a>
                            <ul class="cui-menu-left-list" style="display: none;">

                                <router-link :to="{ name: 'learning_materials.index' }" class="cui-menu-left-item" tag="li" v-if="$can('learning_material_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-book"></span>
                                        <span class="cui-menu-left-title">Learning Material Set</span>
                                    </a>
                                </router-link>

                                <router-link :to="{ name: 'learning_material_documents.index' }" class="cui-menu-left-item" tag="li" v-if="$can('learning_material_document_access')">
                                    <a>
                                        <span class="cui-menu-left-icon icmn-books"></span>
                                        <span class="cui-menu-left-title">Learning Material Docs</span>
                                    </a>
                                </router-link>
                            </ul>
                        </li>

                        <li class="cui-menu-left-divider" v-if="$can('student_access')">
                            <!-- -->
                        </li>
                        <router-link :to="{ name: 'students.index' }" class="cui-menu-left-item" tag="li" v-if="$can('student_access')">
                            <a>
                                <span class="cui-menu-left-icon fa fa-graduation-cap"></span>
                                <span class="cui-menu-left-title">Student Management</span>
                            </a>
                        </router-link>

                        <li class="cui-menu-left-divider" v-if="$can('terminal_access')">
                            <!-- -->
                        </li>
                        <router-link :to="{ name: 'terminals.index' }" class="cui-menu-left-item" tag="li" v-if="$can('terminal_access')">
                            <a>
                                <span class="cui-menu-left-icon fa fa-graduation-cap"></span>
                                <span class="cui-menu-left-title">Terminal Management</span>
                            </a>
                        </router-link>

                        <li class="cui-menu-left-divider" v-if="$can('exam_access')">
                            <!-- -->
                        </li>
                        <router-link :to="{ name: 'exams.index' }" class="cui-menu-left-item" tag="li" v-if="$can('exam_access')">
                                    <a>
                                        <span class="cui-menu-left-icon fa fa-file-text"></span>
                                        <span class="cui-menu-left-title">Exams</span>
                                    </a>
                        </router-link>

                        <li class="cui-menu-left-divider">
                            <!-- -->
                        </li>
                        <router-link :to="{ name: 'auth.change_password' }" class="cui-menu-left-item" tag="li">
                            <a>
                                <span class="cui-menu-left-icon fa fa-key"></span>
                                <span class="cui-menu-left-title">Change Password</span>
                            </a>
                        </router-link>


                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>
    import PerfectScrollbar from 'perfect-scrollbar';
    export default {
        data() {
            return {
                active: false,
                isTabletView: false,
                colorfulClasses: 'cui-menu-left-colorful-primary cui-menu-left-colorful-secondary cui-menu-left-colorful-primary cui-menu-left-colorful-default cui-menu-left-colorful-info cui-menu-left-colorful-success cui-menu-left-colorful-warning cui-menu-left-colorful-danger cui-menu-left-colorful-yellow',
            }
        },

        mounted() {
            //
            this.setColorfulClasses();

            this.$nextTick(() => {

                let vm = this;

                $('.cui-menu-left').after('<div class="cui-menu-left-backdrop"><!-- --></div>')

                if ($(window).innerWidth() <= 992) {
                    vm.isTabletView = true
                    vm.toggleMenu()
                }
                $(window).on('resize', function() {
                    if ($(window).innerWidth() <= 992) {
                        vm.isTabletView = true
                        vm.toggleMenu()

                    } else {
                        vm.isTabletView = false
                    }
                })



                if ($('body').find('.cui-menu-left').length) {
                    if (!/Mobi/.test(navigator.userAgent)) {
                        const menuCustomScroll = new PerfectScrollbar('.cui-menu-left-scroll', {
                            theme: 'cleanui',
                        });
                    }
                }
            });


        },

        methods: {

            openSubMenu(ele, event) {
                if ($('body').find('.cui-menu-left').length) {
                    var parent = $(event.target).parent();
                    var opened = $('.cui-menu-left-submenu-toggled')
                    //parent.addClass("simpleminds");

                    if (
                        !parent.hasClass('cui-menu-left-submenu-toggled') &&
                        !parent.parent().closest('.cui-menu-left-submenu').length
                    )
                        opened
                            .removeClass('cui-menu-left-submenu-toggled')
                            .find('> .cui-menu-left-list')
                            .slideUp(200)

                    parent.toggleClass('cui-menu-left-submenu-toggled')
                    var item = parent.find('> .cui-menu-left-list')
                    if (item.is(':visible')) {
                        item.slideUp(200)
                    } else {
                        item.slideDown(200)
                    }
                }
            },
            toggleMenu() {
                if (!this.isTabletView) {
                    $('body').addClass('cui-menu-left-toggled')
                }
            },
            toggleLeftMenu() {
                $('body').toggleClass('cui-menu-left-toggled');
            },
            removeColorfulClasses() {
                $('.cui-menu-left-list-root > .cui-menu-left-item').removeClass(colorfulClasses)
            },
            setColorfulClasses() {
                let colorfulClassesArray = this.colorfulClasses.split(' ')
                $('.cui-menu-left-list-root > .cui-menu-left-item').each(function () {
                    var randomClass =
                        colorfulClassesArray[Math.floor(Math.random() * colorfulClassesArray.length)]
                    $(this).addClass(randomClass)
                })

            },
            toggleLeftMobileMenu(){
                $('body').toggleClass('cui-menu-left-toggled-mobile')
            }


        }
    }
</script>
<style scoped="">
    /* MENU LEFT */
    .cui-menu-left {
        -webkit-box-flex: 0;
        -webkit-flex: 0 0 256px;
        -ms-flex: 0 0 256px;
        flex: 0 0 256px;
        max-width: 256px;
        min-width: 256px;
        width: 256px;
        position: relative;
        z-index: 100;
        font-size: 13px;
        -webkit-transition: -webkit-transform 0.3s;
        transition: -webkit-transform 0.3s;
        -o-transition: transform 0.3s;
        transition: transform 0.3s;
        transition: transform 0.3s, -webkit-transform 0.3s;
    }

    @media (min-width: 768px) {
        .cui-menu-left-shadow .cui-menu-left-inner {
            -webkit-box-shadow: 0 0 200px -30px rgba(57, 55, 73, 0.4);
            box-shadow: 0 0 200px -30px rgba(57, 55, 73, 0.4);
            border: none !important;
        }
    }

    .cui-menu-left-inner {
        position: fixed;
        width: 256px;
        height: 100%;
        overflow: hidden;
        background: #c54469;
        -webkit-transition: width 0.3s;
        -o-transition: width 0.3s;
        transition: width 0.3s;
    }


    .cui-menu-left-item a:hover{
        background-color: #b0254d;
    }

    @media (max-width: 767px) {
        .cui-menu-left-inner {
            overflow-y: auto;
        }
    }

    .cui-menu-left-logo {
        height: 80px;
        display: block;
        background: #FACF49;
        overflow: hidden;
        /*#C54469*/
    }
    .cui-menu-left-logo .cui-menu-left-logo-toggled{
        padding-left: 10px;
        padding-top: 10px;
        height: 70px !important;
    }

    .cui-menu-left-logo-default {
        display: block;
        height: 70px !important;
        padding-left: 44px;
        width: 208px;
        padding-top: 5px;
        padding-bottom: 1px;
    }

    .cui-menu-left-logo-toggled {
        display: none;
    }

    .cui-menu-left-logo img {
        height: 36px;
    }

    .cui-menu-left-buy-pro {
        padding: 1.53rem;
        background: #e4e9f0;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        text-align: center;
        margin: 1.53rem;
        overflow: hidden;
    }

    .cui-menu-left-trigger {
        position: fixed;
        z-index: 3;
        bottom: 0;
        width: 256px;
        height: 48px;
        background: #FACF49;
        -webkit-transition: width 0.3s;
        -o-transition: width 0.3s;
        transition: width 0.3s;
    }

    .cui-menu-left-trigger:after {
        content: '';
        display: block;
        width: 9px;
        height: 9px;
        position: absolute;
        top: 45%;
        left: 50%;
        border-left: 2px solid #fff;
        border-top: 2px solid #fff;
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    .cui-menu-left-scroll {
        position: absolute;
        top: 64px;
        height: -webkit-calc(100% - 64px - 48px);
        height: calc(100% - 64px - 48px);
        width: 100%;
    }

    .cui-menu-left-list {
        list-style: none;
        padding-left: 0;
        background-color: #C54469 !important
        ;
    }

    .cui-menu-left-list-root {
        margin: 1.53rem 0;
    }

    .cui-menu-left-divider {
        background: #fff;
        height: 1px;
        margin: 0 1.76rem 0.61rem;
    }

    .cui-menu-left-item {
        margin: 0.3rem 0 0.61rem;
        white-space: nowrap;
        overflow: hidden;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
    }

    .cui-menu-left-item > a {
        position: relative;
        min-height: 3.07rem;
        padding: 0.69rem 4.61rem 0.69rem 1.84rem;
        display: block;
        color: #fff;
    }

    .cui-menu-left-item > a:hover {
        color: #fff;
    }

    .cui-menu-left-item > a:hover .cui-menu-left-icon {
        color: #fff;
    }

    .cui-menu-left-item > a > .badge {
        margin-top: 0.23rem;
    }

    .cui-menu-left-item-active > a, .cui-menu-left-item-active:hover, .cui-menu-left-item-active:active, .cui-menu-left-item-active:focus {
        background: #C54469;
        color: #fff;
    }

    .cui-menu-left-item-active > a > .cui-menu-left-icon, .cui-menu-left-item-active:hover > .cui-menu-left-icon, .cui-menu-left-item-active:active > .cui-menu-left-icon, .cui-menu-left-item-active:focus > .cui-menu-left-icon {
        color: #fff;
    }

    .cui-menu-left-item-disabled > a {
        cursor: default;
        background: transparent !important;
        color: #fff !important;
        opacity: 0.4;
    }

    .cui-menu-left-item-disabled > a > .cui-menu-left-icon {
        color: #74708d !important;
    }

    .cui-menu-left-icon {
        position: absolute;
        width: 1.53rem;
        text-align: center;
        top: 1rem;
        right: 1.53rem;
        color: #fff;
        font-size: 13px;
        text-transform: uppercase;
        -webkit-transition: color 0.2s ease-in-out;
        -o-transition: color 0.2s ease-in-out;
        transition: color 0.2s ease-in-out;
    }

    .cui-menu-left-submenu .cui-menu-left-item > a {
        padding-left: 3.69rem;
    }

    .cui-menu-left-submenu > .cui-menu-left-list {
        display: none;
        background: #c54469;
    }

    .cui-menu-left-submenu.cui-menu-left-item > a:after, .cui-menu-left-submenu.cui-menu-left-item > a:before {
        content: '';
        position: absolute;
        right: 50px;
        top: 20px;
        vertical-align: baseline;
        background: #fff;
        width: 6px;
        height: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }

    .cui-menu-left-submenu.cui-menu-left-item > a:after {
        -webkit-transform: rotate(45deg) translateX(-2px);
        -ms-transform: rotate(45deg) translateX(-2px);
        transform: rotate(45deg) translateX(-2px);
    }

    .cui-menu-left-submenu.cui-menu-left-item > a:before {
        -webkit-transform: rotate(-45deg) translateX(2px);
        -ms-transform: rotate(-45deg) translateX(2px);
        transform: rotate(-45deg) translateX(2px);
    }

    .cui-menu-left-submenu.cui-menu-left-item > a:hover:after, .cui-menu-left-submenu.cui-menu-left-item > a:hover:before {
        background: #C54469 !important;
    }

    .cui-menu-left-submenu-toggled.cui-menu-left-item {
        background: #C54469;
    }

    .cui-menu-left-submenu-toggled.cui-menu-left-item > a {
        color: #fff;
    }

    .cui-menu-left-submenu-toggled.cui-menu-left-item > a .cui-menu-left-icon {
        color: #fff;
    }

    .cui-menu-left-submenu-toggled.cui-menu-left-item > a:after {
        -webkit-transform: rotate(-45deg) translateX(-2px);
        -ms-transform: rotate(-45deg) translateX(-2px);
        transform: rotate(-45deg) translateX(-2px);
    }

    .cui-menu-left-submenu-toggled.cui-menu-left-item > a:before {
        -webkit-transform: rotate(45deg) translateX(2px);
        -ms-transform: rotate(45deg) translateX(2px);
        transform: rotate(45deg) translateX(2px);
    }

    .cui-menu-left-submenu-toggled.cui-menu-left-item > .cui-menu-left-icon {
        color: #fff;
    }

    .cui-menu-left-handler {
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
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        background: #c54469;
        -webkit-border-radius: 0 4px 4px 0;
        border-radius: 0 4px 4px 0;
        -webkit-box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
    }

    .cui-menu-left-handler-icon {
        width: 14px;
        height: 2px;
        background: #fff;
        position: relative;
    }

    .cui-menu-left-handler-icon:after, .cui-menu-left-handler-icon:before {
        content: '';
        display: block;
        position: absolute;
        background: #fff;
        width: 100%;
        height: 2px;
    }

    .cui-menu-left-handler-icon:before {
        top: -5px;
    }

    .cui-menu-left-handler-icon:after {
        top: 5px;
    }

    @media (min-width: 768px) {
        .cui-menu-left-toggled .cui-menu-left {
            -webkit-box-flex: 0;
            -webkit-flex: 0 0 80px;
            -ms-flex: 0 0 80px;
            flex: 0 0 80px;
            max-width: 80px;
            min-width: 80px;
            width: 80px;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-inner {
            width: 80px;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-logo-default {
            display: none;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-logo-toggled {
            display: block;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-list-root > * {
            display: none;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-list-root > .cui-menu-left-item {
            display: block;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-list-root > .cui-menu-left-item > a {
            display: block;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-list-root > .cui-menu-left-item > a > * {
            display: none;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-list-root > .cui-menu-left-item > a:after, .cui-menu-left-toggled .cui-menu-left .cui-menu-left-list-root > .cui-menu-left-item > a:before {
            display: none;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-list-root > .cui-menu-left-item > a > .cui-menu-left-icon {
            right: 35px;
            display: inline;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-list-root > .cui-menu-left-item > .cui-menu-left-list {
            overflow: hidden;
            height: 0;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-list-root > .cui-menu-left-divider {
            display: block;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-list-root .cui-menu-left-item-special {
            display: none;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-trigger {
            width: 80px;
        }
        .cui-menu-left-toggled .cui-menu-left .cui-menu-left-trigger:after {
            left: 40%;
            -webkit-transform: rotate(-225deg);
            -ms-transform: rotate(-225deg);
            transform: rotate(-225deg);
        }
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-inner {
        width: 256px;
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-list-root > * {
        display: block;
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-list-root > .cui-menu-left-item > a > * {
        display: inline-block;
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-list-root > .cui-menu-left-item > a:after, .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-list-root > .cui-menu-left-item > a:before {
        display: block;
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-list-root > .cui-menu-left-item > a > .cui-menu-left-icon {
        right: 1.53rem;
        display: inline;
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-submenu-toggled > .cui-menu-left-list {
        overflow: visible;
        height: auto;
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-list-root .cui-menu-left-item-special {
        display: block;
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-logo-default {
        display: block;
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-logo-toggled {
        display: none;
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-trigger {
        width: 256px;
    }

    .cui-menu-left-toggled .cui-menu-left:hover .cui-menu-left-trigger:after {
        left: 50%;
        -webkit-transform: rotate(-225deg);
        -ms-transform: rotate(-225deg);
        transform: rotate(-225deg);
    }

    @media (max-width: 767px) {
        .cui-menu-left {
            position: fixed;
            z-index: 9999;
            height: 100%;
            top: 0;
            left: 0;
            overflow: visible;
            -webkit-transform: translateX(-256px);
            -ms-transform: translateX(-256px);
            transform: translateX(-256px);
        }
        .cui-menu-left .cui-menu-left-trigger {
            display: none;
        }
        .cui-menu-left .cui-menu-left-scroll {
            height: -webkit-calc(100% - 64px);
            height: calc(100% - 64px);
        }
        .cui-menu-left .cui-menu-left-handler {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
        }
        .cui-menu-left-toggled-mobile .cui-menu-left {
            -webkit-transform: translateX(0);
            -ms-transform: translateX(0);
            transform: translateX(0);
        }
    }

    .cui-menu-left-list-root > .cui-menu-left-item {
        position: relative;
    }

    .cui-menu-left-list-root > .cui-menu-left-item:before {
        content: '';
        position: absolute;
        z-index: 2;
        left: 0;
        top: 0;
        width: 2px;
        height: 100%;
        background: transparent;
    }

    .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-primary:hover:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-primary.cui-menu-left-submenu-toggled:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-primary.cui-menu-left-item-active:before {
        background-color: #C54469;
    }

    .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-secondary:hover:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-secondary.cui-menu-left-submenu-toggled:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-secondary.cui-menu-left-item-active:before {
        background-color: #6a7a84;
    }

    .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-default:hover:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-default.cui-menu-left-submenu-toggled:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-default.cui-menu-left-item-active:before {
        background-color: #acb7bf;
    }

    .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-info:hover:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-info.cui-menu-left-submenu-toggled:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-info.cui-menu-left-item-active:before {
        background-color: #0887c9;
    }

    .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-success:hover:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-success.cui-menu-left-submenu-toggled:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-success.cui-menu-left-item-active:before {
        background-color: #46be8a;
    }

    .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-warning:hover:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-warning.cui-menu-left-submenu-toggled:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-warning.cui-menu-left-item-active:before {
        background-color: #f39834;
    }

    .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-danger:hover:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-danger.cui-menu-left-submenu-toggled:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-danger.cui-menu-left-item-active:before {
        background-color: #fb434a;
    }

    .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-yellow:hover:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-yellow.cui-menu-left-submenu-toggled:before, .cui-menu-left-list-root > .cui-menu-left-item.cui-menu-left-colorful-yellow.cui-menu-left-item-active:before {
        background-color: yellow;
    }

    @media (max-width: 767px) {
        .cui-menu-left-backdrop {
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
            -o-transition: opacity 0.2s ease-in-out;
            transition: opacity 0.2s ease-in-out;
        }
        .cui-menu-left-toggled-mobile .cui-menu-left-backdrop {
            opacity: 0.4;
            visibility: visible;
        }
    }

    /*  JSCROLLPNAE CUSTOM STYLES */
    .cui-menu-left .jspScrollable {
        outline: none;
    }

    .cui-menu-left .jspScrollable:hover .jspVerticalBar {
        opacity: 0.7;
        -webkit-transition: all 0.4s ease-in-out;
        -o-transition: all 0.4s ease-in-out;
        transition: all 0.4s ease-in-out;
    }

    .cui-menu-left .jspScrollable:hover .jspHorizontalBar {
        opacity: 0.7;
        -webkit-transition: all 0.4s ease-in-out;
        -o-transition: all 0.4s ease-in-out;
        transition: all 0.4s ease-in-out;
    }

    .cui-menu-left .jspScrollable .jspTrack {
        left: -2px !important;
    }

    .cui-menu-left .jspScrollable .jspVerticalBar {
        background: transparent;
        width: 3px;
        opacity: 0;
        -webkit-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .cui-menu-left .jspScrollable .jspHorizontalBar {
        background: transparent;
        height: 4px;
        opacity: 0;
        bottom: 1px;
        -webkit-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .cui-menu-left .jspScrollable .jspHorizontalBar .jspDrag:after {
        background: #514d6a;
        top: 0;
        bottom: 0;
    }

    .cui-menu-left .jspScrollable .jspPane,
    .cui-menu-left .jspScrollable .jspContainer {
        width: 100% !important;
    }

    .cui-menu-left .jspScrollable .jspCap {
        display: none;
    }

    .cui-menu-left .jspScrollable .jspTrack {
        background: transparent;
        position: relative;
        width: 2px;
        left: -5px;
    }

    .cui-menu-left .jspScrollable .jspDrag {
        background: transparent;
        position: relative;
        top: 0;
        left: -1px;
        width: 5px;
        cursor: pointer;
        -webkit-border-radius: 0;
        border-radius: 0;
    }

    .cui-menu-left .jspScrollable .jspDrag:after {
        display: block;
        content: '';
        background: #C54469;
        position: absolute;
        width: 100%;
        top: 4px;
        bottom: 4px;
        -webkit-border-radius: 20px;
        border-radius: 20px;
    }
    .cui-theme-blue .cui-menu-left-submenu-toggled.cui-menu-left-item{
        color: #fff;
        background: #C54469;
    }
    .cui-menu-left-submenu.cui-menu-left-item > a:hover:after, .cui-menu-left-submenu.cui-menu-left-item > a:hover:before {
        background: #fff;
    }

</style>
