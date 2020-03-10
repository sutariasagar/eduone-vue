<template>

    <div>
        <!-- <div class="row">
            <div class="col-lg-12">
                <resources v-if="item.package" :package="item.package"></resources>
            </div>
            <div class="col-lg-6">
                <div class="cui-utils-sortable ui-sortable" id="left-col">
                    <practice-progress v-if="item.package" :user='item' :package='item.package'></practice-progress>
                    <growth-chart :exams_with_results='item.exams_with_results'></growth-chart>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="cui-utils-sortable ui-sortable" id="right-col">
                    <exam-results :exams='item.test_center_exams' :studentid='item.id' v-if="item.test_center_exams && item.test_center_exams.length > 0" :heading="'Tests at PTE Mock Test Centre'"></exam-results>
                    <exam-results :exams='item.practice_exams' :studentid='item.id' v-if="item.practice_exams && item.practice_exams.length > 0" :heading="'Online Practice Tests'"></exam-results>
                    <exam-performance :exams_with_results='item.exams_with_results'></exam-performance>
                </div>
            </div>
        </div>                 -->
    <!-- END: dashboard alpha -->
    <!-- <div class="shadow-sm p-4 bg-white rounded mt-4 mb-4 text-uppercase text-center w-100">
				<b>Welcome to Pte Topper >></b> <span class="font-weight-lighter">Your current plan is "Practice Pack"</span>
			</div> -->
			<div class="cstcard shadow-sm">
                <resources v-if="item.package" :package="item.package"></resources>
			</div>
			<!-- <div class="row ">
				<div class="col-md-6 mt-4">
					<div class="card shadow-sm">
					  	<h6 class="card-header text-uppercase bg-white font-weight-bold">How to use pte topper?</h6>
				  		<div class="card-body">
				  			<div class="cstslides">
				  				<div class="slidercn position-relative">
				  					<img src="/images/slide.png" class="mw-100 rounded-lg">
				  					<img src="/images/player.png" class="cstplayer position-absolute">				  					
				  				</div>
				  				<div class="cstcontent">
				  					<div class="row pt-4">
					  					<div class="col-md-4 text-center pb-4">
					  						<img src="/images/useravatar.png" class="sideuser rounded-circle">
					  						<div>Akash Mehta</div>
					  						<div class="cst888">@Akash_m</div>
					  					</div>
					  					<div class="col-md-8">
					  						<h5>How to start practice test? 5 mins</h5>
					  						<p class="font14 cst888">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					  						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					  						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					  						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					  						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					  						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					  					</div>
				  					</div>
				  				</div>
				  			</div>
				  		</div>
					</div>
				</div>
				<div class="col-md-6 mt-4">
					<div class="card shadow-sm">
					  	<h6 class="card-header text-uppercase bg-white font-weight-bold">Your study calendar</h6>
				  		<div class="card-body">
                              <student-calendar></student-calendar>
				  		</div>
					</div>
				</div>
			</div> -->
			<div class="row">
				<div class="col-md-6 mt-4">
					<div class="card shadow-sm">
				  		<div class="card-body">
				  			<practice-progress v-if="item.package" :user='item' :package='item.package'></practice-progress>
				  		</div>
					</div>
				</div>
				<div class="col-md-6 mt-4">
					<div class="card shadow-sm">
				  		<div class="card-body">
				  			<!-- <h6 class="text-uppercase">Exam Performence</h6> -->
                            <growth-chart :exams_with_results='item.exams_with_results'></growth-chart>
				  		</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mt-4">
					<exam-performance :exams_with_results='item.exams_with_results'></exam-performance>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mt-4">
                    <exam-results :exams='item.test_center_exams' :studentid='item.id' :heading="'Tests at PTE Mock Test Centre'"></exam-results>
				</div>
				<div class="col-md-6 mt-4">
                    <exam-results :exams='item.practice_exams' :studentid='item.id' :heading="'Online Practice Tests'"></exam-results>
				</div>
			</div>
			
			<!-- <div class="row">
				<div class="col-md-6 mt-4 cstchat">
					<div class="card shadow-sm">
				  		<div class="card-body">
				  			<h6 class="text-uppercase">Chat</h6>
				  			<p class="chatsub">Block with important chat information</p>
				  			<div class="inbox_msg mb-4">
                        		<div class="msg_history px-2">
					  				<div class="incoming_msg">
	                                    <div class="incoming_msg_img"> <img src="/images/user.png" alt="User Name"></div>
	                                    <div class="received_msg">
	                                        <div class="received_withd_msg">
	                                            <div class="cbox">
	                                                <p class="uname">User Name</p>
	                                                <p>Comments Comments Comments</p>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="outgoing_msg">
	                                    <div class="sent_msg">
	                                        <div class="cbox">
	                                            <p class="uname">User Name</p>
	                                            <p>Comments Comments Comments</p>
	                                        </div>
	                                    </div>
	                                    <div class="outgoing_msg_img"> <img src="/images/user.png" alt="User Name"></div>
	                                </div>
	                                <div class="outgoing_msg">
	                                    <div class="sent_msg">
	                                        <div class="cbox">
	                                            <p class="uname">User Name</p>
	                                            <p>Comments Comments Comments</p>
	                                        </div>
	                                    </div>
	                                    <div class="outgoing_msg_img"> <img src="/images/user.png" alt="User Name"></div>
	                                </div>
	                                <div class="incoming_msg">
	                                    <div class="incoming_msg_img"> <img src="/images/user.png" alt="User Name"></div>
	                                    <div class="received_msg">
	                                        <div class="received_withd_msg">
	                                            <div class="cbox">
	                                                <p class="uname">User Name</p>
	                                                <p>Comments Comments Comments</p>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
				  			</div>
				  			<div class="postcomment">
				  				<textarea class="form-control" rows="2" placeholder="Type a message..."></textarea>
				  				<div class="mt-3">
				  					<button class="btn bg-theme text-white cstbtnradius px-5 mr-3"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Send</button>
					  				<label class="custom-file-upload">
									    <input type="file"/>Attach File
									</label>
				  				</div>
				  			</div>
				  		</div>
					</div>
				</div>
				<div class="col-md-6 mt-4">
					<div class="card shadow-sm">
						<h6 class="card-header text-uppercase bg-white font-weight-bold">Your Feedback</h6>
				  		<div class="card-body">
				  		</div>
					</div>
				</div>
			</div> -->
			<!-- <div class="cstplan shadow-sm">
				<div class="p-4 bg-white">
					<div class="cstupgrade p-4 plr15">
						<div class="row">
							<div class="col-md-4">
								<h4 class="text-uppercase fg-theme font-weight-bolder">Need to improve results?</h4>
								<h4 class="text-uppercase fg-theme font-weight-bolder">Upgrade to online</h4>
								<h4 class="text-uppercase fg-theme font-weight-bolder">Personalized Class</h4>
								<h5 class="mt-4">Dedicated PTE Expert</h5>
								<h5>10 Hours of Online Personalized Coaching</h5>
								<button class="btn btn-lg btn-theme text-uppercase mt-4 fw-500 cstbtnradius">See Details</button>
							</div>
							<div class="col-md-4">
								<div class="w-100 h-100 text-center">
									<img src="/images/hat.png" class="csthatimg" alt="">
								</div>
							</div>
							<div class="col-md-4">
								<h4 class="text-uppercase fg-theme font-weight-bolder">Upgrade Now @10% Special Discount</h4>
								<h5 class="mt-4 font-weight-bolder">Plus member access to:</h5>
								<ul class="cstplanul list-unstyled p-0">
									<li>5 Scored Test</li>
									<li>40 Video Tutorials</li>
									<li>2000+ Practice Questions</li>
								</ul>
								<button class="btn btn-lg btn-theme text-uppercase mt-4 fw-500 cstbtnradius">Upgrade Now</button>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<div class="cstblog mt-4 shadow-sm">
				<div class="p-4 bg-white">
					<div class="py-4 px-5 cstblogback plr15">
						<div class="row">
							<div class="col-md-4">
								<div class="p-5">
									<img src="/images/books.png" class="mw-100">
								</div>
							</div>
							<div class="col-md-8 text-center">
								<h2 class="text-uppercase text-white font-weight-bolder">Blog</h2>
								<p class="cstparag plr15">In our bid to help you stay updated with all the latest PTE developments and enhance your PTE Academic score, our experts are always looking to share vital information, tips and strategies with you. Never miss out on reading the latest blog posts!</p>
								<a href="https://www.ptetopper.com/blog" target="_blank" class="btn btn-lg fg-blog text-uppercase bg-white mt-5 cstbtnradius px-5 py-3 plr15"><i class="fa fa-shopping-bag"></i>&nbsp;&nbsp;See All Blogs</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="mt-4 shadow-sm">
				<div class="p-4 bg-white">
					<div class="py-4 px-5 plr15">
						<div class="cstline mb-5">
							<div class="dots">
								<div class="dot"></div>
								<div class="dot"></div>
								<div class="dot"></div>
							</div>
						</div>
						<h1 class="text-uppercase text-center fg-theme font-weight-bolder my-4 newsletter">NewsLetter</h1>
						<div class="row">
							<div class="col-md-6 px-5 plr15">
								<img src="/images/mailbird.png" class="mw-100">
							</div>
							<div class="col-md-6 px-5 plr15">
								<h3 class="cst888 my-3">Receive expert tips, strategies and offers regularly in your mail box!</h3>
								<div class="cstinputgroup my-4 position-relative">
									<input type="text" class="form-control form-control-lg cstbtnradius" placeholder="Your email">
									<i class="csticon fa fa-envelope"></i>
								</div>
								<button class="btn btn-lg bg-theme text-white text-uppercase cstbtnradius px-5 py-3 my-3">Subscribe</button>
							</div>
						</div>
					</div>
				</div>
			</div> -->
    </div>

</template>
<script>
    import { mapGetters, mapActions } from 'vuex'
    import profileImage from '../../utils/User/ProfileImage.vue'
    import examResults from '../../utils/User/ExamResults.vue'
    import resources from '../../utils/User/Resources.vue'
    import practiceProgress from '../../utils/User/PracticeProgress.vue'
    import growthChart from '../../student/GrowthChart.vue'
    import examPerformance from '../../student/ExamPerformance.vue'
    import studentCalendar from '../../student/Calendar.vue'
    export default {
        data() {
            return {
                // Code...
            }
        },
        components:{
            profileImage,
            examResults,
            resources,
            practiceProgress,
            growthChart,
            examPerformance,
            studentCalendar
        },
        created() {
            this.fetchData()
        },
        computed: {
            ...mapGetters('Profile', ['item','loading']),
        },
        methods: {
        ...mapActions('Profile', ['fetchData']),
    }
    }
</script>


<style scoped>

</style>
