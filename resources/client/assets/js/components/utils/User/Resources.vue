<template>
    <!-- <div class="card" data-order-id="card-7">
        <div class="card-header ui-sortable-handle">
            <div class="pull-right cui-utils-sortable-control">
                
            </div>
            <div class="cui-utils-title"><strong>Practice Tools</strong></div>            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-12">                    
                    
                        <div class="bg-primary p-4 text-white mb-3" >
                        
                            <div class="row">
                                <div class="col-md-5 mt-4 text-center p-0">
                                    
                                    <i class="icmn-film font-size-36"></i>
                                    <h5 class=" mb-3">Videos</h5>
                                    
                                </div>
                                <div class="col-md-7 text-center" v-if="coursesAndChaptersCount">
                                    <router-link :to="{ name: 'student.videos'}">
                                    <p class="font-size-36 mb-0">{{ coursesAndChaptersCount }} <span class="font-size-18">Total</span> </p>
                                    </router-link>
                                    <div class="clearfix"></div>
                                    
                                    <div class="row pr-3">
                                        
                                        <div class="col-md-6 p-0 border-top border-right">
                                            <router-link :to="{ name: 'student.videos.notseen'}">
                                            <h4 class="text-uppercase mt-2 mb-0">{{ coursesAndChaptersNotSeenCount }}</h4>
                                            <span>Pending</span>
                                            </router-link>
                                        </div>
                                        
                                        <div class="col-md-6 p-0 border-top">
                                            <router-link :to="{ name: 'student.videos.seen'}">
                                            <h4 class="text-uppercase mt-2 mb-0">{{ coursesAndChaptersSeenCount }}</h4>
                                            <span>Viewed</span>
                                            </router-link>
                                        </div>                        
                                    </div>      
                                </div>
                            </div>                            
                        </div>                                        
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-12">                    
                   
                        <div class="bg-danger p-4 text-white mb-3" >
                        
                            <div class="row">
                                <div class="col-md-5 mt-4 text-center p-0">
                                    
                                    <i class="icmn-books font-size-36"></i>
                                    <h5 class=" mb-3">PDF Resources</h5>
                                    
                                </div>
                                <div class="col-md-7 text-center">
                                    <router-link :to="{ name: 'student.documents'}">
                                    <p class="font-size-36 mb-0">{{ coursesAndChaptersDocumentsCount }} <span class="font-size-18">Total</span> </p>
                                    </router-link>
                                    <div class="clearfix"></div>
                                    
                                    <div class="row pr-3">
                                        <div class="col-md-6 p-0 border-top border-right">
                                            <router-link :to="{ name: 'student.documents.notseen'}">
                                            <h4 class="text-uppercase mt-2 mb-0">{{coursesAndChaptersDocumentsNotSeenCount}}</h4>
                                            <span>Pending</span>
                                            </router-link>
                                        </div>
                                        <div class="col-md-6 p-0 border-top">
                                            <router-link :to="{ name: 'student.documents.seen'}">
                                            <h4 class="text-uppercase mt-2 mb-0">{{coursesAndChaptersDocumentsSeenCount}}</h4>
                                            <span>Studied</span>
                                            </router-link>
                                        </div>                        
                                    </div>      
                                </div>
                            </div>                            
                        </div>
                                        
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-12">                    
                    <router-link :to="{ name: 'headphones'}">
                        <div class="bg-success p-4 text-white mb-3">
                            <div class="row">
                                <div class="col-md-5 mt-4 text-center p-0">
                                    
                                    <i class="icmn-file-text font-size-36"></i>
                                    <h5 class=" mb-3">Mock Tests</h5>
                                    
                                </div>
                                <div class="col-md-7 text-center">
                                    <p class="font-size-36 mb-0"> {{package.tests_with_assessment}}  <span class="font-size-18">Total</span> </p>
                                    <div class="clearfix"></div>
                                    
                                    <div class="row pr-3">
                                        <div class="col-md-6 p-0 border-top border-right">
                                            <h4 class="text-uppercase mt-2 mb-0">0</h4>
                                            <span>Pending</span>
                                        </div>
                                        <div class="col-md-6 p-0 border-top">
                                            <h4 class="text-uppercase mt-2 mb-0">1</h4>
                                            <span>Appeared</span>
                                        </div>                        
                                    </div>      
                                </div>
                            </div>                            
                        </div>
                    </router-link>                    
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-12">                    
                    
                        <div class="bg-warning p-4 text-white mb-3">
                            <div class="row">
                                <div class="col-md-5 mt-4 text-center p-0 ">
                                    
                                    <i class="icmn-book font-size-36"></i>
                                    <h5 class=" mb-3">Practice Questions</h5>
                                    
                                </div>
                                <div class="col-md-7 text-center">
                                     <router-link :to="{ name: 'student.practicequestions'}">
                                        <p class="font-size-36 mb-0">{{ practiceQuestionsCount }} <span class="font-size-18">Total</span> </p>
                                    </router-link>                                    
                                    <div class="clearfix"></div>
                                    
                                    <div class="row pr-3">
                                        <div class="col-md-6 p-0 border-top border-right">
                                            <router-link :to="{ name: 'student.practicequestions'}">
                                            <h4 class="text-uppercase mt-2 mb-0">{{practiceQuestionsPendingCount}}</h4>
                                            <span>Pending</span>
                                            </router-link>
                                        </div>
                                        <div class="col-md-6 p-0 border-top">
                                            <router-link :to="{ name: 'student.practicequestions.seen'}">
                                            <h4 class="text-uppercase mt-2 mb-0">{{practiceQuestionsPracticedCount}}</h4>
                                            <span>Practiced</span>
                                            </router-link>
                                        </div>                        
                                    </div>      
                                </div>
                            </div>                            
                        </div>                                        
                </div>                                         
            </div>
            <div class="cui-utils-margin-fix">                
            </div>
        </div>
    </div> -->
    <div class="card">
				  	<h6 class="card-header text-uppercase bg-white font-weight-bold">Practice Tool</h6>
			  		<div class="card-body">
			  			<div class="row cstmax75">
				    		<div class="col-md-3 text-center py-4">
                               
				    			<div class="tools toolsvideo">
				    				<img src="/images/video.png" alt="Videos">
				    			</div>
			    				<div class="cstcount">
			    				 <router-link :to="{ name: 'student.videos'}" tag="h1">	{{ coursesAndChaptersCount }} </router-link> 
			    					<div>Videos</div>
                                    <router-link :to="{ name: 'student.videos.seen'}">
			    					<div class="toolsvideo cstview mt-4 p-2 pr-3 pl-3">{{coursesAndChaptersSeenCount}} Viewed</div>
                                    </router-link>
                                    <router-link :to="{ name: 'student.videos.notseen'}">
			    					<div class="cstview cstpend mt-3 p-2 pr-3 pl-3">{{coursesAndChaptersNotSeenCount}} Pending</div>
                                    </router-link>
			    				</div>
				    		</div>
				    		<div class="col-md-3 text-center py-4">
                            <router-link :to="{ name: 'student.documents'}">
				    			<div class="tools toolspdf">
				    				<img src="/images/pdf.png" alt="PDF Resources">
				    			</div>
                            </router-link>
				    			<div class="cstcount">
			    					<router-link :to="{ name: 'student.documents'}" tag="h1"> {{coursesAndChaptersDocumentsCount}} </router-link>
			    					<div>PDF Resources</div>
                                    <router-link :to="{ name: 'student.documents.seen'}">
			    					<div class="toolspdf cstview mt-4 p-2 pr-3 pl-3">{{coursesAndChaptersDocumentsSeenCount}} Studied</div>
                                    </router-link>
                                    <router-link :to="{ name: 'student.documents.notseen'}">
			    					<div class="cstview cstpend mt-3 p-2 pr-3 pl-3">{{coursesAndChaptersDocumentsNotSeenCount}} Pending</div>
                                    </router-link>
			    				</div>
				    		</div>
				    		<div class="col-md-3 text-center py-4">
				    			<div class="tools toolsmock">
				    				<img src="/images/mock.png" alt="Mock Test">
				    			</div>
				    			<div class="cstcount">
			    					<router-link :to="{ name: 'studentexam.home'}" tag="h1"> {{ package.tests_with_assessment }} </router-link>
			    					<div>Mock Tests</div>
			    					<div class="toolsmock cstview mt-4 p-2 pr-3 pl-3">1 Appeared</div>
			    					<div class="cstview cstpend mt-3 p-2 pr-3 pl-3">1 Pending</div>
			    				</div>
				    		</div>
				    		<div class="col-md-3 text-center py-4">
                                <router-link :to="{ name: 'student.practicequestions'}">
				    			<div class="tools toolsnote">
				    				<img src="/images/notes.png" alt="Practice Questions">
				    			</div>
                                </router-link>
				    			<div class="cstcount">			    					
                                    <router-link :to="{ name: 'student.practicequestions'}" tag="h1"> {{ practiceQuestionsCount }} </router-link>
			    					<div>Practice Questions</div>
                                    <router-link :to="{ name: 'student.practicequestions.seen'}">
			    					<div class="toolsnote cstview mt-4 p-2 pr-3 pl-3">{{practiceQuestionsPracticedCount}} Practiced</div>
                                    </router-link>
                                     <router-link :to="{ name: 'student.practicequestions'}">
			    					<div class="cstview cstpend mt-3 p-2 pr-3 pl-3">{{practiceQuestionsPendingCount}} Pending</div>
                                     </router-link>
			    				</div>
				    		</div>
				    	</div>
			  		</div>
				</div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
    data() {
        return {
            // Code...
            
        }
    },
    props: ['package'],
    mounted(){
        this.fetchCoursesAndChaptersCount();
        this.fetchCoursesAndChaptersSeenCount();
        this.fetchCoursesAndChaptersNotSeenCount();
        this.fetchCoursesAndChaptersDocumentsNotSeenCount();
        this.fetchCoursesAndChaptersDocumentsSeenCount();
        this.fetchCoursesAndChaptersDocumentsCount();
        this.fetchPracticeQuestionsCount();
        this.fetchPracticeQuestionsPendingCount();
        this.fetchPracticeQuestionsPracticedCount();
    },
    computed: {
        ...mapGetters('StudentPanel', ['coursesAndChaptersSeenCount','coursesAndChaptersCount',
                                    'coursesAndChaptersNotSeenCount','coursesAndChaptersDocumentsSeenCount',
                                    'coursesAndChaptersDocumentsNotSeenCount','coursesAndChaptersDocumentsCount',
                                    'practiceQuestionsCount','practiceQuestionsPendingCount','practiceQuestionsPracticedCount'
                                    ])
    }, 
    methods: {
        ...mapActions('StudentPanel', ['fetchCoursesAndChaptersSeenCount','fetchCoursesAndChaptersCount','fetchCoursesAndChaptersNotSeenCount',
                            'fetchCoursesAndChaptersDocumentsNotSeenCount','fetchCoursesAndChaptersDocumentsSeenCount','fetchCoursesAndChaptersDocumentsCount',
                            'fetchPracticeQuestionsCount','fetchPracticeQuestionsPendingCount','fetchPracticeQuestionsPracticedCount'
                            ]),
    }   
}
</script>
<style  scoped>
a{
    color:white !important;
}
h1{
    cursor: pointer !important;
}
</style>

