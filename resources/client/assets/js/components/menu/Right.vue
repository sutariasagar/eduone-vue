<template>
<div class="cui-menu-right">
    <div class="cui-menu-right-inner">
        <div class="cui-menu-right-header">
            <span class="fa fa-times pull-right cui-menu-right-action-toggle"><!-- --></span>
            Theme Settings
        </div>
        <div class="cui-menu-right-content">
            <div class="cui-menu-right-descr">
                This module "block-menu-right" gives possibility to construct custom blocks with any
                widgets, components and elements inside, like this theme settings
            </div>
            <div class="cui-menu-right-label">
                Theme Style
            </div>
            <div class="cui-menu-right-setting cui-menu-right-example-option">
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-theme" value="" /> Dark
                        </label>
                    </div>
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-theme" value="cui-theme-light" /> Light
                        </label>
                    </div>
                </div>
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-theme" value="cui-theme-green" /> Green
                        </label>
                    </div>
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-theme" value="cui-theme-blue" /> Blue
                        </label>
                    </div>
                </div>
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-theme" value="cui-theme-red" /> Red
                        </label>
                    </div>
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-theme" value="cui-theme-orange" /> Orange
                        </label>
                    </div>
                </div>
            </div>
            <div class="cui-menu-right-label">
                Menu Shadow
            </div>
            <div class="cui-menu-right-setting cui-menu-right-example-option">
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-shadow" value="cui-menu-left-shadow" /> On
                        </label>
                    </div>
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-shadow" value="" /> Off
                        </label>
                    </div>
                </div>
            </div>
            <div class="cui-menu-right-label">
                Borderless Cards
            </div>
            <div class="cui-menu-right-setting cui-menu-right-example-option">
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-borderless" value="cui-config-borderless" /> On
                        </label>
                    </div>
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-borderless" value="" /> Off
                        </label>
                    </div>
                </div>
            </div>
            <div class="cui-menu-right-label">
                Squared Corners
            </div>
            <div class="cui-menu-right-setting cui-menu-right-example-option">
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-corners" value="cui-config-squared-corners" /> On
                        </label>
                    </div>
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-corners" value="" /> Off
                        </label>
                    </div>
                </div>
            </div>
            <div class="cui-menu-right-label">
                Fixed Width
            </div>
            <div class="cui-menu-right-setting cui-menu-right-example-option">
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-boxed" value="cui-config-fixed-width" /> On
                        </label>
                    </div>
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-boxed" value="" /> Off
                        </label>
                    </div>
                </div>
            </div>
            <div class="cui-menu-right-label">
                Colorful Menu
            </div>
            <div class="cui-menu-right-setting cui-menu-right-example-option">
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-colorful" value="cui-menu-left-colorful" /> On
                        </label>
                    </div>
                    <div class="btn-group">
                        <label class="btn btn-default">
                            <input type="radio" name="options-colorful" value="" /> Off
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>

</script>

<style scoped="">
    /*  MENU RIGHT */
    .cui-menu-right {
        position: fixed;
        z-index: 995;
        top: 0;
        right: 0;
        width: 19.23rem;
        height: 100%;
        background: #eef0f4;
        -webkit-transform: translate3d(19.23rem, 0, 0);
        transform: translate3d(19.23rem, 0, 0);
        -webkit-transition: -webkit-transform 0.2s ease-in-out;
        transition: -webkit-transform 0.2s ease-in-out;
        -o-transition: transform 0.2s ease-in-out;
        transition: transform 0.2s ease-in-out;
        transition: transform 0.2s ease-in-out, -webkit-transform 0.2s ease-in-out;
        overflow-y: auto;
    }

    .cui-menu-right-example-option input {
        display: none;
    }

    .cui-menu-right-inner {
        padding: 1.53rem;
    }

    .cui-menu-right-header {
        border-bottom: 1px solid #e4e9f0;
        padding: 0.38rem 0;
        font-weight: bold;
        color: #74708d;
        min-height: 3.46rem;
    }

    .cui-menu-right-header span {
        cursor: pointer;
        position: relative;
        top: 0.23rem;
        color: #d2d9e5;
        font-size: 1.23rem;
    }

    .cui-menu-right-header span:hover {
        color: #b8beca;
    }

    .cui-menu-right-content {
        padding: 1.53rem 0;
    }

    .cui-menu-right-descr {
        font-size: 0.92rem;
        color: #74708d;
        margin-bottom: 1.53rem;
        line-height: 1.8;
    }

    .cui-menu-right-label {
        color: #74708d;
        font-size: 0.92rem;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 0.76rem;
    }

    .cui-menu-right-setting {
        margin-bottom: 1.15rem;
    }

    .cui-menu-right-visible .cui-menu-right {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
        -webkit-box-shadow: 0 0 200px -30px rgba(57, 55, 73, 0.4);
        box-shadow: 0 0 200px -30px rgba(57, 55, 73, 0.4);
    }

</style>