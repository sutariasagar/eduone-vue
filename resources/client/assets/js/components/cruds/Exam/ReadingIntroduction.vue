<template>
    <section class="container">
        <section class="content-header text-center">
            <h3>Reading Section</h3>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In metus vulputate eu scelerisque. Metus vulputate eu scelerisque felis. Etiam sit amet nisl purus in mollis. Posuere lorem ipsum dolor sit. Viverra maecenas accumsan lacus vel. Blandit aliquam etiam erat velit scelerisque in dictum non consectetur. Quam pellentesque nec nam aliquam sem et tortor. Condimentum mattis pellentesque id nibh tortor id aliquet lectus proin. Neque sodales ut etiam sit amet nisl purus in mollis. Ut sem viverra aliquet eget sit amet tellus. Viverra nibh cras pulvinar mattis. Vestibulum sed arcu non odio euismod. At imperdiet dui accumsan sit amet nulla facilisi.
                    </p>
                    <br>
                    <p>Volutpat lacus laoreet non curabitur. Dapibus ultrices in iaculis nunc sed augue. Lobortis scelerisque fermentum dui faucibus in ornare quam viverra. Lobortis mattis aliquam faucibus purus in. In hendrerit gravida rutrum quisque. Sodales ut eu sem integer vitae justo. Est ultricies integer quis auctor elit sed vulputate mi sit. Aliquam malesuada bibendum arcu vitae. Mauris sit amet massa vitae tortor condimentum lacinia. Gravida dictum fusce ut placerat orci nulla pellentesque dignissim. Id diam maecenas ultricies mi eget mauris pharetra et.
                    </p>
                    <br>
                    <p>Dictum sit amet justo donec enim diam vulputate ut. Cursus metus aliquam eleifend mi in nulla posuere sollicitudin aliquam. Id neque aliquam vestibulum morbi blandit cursus risus. Nulla at volutpat diam ut venenatis tellus. Varius morbi enim nunc faucibus a pellentesque sit amet. Ipsum dolor sit amet consectetur adipiscing elit ut aliquam. Dictum non consectetur a erat nam at lectus urna duis. Pretium fusce id velit ut tortor pretium viverra suspendisse potenti. Id faucibus nisl tincidunt eget. Accumsan tortor posuere ac ut consequat semper viverra nam libero. A condimentum vitae sapien pellentesque habitant. Mattis rhoncus urna neque viverra justo nec. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Neque convallis a cras semper auctor. Eget nunc scelerisque viverra mauris in. Mi tempus imperdiet nulla malesuada pellentesque elit eget gravida. Proin fermentum leo vel orci porta non pulvinar neque laoreet. Adipiscing commodo elit at imperdiet dui accumsan sit.
                    </p>
                    <br>
                    <p>Dolor purus non enim praesent elementum facilisis leo vel. Turpis nunc eget lorem dolor sed viverra ipsum nunc aliquet. A pellentesque sit amet porttitor eget dolor morbi. Convallis posuere morbi leo urna molestie at elementum. Adipiscing elit duis tristique sollicitudin. Sagittis aliquam malesuada bibendum arcu vitae elementum curabitur. Nunc mattis enim ut tellus elementum sagittis vitae. Eget nunc lobortis mattis aliquam faucibus purus. Elementum sagittis vitae et leo duis. Egestas pretium aenean pharetra magna ac. Eleifend donec pretium vulputate sapien nec sagittis. Fames ac turpis egestas integer eget aliquet nibh praesent.
                    </p>
                    <br>
                    <p>Integer vitae justo eget magna fermentum iaculis eu non diam. Etiam sit amet nisl purus in mollis nunc sed. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et. Turpis egestas maecenas pharetra convallis posuere morbi leo urna. Nisl nisi scelerisque eu ultrices vitae auctor eu augue ut. Diam maecenas sed enim ut sem viverra aliquet eget. Nec feugiat nisl pretium fusce id velit ut tortor. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Amet consectetur adipiscing elit ut aliquam purus sit. Enim diam vulputate ut pharetra sit amet aliquam id diam.
                    </p>
                    <br>
                    <p>Dolor purus non enim praesent elementum facilisis leo vel. Turpis nunc eget lorem dolor sed viverra ipsum nunc aliquet. A pellentesque sit amet porttitor eget dolor morbi. Convallis posuere morbi leo urna molestie at elementum. Adipiscing elit duis tristique sollicitudin. Sagittis aliquam malesuada bibendum arcu vitae elementum curabitur. Nunc mattis enim ut tellus elementum sagittis vitae. Eget nunc lobortis mattis aliquam faucibus purus. Elementum sagittis vitae et leo duis. Egestas pretium aenean pharetra magna ac. Eleifend donec pretium vulputate sapien nec sagittis. Fames ac turpis egestas integer eget aliquet nibh praesent.
                    </p>
                    <br>


                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="text-center">

                        <button type="button" class="btn btn-primary " @click="startSection"> Start Section </button>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>
<script>
  import Vue from 'vue';
  import {mapActions, mapGetters} from "vuex";
  export default {
    methods:{
      ...mapActions("StudentExam", [
        "setLastQuestion",
      ]),
      startSection(){
        this.setLastQuestion();
        this.$router.push({name: 'exam.reading.questions', params: {'id': 1}})
      }
    }
  }
</script>