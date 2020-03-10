<template>
    <div class="card" data-order-id="card-2">
                    <div class="card-header ui-sortable-handle">
                    <div class="pull-right cui-utils-sortable-control">
                        
                    </div>
                    <div class="cui-utils-title"><strong>Practice progress</strong></div>
                    <div class="cui-utils-title-description">
                        Practice is the key to success. Check your progress here!
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                        <strong>Full-length Practice Tests:</strong>
                        <!-- <p class="text-muted">Ipsum is simply dummy</p> -->
                        <div class="progress mb-3" style="height: 7px">                            
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :aria-valuenow="(package.tests_with_assesment - user.video_tutorials)" :aria-valuemin="0" :aria-valuemax="package.video_tutorials" :style="'width: '+ (user.tests_with_assesment) * 100 / package.tests_with_assesment+'%'"></div>
                        </div>
                        <strong>Tests at PTE Mock Test Centre:</strong>
                        <!-- <p class="text-muted">Ipsum is simply dummy</p> -->
                        <div class="progress mb-3" style="height: 7px">                            
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  :style="'width: '+ (user.mock_tests) * 100 / package.testcenter_mocktests+'%'"></div>
                        </div>
                        <strong>Video Tutorials:</strong>
                        <!-- <p class="text-muted">Typesetting industry</p> -->
                        <div class="progress mb-3" style="height: 7px">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :aria-valuenow="(package.video_tutorials - coursesAndChaptersSeenCount)" :aria-valuemin="0" :aria-valuemax="package.video_tutorials" :style="'width: '+ (coursesAndChaptersSeenCount) * 100 / package.video_tutorials+'%'"></div>
                            <!-- <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :aria-valuenow="2" :aria-valuemin="0" :aria-valuemax="package.video_tutorials" style="width:20%"></div> -->
                        </div>
                        
                        <strong>Practice Questions:</strong>
                        <!-- <p class="text-muted">Typesetting industry</p> -->
                        <div class="progress mb-3" style="height: 7px">                            
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :aria-valuenow="user.practice_questions" :aria-valuemin="0" :aria-valuemax="practiceQuestionsPracticedCount"  :style="'width: '+ (practiceQuestionsPracticedCount) * 100 / package.practice_questions+'%'"></div>
                        </div>
                        
                        <strong>Webinar Sessions:</strong>
                        <!-- <p class="text-muted">Typesetting industry</p> -->
                        <div class="progress mb-3" style="height: 7px">                            
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  :style="'width: '+ (user.webinar_sessions) * 100 / package.webinar_sessions+'%'"></div>
                        </div>                       
                        <!-- <strong>Coaching Sessions:</strong>
                        
                        <div class="progress mb-3" style="height: 7px">                            
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  :style="'width: '+ (package.coaching_session_daily - user.coaching_session_daily) * 100 / package.coaching_session_daily+'%'"></div>
                        </div>                         -->
                        <strong>PDF Resources:</strong>
                        <!-- <p class="text-muted">Printing and typesetting</p> -->
                        <div class="progress mb-3" style="height: 7px">                            
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  :style="'width: '+ (coursesAndChaptersDocumentsSeenCount) * 100 / coursesAndChaptersDocumentsCount+'%'"></div>
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
    props: ['package','user'],
    computed: {
        ...mapGetters('StudentPanel', ['coursesAndChaptersSeenCount','coursesAndChaptersCount',
                                    'coursesAndChaptersNotSeenCount','coursesAndChaptersDocumentsSeenCount',
                                    'coursesAndChaptersDocumentsNotSeenCount','coursesAndChaptersDocumentsCount',
                                    'practiceQuestionsCount','practiceQuestionsPendingCount','practiceQuestionsPracticedCount'
                                    ])
    }
}
</script>
