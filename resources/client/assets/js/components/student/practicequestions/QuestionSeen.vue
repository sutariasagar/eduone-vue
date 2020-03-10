<template>
    <div class="">

        <div class="row">
            <div v-bind:class="{'col-md-12':!showSummary,'col-md-9':showSummary}">
                <div class="card">
                    <div class="card-header">
                        <span class="cui-utils-title">
                            <strong> View Practice Questions</strong>
                            <!--<a href="https://datatables.net/" target="_blank" class="btn btn-sm btn-primary ml-2">Official Documentation <i class="icmn-link ml-1">&lt;!&ndash; &ndash;&gt;</i></a>-->
                        </span>
                    </div>

                    <div class="card-body ">
                        <div class="row card-with-shadow pt-3 custom-shadow">

                            <div class="w-100">
                                <div class="mb-5">
                                    <custom-collapse-heading :heading="question.title" to='basic'></custom-collapse-heading>
                                    <custom-collapse-body uniqueId="basic">
                                       <div class="box">
                                            <div class="box-body">
                                                <div v-if="question && question.section_type.value == 'speaking'">
                                                    <div class="border container-fluid min-vh-79" v-if="question">
                                                    <div class="row" v-if="question.header">
                                                        <div class="col-md-12">
                                                            <p class="question-header" v-html="question.header"></p>
                                                        </div>
                                                    </div>
                                                    <!-- This is for Image -->
                                                    <div
                                                            class="row mt-2 mb-5"
                                                            v-if="question.question_details && question.question_details.image_upload"
                                                    >
                                                        <div class="col-md-6">
                                                            <img id="imagequestion" width="600px" height="450px" :src="$MAIN_APP_EXAM_URL+question.question_details.image_upload.data.file_link_url[0]">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div
                                                                    class="row mt-5"
                                                                    v-if="question.question_details && question.question_details.audio_upload"
                                                            >
                                                                <div
                                                                        class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                                                                >
                                                                    <div class="col-md-8 border p-2">
                                                                        <div class>
                                                                            <p v-if="playerSeconds > 0">Status: Beginning in {{playerSeconds}} seconds</p>
                                                                            <p v-else-if="playerSeconds == 0 && !startRecordingCountDown">Status: Playing</p>
                                                                            <p v-else> Status: Completed</p>
                                                                            <audio-player
                                                                                    :start="startPlaying"
                                                                                    @playingComplete="onPlayingComplete"
                                                                                    :src="verifyURL($MAIN_APP_EXAM_URL+question.question_details.audio_upload.data.file_link_url[0])"                                                
                                                                            ></audio-player>
                                                                            <div>
                                                                                <b-progress :value="playerSeconds" :max="question.preparation_time" class="mb-3"></b-progress>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row mt-5" v-if="question.preparation_time && question.preparation_time > 0">
                                                                <div
                                                                        class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                                                                >
                                                                    <div class="custom-blue-background col-md-8 border-blue p-2">
                                                                        <div class>
                                                                            <h5 class="text-center">Recorded Answer</h5>
                                                                            <p>Current Status</p>
                                                                            <div v-if="question.question_details && question.question_details.audio_upload">
                                                                            <p v-if="!startRecording"> Playing</p>
                                                                            <p v-else-if="seconds > 0">Beginning in {{seconds}} seconds</p>
                                                                            <p v-else>Recording</p>
                                                                            </div>
                                                                            <div v-else>                                          
                                                                            <p v-if="seconds > 0">Beginning in {{seconds}} seconds</p>
                                                                            <p v-else>Recording</p>
                                                                            </div>
                                                                            
                                                                            
                                                                            <div>
                                                                                <b-progress v-if="seconds > 0"
                                                                                            :value="seconds"
                                                                                            :max="question.preparation_time"
                                                                                            class="mb-3"
                                                                                ></b-progress>
                                                                                <b-progress v-else
                                                                                            :value="recordingSeconds"
                                                                                            :max="question.attempt_time"
                                                                                            class="mb-3"
                                                                                ></b-progress>
                                                                                <audio-record
                                                                                        :start="startRecording"
                                                                                        :stop="stopRecording"
                                                                                        :questionID="question.id"
                                                                                        :timeLimit="parseFloat((question.attempt_time/60).toFixed(2))"
                                                                                        :uploadUrl="'/api/v1/practiceanswers'"
                                                                                        @recordingComplete="onRecordingComplete"
                                                                                ></audio-record>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                    class="row mt-5"
                                                                    v-if="question.question_details && question.question_details.html_text"
                                                            >
                                                                <div
                                                                        class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                                                                >
                                                                    <div class="col-md-8 p-2">
                                                                        <div class="text-justify">
                                                                            <p v-html="question.question_details.html_text"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <!-- this is for audio -->

                                                    <div v-else>
                                                        <div
                                                                class="row mt-5 check"
                                                                v-if="question.question_details && question.question_details.audio_upload"
                                                        >
                                                            <div
                                                                    class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                                                            >
                                                                <div class="col-md-4 border p-2">
                                                                    <div class>
                                                                        <p v-if="playerSeconds > 0">Status: Beginning in {{playerSeconds}} seconds</p>
                                                                        <p v-else-if="playerSeconds == 0 && !startRecordingCountDown">Status: Playing</p>
                                                                        <p v-else> Status: Completed</p>
                                                                        <audio-player
                                                                                :start="startPlaying"
                                                                                @playingComplete="onPlayingComplete"
                                                                                :src="verifyURL($MAIN_APP_EXAM_URL+question.question_details.audio_upload.data.file_link_url[0])"                                                                                            
                                                                        ></audio-player>
                                                                        <div>
                                                                            <b-progress  :value="playerSeconds" :max="question.preparation_time" class="mb-3"></b-progress>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-5">
                                                            <div
                                                                    class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                                                            >
                                                                <div class="custom-blue-background col-md-4 border-blue p-2">
                                                                    <div class>
                                                                        <h5 class="text-center">Recorded Answer</h5>
                                                                        <p>Current Status</p>
                                                                        <p v-if="!startRecordingCountDown && playerSeconds == 0"> Playing</p>
                                                                        <p v-else-if="seconds > 0">Beginning in {{seconds}} seconds</p>
                                                                        <p v-else>Recording</p>
                                                                        <div>
                                                                            <b-progress v-if="seconds > 0"
                                                                                        :value="seconds"
                                                                                        :max="question.preparation_time"
                                                                                        class="mb-3"
                                                                            ></b-progress>
                                                                            <b-progress v-else
                                                                                        :value="recordingSeconds"
                                                                                        :max="question.attempt_time"
                                                                                        class="mb-3"
                                                                            ></b-progress>
                                                                            <audio-record
                                                                                    :start="startRecording"
                                                                                    :stop="stopRecording"
                                                                                    :questionID="question.id"
                                                                                    :timeLimit="parseFloat((question.attempt_time/60).toFixed(2))"
                                                                                    :uploadUrl="'/api/v1/practiceanswers'"
                                                                                    @recordingComplete="onRecordingComplete"
                                                                            ></audio-record>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                                class="row mt-5"
                                                                v-if="question.question_details && question.question_details.html_text"
                                                        >
                                                            <div
                                                                    class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                                                            >
                                                                <div class="col-md-6 p-2">
                                                                    <div class="text-justify">
                                                                        <p v-html="question.question_details.html_text"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                </div>
                                                <div v-if="question && question.section_type.value == 'listening_rol'">
                                                    <div class="border container-fluid min-vh-79" v-if="question">                                                        
                                                        <div class="row p-2" v-if="question.header">
                                                            <div class="col-md-12">
                                                                <p class="question-header" v-html="question.header"></p>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3 mb-5" v-if="question.question_details && question.question_details.audio_upload">
                                                            <div class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12">
                                                                <div class="col-md-4 border p-2">
                                                                    <div class>
                                                                        <p v-if="playerSeconds > 0">Status: Beginning in {{playerSeconds}} seconds</p>
                                                                        <p v-else-if="!playingComplete">Status: Playing</p>
                                                                        <p v-else>Status: Completed</p>

                                                                        <audio-player
                                                                                :start="startPlaying"
                                                                                @playingComplete="onPlayingComplete"
                                                                                :src="verifyURL($MAIN_APP_EXAM_URL+question.question_details.audio_upload.data.file_link_url[0])"                                                
                                                                        ></audio-player>
                                                                        <div>
                                                                            <b-progress :value="playerSeconds" :max="5" class="mb-3"></b-progress>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mt-3 highlightdiv" v-if="question.answer_details.select_text">
                                                                <div class="p-2 text-justify">
                                                                    <span   @click="highLightWord"  v-bind:key="index" v-for="(data, index) in (question.question_details.html_text.replace(/(<p[^>]+?>|<p>|<\/p>)/img, '').replace(/\&nbsp;/g, ' ').split(' '))">
                                                                        {{data}}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div v-if="question.answer_details && question.answer_details.html_text == ''">
                                                            <div class="row mt-5 mb-2 checking">
                                                                <div class="col-md-12">
                                                                    <div class="p-2">
                                                                        <div class="">
                                                                            <textarea
                                                                                    class="w-100 h-100 text-area"
                                                                                    rows="10"
                                                                                    @input="updateAnswer"
                                                                                    @keydown="getCursorPosition"
                                                                                    @click="getCursorPosition"
                                                                                    @focus="getCursorPosition"
                                                                                    v-model="answer"
                                                                                    spellcheck="false"
                                                                            ></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2 mb-2 ml-0 mr-0">
                                                                <div class="col-md-4 text-left">
                                                                    <button @click="copyText" class="ccp-button">Copy</button>
                                                                </div>
                                                                <div class="col-md-4 text-center">
                                                                    <button @click="cutText" class="ccp-button">Cut</button>
                                                                </div>
                                                                <div class="col-md-4 text-right">
                                                                    <button @click="pasteText" class="ccp-button">Paste</button>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="p-2">Total Word Count: {{ wordcount }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2 mb-5" v-if="question.question_details && question.question_details.mcq_multiple_option ">
                                                            <div class="col-md-12" v-if="question.question_details.html_text">
                                                                <div class="p-2">
                                                                    <div class>
                                                                        <p v-html="question.question_details.html_text"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="">
                                                                    <div class="p-2">
                                                                        <div class="">
                                                                            <div
                                                                                    class="checkbox" v-bind:key="index"
                                                                                    v-for="(suggestion, index) in question.question_details.mcq_multiple_option.suggestions"
                                                                            >
                                                                                <label>
                                                                                    <input
                                                                                            v-model="checkedNames"
                                                                                            @change="updateMulAnswer"
                                                                                            class="mr-3"
                                                                                            type="checkbox"
                                                                                            :value="suggestion.text"
                                                                                    >
                                                                                    {{ suggestion.text }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2 mb-5" v-if="question.question_details && question.question_details.mcq_single_option ">
                                                            <div class="col-md-12" v-if="question.question_details.html_text">
                                                                <div class="p-2">
                                                                    <div class>
                                                                        <p v-html="question.question_details.html_text"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="">
                                                                    <div class="p-2">
                                                                        <div class="">
                                                                            <div class="checkbox" v-bind:key="index" v-for="(suggestion, index) in question.question_details.mcq_single_option.suggestions">
                                                                                <label>
                                                                                    <input
                                                                                            v-model="radioSuggestion"
                                                                                            @input="updateMulAnswer"
                                                                                            class="mr-3"
                                                                                            type="radio"
                                                                                            :value="suggestion.text"
                                                                                    >
                                                                                    {{ suggestion.text }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 mb-5 col-md-12 custom-height" v-if="question.answer_details && question.answer_details.fib_no_options">

                                                            <div class="row p-4" v-if="question.question_details.html_text">
                                                                <div class="col-md-12">

                                                                    <template v-for="(data, index) in (question.question_details.html_text.replace(/(<p[^>]+?>|<p>|<\/p>)/img, '').replace(/\&nbsp;/g, ' ').split(' '))">

                                                                        <template v-if="data.includes('#b')">
                                                                            <custom-text-input v-bind:key="index" :id="data" v-on:change="updateFIBAnswer" autocomplete="off">                                
                                                                            </custom-text-input>
                                                                            &nbsp;
                                                                        </template>
                                                                        <template v-else>
                                                                            <span v-bind:key="index" v-html="data"> </span>
                                                                            &nbsp;
                                                                        </template>
                                                                    </template>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div v-if="question.answer_details.select_text">

                                                        </div>                                                        
                                                    </div>
                                                </div>

                                                <div v-if="question && question.section_type.value == 'listening_sst'">
                                                    <div class="border container-fluid min-vh-79" v-if="question">                                                        
                                                        <div class="row p-1" v-if="question.header">
                                                            <div class="col-md-11">
                                                                <p class="question-header" v-html="question.header"></p>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <p class="question-header float-right mr-2"> {{ time }}</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div
                                                            class="row mt-5 mb-5"
                                                            v-if="question.question_details && question.question_details.audio_upload"
                                                        >
                                                            <div
                                                                class="d-flex align-items-center flex-column justify-content-center h-100 col-md-12"
                                                            >
                                                                <div class="col-md-4 border p-2">
                                                                    <div class>
                                                                        <p v-if="playerSeconds > 0">Status: Beginning in {{playerSeconds}} seconds</p>
                                                                        <p v-else-if="playingCompleted">
                                                                            Status: Playing Completed
                                                                        </p>
                                                                        <p v-else>Status: Playing</p>
                                                                        <audio-player
                                                                                :start="startPlaying"
                                                                                @playingComplete="onPlayingComplete"
                                                                                :src="verifyURL($MAIN_APP_EXAM_URL+question.question_details.audio_upload.data.file_link_url[0])"                            
                                                                        ></audio-player>
                                                                        <div>
                                                                            <b-progress :value="playerSeconds" :max="5" class="mb-3"></b-progress>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" v-if="question.question_details.html_text">
                                                                <div class="p-2">
                                                                    <div class>
                                                                        <p v-html="question.question_details.html_text" id="selectedText" @click="getSelectionText"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- <div v-if="question.question_details && question.question_details.audio_upload">
                                                            <div class="row mt-5 mb-2">
                                                                <div class="col-md-12">
                                                                    <div class="p-2">
                                                                        <div class="">
                                                                            <textarea
                                                                                    class="w-100 h-100 text-area"
                                                                                    rows="10"
                                                                                    @input="updateAnswer"
                                                                                    @keydown="getCursorPosition"
                                                                                    @click="getCursorPosition"
                                                                                    @focus="getCursorPosition"
                                                                                    v-model="answer"
                                                                                    spellcheck="false"
                                                                            ></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2 mb-2 ml-0 mr-0">
                                                                <div class="col-md-4 text-left">
                                                                    <button @click="copyText" class="ccp-button">Copy</button>
                                                                </div>
                                                                <div class="col-md-4 text-center">
                                                                    <button @click="cutText" class="ccp-button">Cut</button>
                                                                </div>
                                                                <div class="col-md-4 text-right">
                                                                    <button @click="pasteText" class="ccp-button">Paste</button>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="p-2">Total Word Count: {{ wordcount }}</div>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <div v-if="(question.answer_details && question.answer_details.html_text == '') || (question.question_details && question.question_details.audio_upload)">
                                                            <div class="row mt-5 mb-2">
                                                                <div class="col-md-12">
                                                                    <div class="p-2">
                                                                        <div class="">
                                                                            <textarea
                                                                                class="w-100 h-100 text-area"
                                                                                rows="10"
                                                                                @input="updateAnswer"
                                                                                @keydown="getCursorPosition"
                                                                                @click="getCursorPosition"
                                                                                @focus="getCursorPosition"
                                                                                v-model="answer"
                                                                                spellcheck="false"
                                                                            ></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2 mb-2 ml-0 mr-0">
                                                                <div class="col-md-4 text-left">
                                                                    <button @click="copyText" class="ccp-button">Copy</button>
                                                                </div>
                                                                <div class="col-md-4 text-center">
                                                                    <button @click="cutText" class="ccp-button">Cut</button>
                                                                </div>
                                                                <div class="col-md-4 text-right">
                                                                    <button @click="pasteText" class="ccp-button">Paste</button>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="p-2">Total Word Count: {{ wordcount }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="row mt-2 mb-5"
                                                            v-if="question.question_details && question.question_details.mcq_multiple_option "
                                                        >
                                                            <div class="col-md-12" v-if="question.question_details.html_text">
                                                                <div class="p-2">
                                                                    <div class>
                                                                        <p v-html="question.question_details.html_text"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="">
                                                                    <div class="p-2">
                                                                        <div class="">
                                                                            <div
                                                                                class="checkbox" v-bind:key="index"
                                                                                v-for="(suggestion, index) in question.question_details.mcq_multiple_option.suggestions"
                                                                            >
                                                                                <label>
                                                                                    <input
                                                                                        v-model="checkedNames"
                                                                                        @change="updateMulAnswer"
                                                                                        class="mr-3"
                                                                                        type="checkbox"
                                                                                        :value="suggestion.text"
                                                                                    >
                                                                                    {{ suggestion.text }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="row mt-2 mb-5"
                                                            v-if="question.question_details && question.question_details.mcq_single_option "
                                                        >
                                                            <div class="col-md-12" v-if="question.question_details.html_text">
                                                                <div class="p-2">
                                                                    <div class>
                                                                        <p v-html="question.question_details.html_text"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="">
                                                                    <div class="p-2">
                                                                        <div class="">
                                                                            <div
                                                                                class="checkbox" v-bind:key="index"
                                                                                v-for="(suggestion,index) in question.question_details.mcq_single_option.suggestions"
                                                                            >
                                                                                <label>
                                                                                    <input
                                                                                        v-model="radioSuggestion"
                                                                                        @input="updateMulAnswer"
                                                                                        class="mr-3"
                                                                                        type="radio"
                                                                                        :value="suggestion.text"
                                                                                    >
                                                                                    {{ suggestion.text }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="mt-2 mb-5 col-md-12"
                                                            v-if="question.question_details && question.question_details.fib_no_options"
                                                        >
                                                        
                                                            <div class="row p-4" v-if="question.question_details.html_text">
                                                                <div class="col-md-12">
                                                                    
                                                                    <template v-for="(data,index) in (question.question_details.html_text.replace(/(<p[^>]+?>|<p>|<\/p>)/img, '').replace(/\&nbsp;/g, ' ').split(' '))">
                                                                        
                                                                        <template v-if="data.includes('#b')">
                                                                            <custom-input v-bind:key="index" :id="data" v-on:change="updateFIBAnswer" autocomplete="off"></custom-input>
                                                                            <span v-bind:key="index"></span>
                                                                        </template>
                                                                        <template v-else>
                                                                            <span v-bind:key="index" v-html="data"> </span>
                                                                            <span v-bind:key="index"></span>
                                                                        </template>
                                                                    </template>

                                                                </div>
                                                            </div>            
                                                        </div>

                                                    </div>
                                                </div>
                                                <div v-if="question && question.section_type.value == 'reading'">
                                                    <div class="border container-fluid min-vh-79" v-if="question">                                                        
                                                        <div
                                                            class="row mb-5"
                                                            v-if="question.question_details && question.question_details.mcq_single_option"
                                                        >
                                                            <div class="col-md-6">
                                                                <div class="p-2">
                                                                    <div>
                                                                        <p v-html="question.question_details.html_text_2"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row p-1" v-if="question.header">

                                                                    <div class="col-md-12">
                                                                        <p class="question-header" v-html="question.header"></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="p-1">
                                                                        <div class="col-md-12">
                                                                            <p v-html="question.question_details.html_text"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="p-2">
                                                                        <div class="col-md-12">
                                                                            <div v-bind:key="index"
                                                                                class="checkbox"
                                                                                v-for="(suggestion,index) in question.question_details.mcq_single_option.suggestions"
                                                                            >
                                                                                <label>
                                                                                    <input
                                                                                        v-model="radioSuggestion"
                                                                                        @input="updateAnswer"
                                                                                        class="mr-3"
                                                                                        type="radio"
                                                                                        :value="suggestion.text"
                                                                                    >
                                                                                    {{ suggestion.text }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="row mb-5"
                                                            v-if="question.question_details && question.question_details.mcq_multiple_option"
                                                        >
                                                            <div class="col-md-6">
                                                                <div class="p-2">
                                                                    <div class>
                                                                        <p v-html="question.question_details.html_text_2"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row p-1" v-if="question.header">
                                                                    <div class="col-md-12">
                                                                        <p class="question-header" v-html="question.header"></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="p-2">
                                                                        <div class="col-md-12">
                                                                            <p v-html="question.question_details.html_text"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="p-2">
                                                                        <div class="col-md-12">
                                                                            <div
                                                                                v-bind:key="index"
                                                                                class="checkbox"
                                                                                v-for="(suggestion, index) in question.question_details.mcq_multiple_option.suggestions"
                                                                            >
                                                                                <label>
                                                                                    <input
                                                                                        v-model="checkedNames"
                                                                                        @change="updateAnswer"
                                                                                        class="mr-3"
                                                                                        type="checkbox"
                                                                                        :value="suggestion.text"
                                                                                    >
                                                                                    {{ suggestion.text }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="mb-2 col-md-12"  v-on:drop="drop" v-on:dragover="allowDrop"
                                                            v-if="question.question_details && question.question_details.fib_drag_drop"
                                                        >

                                                            <div class="row p-2" v-if="question.header">
                                                                <div class="col-md-12">
                                                                    <p class="question-header" v-html="question.header"></p>
                                                                </div>
                                                            </div>
                                                            <div class="row p-2 custom-height" v-if="question.question_details.html_text"  >
                                                                <div class="col-md-12">
                                                                    <template v-for="(data,index) in (question.question_details.html_text.replace(/(<p[^>]+?>|<p>|<\/p>)/img, '').replace(/\&nbsp;/g, ' ').split(' '))">
                                                                        <template v-if="data.includes('#b')">
                                                                            &nbsp;
                                                                            <custom-input v-bind:key="index" :id="data" v-on:change="updateFIBAnswer" v-on:addToSuggestion="addToSuggestions"></custom-input>                            
                                                                            &nbsp;
                                                                        </template>
                                                                        <template v-else >
                                                                            <span v-bind:key="index" v-html="' '+data"> </span>
                                                                            
                                                                        </template>
                                                                    </template>

                                                                </div>
                                                            </div>
                                                            <div class="row p-2 mt-5 custom-blue-background dragdrop" v-on:drop="drop" v-on:dragover="allowDrop" v-on:focus="beforeChange" >
                                                                <div class="col-md-12">
                                                                    <div class="mb-3" >
                                                                    <span v-on:dragstart="drag" draggable="true" v-bind:key="index" v-for="(suggestion, index) in suggestionArray" class="label label-default p-1 m-2 pl-5 pr-5 mb-3">
                                                                        {{suggestion.text}}
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div
                                                                class="mb-5 col-md-12"
                                                                v-if="question.question_details && question.question_details.fib_dropdown"
                                                        >

                                                            <div class="row p-2" v-if="question.header">
                                                                <div class="col-md-12">
                                                                    <p class="question-header" v-html="question.header"></p>
                                                                </div>
                                                            </div>
                                                            <div class="row p-2 custom-height" v-if="question.question_details.html_text">
                                                                <div class="col-md-12">
                                                                    <template  v-for="(data, index) in (question.question_details.html_text.replace(/(<p[^>]+?>|<p>|<\/p>)/img, '').replace(/\&nbsp;/g, ' ').split(' '))">
                                                                        <template v-if="data.includes('#b')">
                                                                            <custom-drop-down v-bind:key="index" :customref="question.id" :suggestions="question.question_details.fib_dropdown.suggestions" :id="data" v-on:change="updateFIBAnswer">

                                                                            </custom-drop-down>
                                                                            &nbsp;
                                                                        </template>
                                                                        <template v-else >
                                                                            <span v-bind:key="index" v-html="data"> </span>
                                                                            &nbsp;
                                                                        </template>
                                                                    </template>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div
                                                                v-if="question.question_details && question.question_details.ordered_text"
                                                        >

                                                            <div class="row p-2" v-if="question.header">
                                                                <div class="col-md-12">
                                                                    <p class="question-header" v-html="question.header"></p>
                                                                </div>
                                                            </div>
                                                        <practice-ordered-text
                                                            v-if="question.question_details && question.question_details.ordered_text"
                                                            @answerChanged="orderTextUpdated"
                                                        ></practice-ordered-text>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="question && question.section_type.value == 'writing'">
                                                    <div class="border container-fluid min-vh-79" v-if="question">
                                                        <div class="row p-1" v-if="question.header">
                                                            <div class="col-md-11">
                                                                <p class="question-header" v-html="question.header"></p>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <p class="question-header float-right mr-2"> {{ time }}</p>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="row mt-2 mb-2"
                                                            v-if="question.question_details && question.question_details.html_text"
                                                        >
                                                            <div class="col-md-12">
                                                                <div class="p-2">
                                                                    <div class>
                                                                        <p v-html="question.question_details.html_text"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="row mt-2 mb-2"
                                                            v-if="question.question_details && question.question_details.html_text"
                                                        >
                                                            <div class="col-md-12"> 
                                                                <div class="p-2">
                                                                    <div class>
                                                                        <textarea
                                                                            class="w-100 h-100 text-area"
                                                                            rows="10"
                                                                            @input="updateAnswer"
                                                                            @keydown="getCursorPosition"
                                                                            @click="getCursorPosition"
                                                                            @focus="getCursorPosition"
                                                                            v-model="answer"
                                                                            spellcheck="false"
                                                                            autofocus
                                                                        ></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="row mt-2 mb-2 ml-0 mr-0"
                                                            v-if="question.question_details && question.question_details.html_text"
                                                        >
                                                            <div class="col-md-4 text-left">
                                                                <button @click="copyText" class="ccp-button">Copy</button>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <button @click="cutText" class="ccp-button">Cut</button>
                                                            </div>
                                                            <div class="col-md-4 text-right">
                                                                <button @click="pasteText" class="ccp-button">Paste</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="p-2">Total Word Count: {{ wordcount }}</div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="box-footer mt-5">
                                                <button
                                                    class="btn btn-purple mr-2 mb-2"                                                    
                                                    @click="next"
                                                >
                                                    Save
                                                </button>
                                                
                                            </div>
                                        </div>
                                    </custom-collapse-body>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>                        
            </div>        
        </div>
    </div>
</template>


<script>
import Vue from "vue";
import { mapGetters, mapActions } from 'vuex'
import VideoRecord from "../../utils/VideoRecord.vue";
import AudioRecord from "../../utils/AudioRecord.vue";
import AudioPlayer from "../../utils/AudioPlayer.vue";
import CustomInput from '../../cruds/Exam/CustomInput.vue';
import CustomDropDown from '../../cruds/Exam/CustomDropDown.vue';
//import OrderedText from "../../cruds/Exam/OrderedText.vue";
import PracticeOrderedText from "../../cruds/Exam/PracticeOrderedText.vue";
import QuestionFooter from "../../cruds/Exam/QuestionFooter.vue";
import Input from '../../cruds/Exam/Input.vue';
import CustomTextInput from '../../cruds/Exam/CustomTextInput.vue';

//import OrderedText from "./OrderedText";
//import QuestionFooter from "./QuestionFooter.vue";
//import SectionTimer from './SectionTimer.vue';

export default {
    data() {
        return {
            // Code...
            showSummary: false,
            counterMethod: null,
            playerCounterMethod: null,
            startRecording: false,
            stopRecording: true,
            timeLimit: 10,
            seconds: 0,
            playerSeconds: 0,
            startPlaying: false,
            startRecordingCountDown: true,
            recordingEvent: false,
            recordingSeconds: 0,
            answer: "",
            copiedText: null,
            seconds: 0,
            checkedNames: [],
            radioSuggestion:false,
            fibAnswer: {},
            suggestionArray: [],                                    
            playingCompleted: false,
            playingComplete: false,
            selectedText: [],
            startPlaying:false,
            radioSuggestion:false,
            
                        
        }
    },
    created() {   
        this.fibAnswer = {};
        this.suggestionArray = [];             
        this.checkedNames = [];
        this.getQuestion(parseInt(this.$route.params.id));
        if(this.question && this.question.section_type.value == 'speaking'){

                //console.log("checking its coming in created everytime");
                this.recordingEvent = false;
                this.seconds = this.question.preparation_time;
                if(this.question.question_details.audio_upload){
                    this.playerSeconds = this.question.preparation_time;
                    this.startRecordingCountDown = false;
                }
                else
                    this.playerSeconds = 0;
            
        }
        if(this.question && this.question.section_type.value == 'writing'){
        
        }
        if(this.question && this.question.section_type.value == 'listening_sst'){
            
            if(this.question.question_details.audio_upload){
                //this.playerSeconds = 5;
                if(this.question.question_details.audio_upload){
                    this.playerSeconds = 5;
                    //this.startRecordingCountDown = false;
                }
                else
                    this.playerSeconds = 0;

                if (this.question.question_details.audio_upload && this.playerSeconds > 0) {
                    this.playerCounterMethod = setInterval(this.myPlayerTimer, 1000);
                }
                this.seconds = this.question.attempt_time;
                //this.startRecordingCountDown = false;
            }
            else
                this.playerSeconds = 0;

            if (this.question.question_details.audio_upload && this.playerSeconds > 0) {
                this.playerCounterMethod = setInterval(this.myPlayerTimer, 1000);
            }
            this.seconds = this.question.attempt_time;
        }
        if(this.question && this.question.section_type.value == 'listening_rol'){
         
            this.selectedText = [];    
            if(this.question.answer_details.select_text){
                var elems = document.querySelectorAll(".highlightdiv div span");

                    [].forEach.call(elems, function(el) {
                        el.classList.remove("hl");
                    });
                }
            if(this.question.question_details.audio_upload){
                this.playerSeconds = 5;
                //this.startRecordingCountDown = false;
            }
            else
                this.playerSeconds = 0;

            if (this.question.question_details.audio_upload && this.playerSeconds > 0) {
                this.playerCounterMethod = setInterval(this.myPlayerTimer, 1000);
            }
        }
        if(this.question && this.question.section_type.value == 'reading'){
            this.fibAnswer = {};
            this.suggestionArray = [];    
            if(this.question.question_details.fib_drag_drop){            
                //console.log("type is drag and drop");
                this.suggestionArray = JSON.parse(JSON.stringify(this.question.question_details.fib_drag_drop.suggestions));
                //console.log(this.suggestionArray);
                let x = document.getElementsByClassName("dragdrop");
                for(let i=0; i< x.length; i++){
                    x[i].value = "";
                }
            }
        }        
    },
    mounted() {
        let context = this;
        this.checkedNames = []; 
        if(this.question && this.question.section_type.value == 'writing'){
            this.seconds = this.question.attempt_time;
            this.counterMethod = setInterval(this.myTimer,1000);
        }
        if(this.question && this.question.section_type.value == 'reading'){
            
        }
        if(this.question && this.question.section_type.value == 'listening_sst'){
            
            if(this.question.question_details.audio_upload){
                //this.playerSeconds = 5;
                if(this.question.question_details.audio_upload){
                    this.playerSeconds = 5;
                    //this.startRecordingCountDown = false;
                }
                else
                    this.playerSeconds = 0;

                if (this.question.question_details.audio_upload && this.playerSeconds > 0) {
                    this.playerCounterMethod = setInterval(this.myPlayerTimer, 1000);
                }
                this.seconds = this.question.attempt_time;
                //this.startRecordingCountDown = false;
            }
            else
                this.playerSeconds = 0;

            if (this.question.question_details.audio_upload && this.playerSeconds > 0) {
                this.playerCounterMethod = setInterval(this.myPlayerTimer, 1000);
            }
            this.seconds = this.question.attempt_time;
        }
        if(this.question && this.question.section_type.value == 'listening_rol'){
         
            this.selectedText = [];    
            if(this.question.answer_details.select_text){
                var elems = document.querySelectorAll(".highlightdiv div span");

                    [].forEach.call(elems, function(el) {
                        el.classList.remove("hl");
                    });
                }
            if(this.question.question_details.audio_upload){
                this.playerSeconds = 5;
                //this.startRecordingCountDown = false;
            }
            else
                this.playerSeconds = 0;

            if (this.question.question_details.audio_upload && this.playerSeconds > 0) {
                this.playerCounterMethod = setInterval(this.myPlayerTimer, 1000);
            }
        }
        if(this.question && this.question.section_type.value == 'speaking'){
            //console.log("hcekcing in speaking");
            this.recordingEvent = false;
            this.seconds = this.question.preparation_time;
            if(this.question.question_details.audio_upload){
                this.playerSeconds = this.question.preparation_time;
                this.startRecordingCountDown = false;
            }
            else
                this.playerSeconds = 0;
            
            this.recordingSeconds=0; 
            this.recordingSeconds = this.question.attempt_time;
            this.counterMethod = setInterval(this.myTimer,1000);
            this.playerCounterMethod = setInterval(this.myPlayerTimer,1000); 
            
            
        }
        
    },
     destroyed() {
        clearInterval(this.playerCounterMethod);
        clearInterval(this.counterMethod);
         this.resetState();
     },
    components: {
        VideoRecord,
        AudioRecord,
        AudioPlayer,
        //OrderedText,
        Input,
        QuestionFooter,
        CustomDropDown,
        CustomInput,
        CustomTextInput,
        PracticeOrderedText
    },
    computed: {        
        ...mapGetters("PracticeQuestionsTest", [
                "item",
                "loading",
                "questions",
                "question"                
            ]),
            time(){
               return new Date(this.seconds * 1000).toISOString().substr(14, 5);
            },
            wordcount() {
                if(this.answer !=""){
                    return this.answer.match(/\S+/g).length
                }else{
                    return 0;
                }                    
            }
    },
    watch: {
        "$route.params.id": function() {
            this.fibAnswer = {};
            this.checkedNames = [];
            this.getQuestion(parseInt(this.$route.params.id)-1);            
            if(this.question && this.question.section_type.value == 'speaking'){            
                if(document.getElementById('imagequestion'))
                    document.getElementById('imagequestion').setAttribute('src','');                
                this.seconds = this.question.preparation_time;
                if(this.question.question_details.audio_upload){
                    this.playerSeconds = this.question.preparation_time;
                    this.startRecordingCountDown = false;
                    this.startPlaying = false;
                    this.startRecording = false;
                    this.recordingEvent = false;
                    //if(this.playerCounterMethod == null)
                    //console.log(typeof this.playerCounterMethod);
                    this.playerCounterMethod = setInterval(this.myPlayerTimer,1000);
                }
                else{
                    this.playerSeconds = 0;
                    this.startRecordingCountDown = true;
                    //this.startPlaying = false;
                }
                //if(this.question.question_details && this.question.question_details.audio_upload)
                this.recordingSeconds = this.question.attempt_time;
                this.counterMethod = setInterval(this.myTimer,1000);
            }
            if(this.question && this.question.section_type.value == 'listening_sst'){
                this.fibAnswer = {};
                this.suggestionArray = [];
                if(this.question.question_details.fib_drag_drop){
                //console.log("type is drag and drop");
                this.suggestionArray = JSON.parse(JSON.stringify(this.question.question_details.fib_drag_drop.suggestions));
                //console.log(this.suggestionArray);
                let x = document.getElementsByClassName("dragdrop");
                    for(let i=0; i< x.length; i++){
                        x[i].value = "";
                    }
                }
                this.playingCompleted = false;
                this.seconds = this.question.attempt_time;
                this.answer = "";
                this.copiedText = "";
                if(this.question.question_details.audio_upload){
                    this.playerSeconds = 5;
                    this.startPlaying = false;
                }
                else{
                    this.playerSeconds = 0;
                    //this.startPlaying = false;
                }
                clearInterval(this.playerCounterMethod);
                clearInterval(this.counterMethod);
                if (this.question.question_details.audio_upload && this.playerSeconds > 0) {
                    this.playerCounterMethod = setInterval(this.myPlayerTimer, 1000);
                }
            }
            if(this.question && this.question.section_type.value == 'reading'){
                this.fibAnswer = {};
                this.suggestionArray = [];
                if(this.question.question_details.fib_drag_drop){
                //console.log("type is drag and drop");
                this.suggestionArray = JSON.parse(JSON.stringify(this.question.question_details.fib_drag_drop.suggestions));
                //console.log(this.suggestionArray);
                let x = document.getElementsByClassName("dragdrop");
                    for(let i=0; i< x.length; i++){
                        x[i].value = "";
                    }
                }
            }
            if(this.question && this.question.section_type.value == 'listening_rol')
            {
                this.fibAnswer = {};
                this.suggestionArray = [];
                if(this.question.question_details.fib_drag_drop){
                //console.log("type is drag and drop");
                this.suggestionArray = JSON.parse(JSON.stringify(this.question.question_details.fib_drag_drop.suggestions));
                //console.log(this.suggestionArray);
                let x = document.getElementsByClassName("dragdrop");
                    for(let i=0; i< x.length; i++){
                        x[i].value = "";
                    }
                }
                    this.playingComplete = false;
                    this.selectedText = [];
                    
                    //element.classList.remove("hl");        
                    this.seconds = this.question.preparation_time;
                    this.answer = "";
                    this.copiedText = "";
                    if(this.question.question_details.audio_upload){
                    this.playerSeconds = 5;
                    this.startPlaying = false;
                    }
                    else{
                    this.playerSeconds = 0;
                    //this.startPlaying = false;
                    }
                    if(this.question.answer_details.fib_no_options){
                    //console.log("type is drag and drop");
                    let x = document.getElementsByClassName("dragdrop");
                    for(let i=0; i< x.length; i++){
                        x[i].value = "";
                    }
                    }
                    if(this.question.answer_details.select_text){
                    var elems = document.querySelectorAll(".highlightdiv div span");

                        [].forEach.call(elems, function(el) {
                            el.classList.remove("hl");
                        });
                    }
                    if(this.question.question_details.fib_dropdown){
                    let x = document.getElementsByClassName("custom-dropdown");
                    for(let i=0; i< x.length; i++){
                        x[i].value = "";
                    }
                    }
            }
            if(this.question && this.question.section_type.value == 'writing'){

                //console.log("checking its here or not");
                //this.resetQuestionState();
                this.seconds = this.question.attempt_time;
                this.answer = "";
                this.copiedText = "";
                clearInterval(this.counterMethod);
                this.counterMethod = setInterval(this.myTimer,1000);            }

        }
    },
    methods: {
        //...mapActions('StudentPanel', ['fetchCoursesAndChaptersPracticeQuestions', 'resetState']),
        ...mapActions("PracticeQuestionsTest", [            
            "fetchData",
            "setQuestion",
            "resetState",
            'setAnswer',
            'saveAnswer',
            'fetchQuestion'

        ]),
        getQuestion(id){
            this.fetchQuestion(id);
            //this.setQuestion(id);
        },
        toggleColumns(){
            this.showSummary = !this.showSummary;
        },
        getSelection(){
            var seltxt = '';
            if (window.getSelection) {
            //console.log("check window");
            seltxt = window.getSelection();          
            } else if (document.getSelection) {
              //  console.log("check get se");
            seltxt = document.getSelection();
            } else if (document.selection) {
               // console.log("sele");
            seltxt = document.selection.createRange().html;
            }
            else return;
            return seltxt;
        },
        next(){
            let id = parseInt(this.$route.params.id)+1;
            if(this.question && this.question.section_type.value == 'speaking'){
                    if(!this.startRecording){
                this.stopQuestion();
                //this.saveAnswer();
                window.clearInterval(this.playerCounterMethod);
                window.clearInterval(this.counterMethod);

                this.$router.push({name: "student.practicequestions.seen"});
                //console.log("we got thi");  

                }else{
                this.stopQuestion();
                } 
            }
            if(this.question && this.question.section_type.value == 'writing')
            {
                    clearInterval(this.counterMethod);
                    this.saveAnswer();
                    this.$router.push({name: "student.practicequestions.seen"});
            }
            if(this.question && this.question.section_type.value == 'reading')
            {
                    //clearInterval(this.counterMethod);
                    this.saveAnswer();
                    this.$router.push({name: "student.practicequestions.seen"});
            }
            if(this.question && this.question.section_type.value == 'listening_sst'){
                clearInterval(this.counterMethod);
                this.saveAnswer();
                this.$router.push({name: "student.practicequestions.seen"});
            }
            if(this.question && this.question.section_type.value == 'listening_rol'){
                this.saveAnswer();
               this.$router.push({name: "student.practicequestions.seen"});
            }            
        },
        myTimer(){
            if(this.question && this.question.section_type.value == 'reading'){
                
            }
            if(this.question && this.question.section_type.value == 'listening_sst'){
                 this.countDown();
            }
            if(this.question && this.question.section_type.value == 'listening_rol'){
                
            }
            if(this.question && this.question.section_type.value == 'writing'){
                this.countDown();
            }
            if(this.question && this.question.section_type.value == 'speaking'){              
                if (this.startRecordingCountDown) {
                    this.countDown();
                }
            }
        },
        myPlayerTimer(){
            if(this.question && this.question.section_type.value == 'writing'){
                if (this.question.question_details && this.question.question_details.audio_upload && this.playerSeconds > 0) {
                    //console.log("in my player time")
                    this.playerCountDown();
                }else if(this.question.question_details && this.question.question_details.audio_upload && this.playerSeconds == 0){
                    this.startPlayer();
                }
            }
            if(this.question && this.question.section_type.value == 'listening_sst'){
                this.playerCountDown();
            }
            if(this.question && this.question.section_type.value == 'listening_rol'){
                this.playerCountDown();
            }
        },
        handleCountdownEnd() {
            //console.log("handle countdown end");
        },
        onRecordingComplete() {
            this.recordingEvent = true;
            this.startRecording = false;
            this.next();
        },
        countDown() {
            if(this.question && this.question.section_type.value == 'speaking')
            {
                //console.log("call count down",this.seconds);
                let tempSeconds = this.seconds;
                if (this.seconds >= 0) {
                if (this.seconds == 0) {
                    this.startQuestion();            
                }
                this.seconds = this.seconds - 1;
                }else{              
                if(this.recordingSeconds > 0){
                    this.recordingSeconds -= 1;            
                }
                }
            }
            if(this.question && this.question.section_type.value == 'writing')
            {
                //console.log("in writing countdown", this.seconds);
                if(this.seconds == 0){
                if(this.lastQuestion){
                    this.endSection();
                }else{
                    this.next();
                }
                }else{
                this.seconds = this.seconds - 1;
                }
            }
      },
      playerCountDown() {
        if (this.playerSeconds == 0) {
          this.startPlayer();
        }
        this.playerSeconds = this.playerSeconds - 1;
      },
      startPlayer() {
        this.startAudioPlayer();
      },
      startQuestion() {
        this.startAudioRecording();
      },
      stopQuestion() {
        this.stopAudioRecording();
      },
      startAudioPlayer() {
        //console.log("checking its coming here or not");
        this.startPlaying = true;
      },
      startAudioRecording() {
        //console.log("before",this.startRecording);
        this.startRecording = true;
        this.stopRecording = false;
        //console.log(this.startRecording);
      },
      stopAudioRecording() {
        this.startRecording = false;
        this.stopRecording = true;
      },
      onPlayingComplete(value) {
        //console.log("on playing complete event for paretnt");
        if(value){
          this.startRecordingCountDown = true;
        }
      },
      getCursorPosition(event) {
            let el = event.target;
            this.lastKnownPosition = 0;
            if ("selectionStart" in el) {
                this.lastKnownPosition = el.selectionStart;
            } else if ("selection" in document) {
                el.focus();
                let Sel = document.selection.createRange();
                let SelLength = document.selection.createRange().text.length;
                Sel.moveStart("character", -el.value.length);
                this.lastKnownPosition = Sel.text.length - SelLength;
            }
        },
        getSelectedText() {
            this.copiedText = null;
            var txtArea = document.getElementsByClassName("text-area")[0];
            var selectedText;
            if (txtArea.selectionStart != undefined)
            {
              var startPosition = txtArea.selectionStart;
              var endPosition = txtArea.selectionEnd;
              selectedText = txtArea.value.substring(startPosition, endPosition);
            }
            this.copiedText = selectedText;
        },
        copyText() {
            this.getSelectedText();
        },
        cutText() {
            this.getSelectedText();
            document.execCommand("cut");
        },
        pasteText() {
            if (!String.prototype.splice) {
                /**
                 * {JSDoc}
                 *
                 * The splice() method changes the content of a string by removing a range of
                 * characters and/or adding new characters.
                 *
                 * @this {String}
                 * @param {number} start Index at which to start changing the string.
                 * @param {number} delCount An integer indicating the number of old chars to remove.
                 * @param {string} newSubStr The String that is spliced in.
                 * @return {string} A new string with the spliced substring.
                 */
                String.prototype.splice = function(start, delCount, newSubStr) {
                    return (
                        this.slice(0, start) +
                        newSubStr +
                        this.slice(start + Math.abs(delCount))
                    );
                };
            }
            if(this.copiedText != null){
                this.answer = this.answer.splice(
                    this.lastKnownPosition,
                    0,
                    this.copiedText
                );
            }
            
        },        
        verifyURL(url){
            return url.replace('.com//','.com/');
        },
        customdrop(ev){
            //console.log("here drop in reading div");
            ev.preventDefault();
            var data = ev.dataTransfer.getData("value").trim();
            //console.log("in Drop",data);
            this.addToSuggestions(data);    
        },
        drop(ev){
            //console.log("here drop in reading");
            ev.preventDefault();
            var data = ev.dataTransfer.getData("value").trim();
            //console.log("in Drop",data);
            this.addToSuggestions(data);    
            //alert(data);
            //this.updateAnswer(ev);
        },
        customallowDrop(ev){
            //console.log("allowDrop in reading parent");
            ev.preventDefault()
        },
        allowDrop(ev){
            //console.log("allowDrop in reading");
            ev.preventDefault()
        },
        beforeChange(){
            //console.log("in before change in reading");
            //   ev.dataTransfer.setData("value", ev.target.value);
            //   ev.target.value = "";
        },
        updateFIBAnswer(index, value){
            //console.log("updateFIBAnswer");
            if(this.question.section_type.value == 'reading'){
                console.log("cec");
                this.fibAnswer[index] = value;
                if(this.question.question_details.fib_drag_drop){
                    //console.log(index, value);
                    this.removeByAttr('text', value);
                    
                }
            }else{
                this.fibAnswer[index] = value;
                this.updateMulAnswer();
            }
            

            this.updateAnswer();
        },
        addToSuggestions(value){
            let vm = this;
            var exists = Object.keys(vm.suggestionArray).some(function(k) {
                return vm.suggestionArray[k].text == value;
            });
            if(value && !exists)
            this.suggestionArray.push({'chosen':false, 'text':value});
        
        },
        removeByAttr(attr, value){            
                var i = this.suggestionArray.length;        
                while(i--){                    
                if( this.suggestionArray[i] && this.suggestionArray[i].hasOwnProperty(attr) && this.suggestionArray[i][attr].trim() == value.trim() ){                        
                        this.suggestionArray.splice(i,1);
                    }
                }            
        },
        drag(ev){
            //console.log('drag in reading');
                ev.dataTransfer.setData("value", ev.target.innerHTML);
        },
        updateAnswer(event){
            console.log("in update answer")
            //console.log("checking here");                      
            if(this.question.question_details.mcq_multiple_option){
                this.setAnswer(JSON.stringify(this.checkedNames));
                return
            }
            else if(this.question.question_details.mcq_single_option){
                this.setAnswer(event.target.value);
                return
            }
            else if(this.question.question_details.fib_drag_drop){
                console.log("checking");
                this.setAnswer(JSON.stringify(this.fibAnswer));
                return
            }
            else if(this.question.question_details.fib_dropdown){
                this.setAnswer(JSON.stringify(this.fibAnswer));
                return
            }else{
                this.setAnswer(event.target.value);
                return;
            }

        },
        orderTextUpdated(value) {
            //console.log("orderTextUpdated value: ", value);
            this.setAnswer(JSON.stringify(value));
        },
        // updateFIBAnswer(index, value){
        //     this.fibAnswer[index] = value;
        //     this.updateMulAnswer();
        // },
        updateMulAnswer(event){
            
            if(this.question.question_details.mcq_multiple_option){
                this.setAnswer(JSON.stringify(this.checkedNames));
                return
            }
            if(this.question.question_details.mcq_single_option){
                this.setAnswer(event.target.value);
                return
            }
            if(this.question.question_details.fib_no_options){
                this.setAnswer(JSON.stringify(this.fibAnswer));
                return
            }
        },
        highLightWord(e){
            let element = e.target;
            if(element.classList.contains("hl")){
                element.classList.remove("hl");
                for( var i = 0; i < this.selectedText.length; i++){ 
                    if ( this.selectedText[i] == element.innerText.trim()) {
                        this.selectedText.splice(i, 1); 
                        i--;
                    }
                }
            }else{
                element.classList.add("hl");
                this.selectedText.push(element.innerText.trim());
            }
            //console.log(this.selectedText);
            //this.setAnswer(JSON.stringify(this.selectedText));
        },
    }
}
</script>
<style scoped>
    .question-header{
        font-style: italic;
        font-weight: bold;
    }
    .border{
        border: 2px solid black !important;
    }
    .ccp-button {
        min-width: 150px;
        background: #ffffff;
        -webkit-appearance: unset;
        -moz-appearance: unset;
        -webkit-box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
        -moz-box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
        box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
        border-style: inset;
    }
    textarea{
        border-style: inset;
    }
    .ccp-button {
        min-width: 150px;
        background: #ffffff;
        -webkit-appearance: unset;
        -moz-appearance: unset;
        -webkit-box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
        -moz-box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
        box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
    }
    span.hl {
        background-color: yellow !important;
    }
    .custom-blue-background {
    background-color: #ddf2ff;
    color: black;
    }
    .border-blue {
        border: 1px solid #8ebaff;
    }
    .min-vh-79{
        min-height: 79vh !important;
    }
    .dragdrop, .dragdrop input{
        line-height: 20px;
        border: 1px solid gray;
    }
    .dragdrop .label{
        background: white;
        border:1px solid black;
    }
    select.custom-dropdown{
        color: #000000;
        background: #f8f8f8;
        border-style: solid;
        -webkit-appearance: menulist-button !important;
        -moz-appearance: menulist-button !important;
    }
</style>


