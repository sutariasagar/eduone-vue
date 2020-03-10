<?php

Route::group(['prefix' => '/v1', 'middleware' => ['auth:api'], 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    Route::post('change-password', 'ChangePasswordController@changePassword')->name('auth.change_password');
    Route::apiResource('rules', 'RulesController', ['only' => ['index']]);
    Route::apiResource('permissions', 'PermissionsController');
    Route::apiResource('roles', 'RolesController');
    Route::apiResource('users', 'UsersController');
	Route::apiResource('industries', 'IndustriesController');
	Route::apiResource('courses', 'CoursesController');
	Route::apiResource('subjects', 'SubjectsController');
	Route::apiResource('chapters', 'ChaptersController');
	Route::apiResource('topics', 'TopicsController');
	Route::apiResource('skills', 'SkillsController');
	Route::apiResource('question-types', 'QuestionTypesController');
	Route::apiResource('modules', 'ModulesController');
	Route::apiResource('learning-materials', 'LearningMaterialsController');
	Route::apiResource('learning-material-documents', 'LearningMaterialDocumentsController');
	Route::apiResource('questions-types', 'QuestionsTypesController');
	Route::apiResource('answers-types', 'AnswersTypesController');
	Route::apiResource('questions-banks', 'QuestionsBanksController');
	Route::apiResource('exams', 'ExamsController');
	Route::apiResource('exam-sections', 'ExamSectionsController');
	Route::apiResource('exam-section-subject-mappings', 'ExamSectionSubjectMappingsController');
	Route::apiResource('media', 'MediaController');
	Route::apiResource('packages', 'PackagesController');
	Route::put('students/reset-password', 'StudentsController@resetPassword');
	Route::apiResource('students', 'StudentsController');
	Route::apiResource('communication-skills', 'CommunicationSkillsController');
	Route::get('students/getcredentials/{id}', 'StudentsController@getCredentials')->name('student.getcredentials');
	Route::get('material-types', 'ConfigController@materialTypes')->name('config.material_types');
	Route::get('sections', 'ConfigController@sections')->name('config.sections');
	Route::get('profile', 'ProfileController@show')->name('profile_show');
	Route::put('profile', 'ProfileController@update')->name('profile');
	Route::apiResource('question-sets', 'QuestionSetsController');
	Route::apiResource('enabling-skills', 'EnablingSkillsController');
	Route::get('tags', 'ConfigController@tags')->name('config.tags');
	Route::get('exams/{id}/students', 'ResultsController@showResult');	
	Route::get('exams/{exam_id}/students/{stu_id}/review', 'ResultsController@showReview');
	Route::get('exams/{exam_id}/students/{stu_id}/generateresult', 'ResultsController@generateResult');
	Route::post('answers/speaking','StudentPanelController@speakingAnswer')->name('speakinganswer');
	Route::post('answers/{id}', 'ResultsController@saveAnswer');
	Route::post('saveanswersasdraft/{id}', 'ResultsController@saveAnswerAsDraft');
	Route::apiResource('terminals', 'TerminalsController');
	Route::get('coursesandchapters', 'StudentPanelController@coursesAndChapters');	
	Route::get('coursesandchapters/seen', 'StudentPanelController@coursesAndChaptersSeen');	
	Route::get('coursesandchapters/notseen', 'StudentPanelController@coursesAndChaptersNotSeen');
	
	Route::get('coursesandchapters/count', 'StudentPanelController@coursesAndChaptersCount');	
	Route::get('coursesandchapters/seen/count', 'StudentPanelController@coursesAndChaptersSeenCount');	
	Route::get('coursesandchapters/notseen/count', 'StudentPanelController@coursesAndChaptersNotSeenCount');

	Route::get('chapterwisevideos/subject/{subject_id}/chapter/{chapter_id}', 'StudentPanelController@getVideos');
	
	Route::get('coursesandchaptersdocuments', 'StudentPanelController@coursesAndChaptersDocuments');
	Route::get('coursesandchaptersdocuments/seen', 'StudentPanelController@coursesAndChaptersDocumentsSeen');
	Route::get('coursesandchaptersdocuments/notseen', 'StudentPanelController@coursesAndChaptersDocumentsNotSeen');

	Route::get('coursesandchaptersdocuments/count', 'StudentPanelController@coursesAndChaptersDocumentsCount');
	Route::get('coursesandchaptersdocuments/seen/count', 'StudentPanelController@coursesAndChaptersDocumentsSeenCount');
	Route::get('coursesandchaptersdocuments/notseen/count', 'StudentPanelController@coursesAndChaptersDocumentsNotSeenCount');
	
	Route::get('practicequestions/seen', 'StudentPanelController@practiceQuestionsSeen');	

	Route::get('practicequestions/count', 'StudentPanelController@practiceQuestionsCount');
	Route::get('practicequestions/seen/count', 'StudentPanelController@practiceQuestionsSeenCount');
	Route::get('practicequestions/notseen/count', 'StudentPanelController@practiceQuestionsNotSeenCount');

	
	Route::get('coursesandchapterspracticequestions', 'StudentPanelController@practiceQuestions');
	Route::get('start-exam', 'StudentPanelController@startExam')->name('startexam');
	Route::get('exams/questions/{examId}', 'StudentPanelController@getSectionWiseQuestions')->name('examquestions');		

	Route::post('introaudio','StudentPanelController@uploadIntroAudio')->name('introaudio');
	Route::post('updatedocumentsused','StudentPanelController@updateDocumentsUsed')->name('documentsused');

	Route::get('fetchpracticequestions/{subjectid}/{chapterid}/{level}', 'StudentPanelController@getQuestions')->name('practicequestions');
	Route::post('practiceanswers','AnswersController@store')->name('practiceanswer');
	Route::get('fetchsinglepracticequestions/{id}', 'StudentPanelController@getQuestion')->name('showquestion');
	// route for oauth
	Route::get('me', 'UsersController@me')->name('me');	
});
