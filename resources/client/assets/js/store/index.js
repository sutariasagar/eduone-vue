import Vue from 'vue'
import Vuex from 'vuex'
import Alert from './modules/alert'
import ChangePassword from './modules/change_password'
import Profile from './modules/profile'
import Rules from './modules/rules'
import PermissionsIndex from './modules/Permissions'
import PermissionsSingle from './modules/Permissions/single'
import RolesIndex from './modules/Roles'
import RolesSingle from './modules/Roles/single'
import UsersIndex from './modules/Users'
import UsersSingle from './modules/Users/single'
import IndustriesIndex from './modules/Industries'
import IndustriesSingle from './modules/Industries/single'
import CoursesIndex from './modules/Courses'
import CoursesSingle from './modules/Courses/single'
import SubjectsIndex from './modules/Subjects'
import SubjectsSingle from './modules/Subjects/single'
import ChaptersIndex from './modules/Chapters'
import ChaptersSingle from './modules/Chapters/single'
import TopicsIndex from './modules/Topics'
import TopicsSingle from './modules/Topics/single'
import SkillsIndex from './modules/Skills'
import SkillsSingle from './modules/Skills/single'
import QuestionTypesIndex from './modules/QuestionTypes'
import QuestionTypesSingle from './modules/QuestionTypes/single'
import ModulesIndex from './modules/Modules'
import ModulesSingle from './modules/Modules/single'
import LearningMaterialsIndex from './modules/LearningMaterials'
import LearningMaterialsSingle from './modules/LearningMaterials/single'
import LearningMaterialDocumentsIndex from './modules/LearningMaterialDocuments'
import LearningMaterialDocumentsSingle from './modules/LearningMaterialDocuments/single'
import QuestionsTypesIndex from './modules/QuestionsTypes'
import QuestionsTypesSingle from './modules/QuestionsTypes/single'
import AnswersTypesIndex from './modules/AnswersTypes'
import AnswersTypesSingle from './modules/AnswersTypes/single'
import QuestionsBanksIndex from './modules/QuestionsBanks'
import QuestionsBanksSingle from './modules/QuestionsBanks/single'
import ExamsIndex from './modules/Exams'
import ExamsSingle from './modules/Exams/single'
import ExamSectionsIndex from './modules/ExamSections'
import ExamSectionsSingle from './modules/ExamSections/single'
import ExamSectionsMultiple from './modules/ExamSections/multiple'
import ExamSectionSubjectMappingsIndex from './modules/ExamSectionSubjectMappings'
import ExamSectionSubjectMappingsSingle from './modules/ExamSectionSubjectMappings/single'
import QuestionSetsIndex from './modules/QuestionSets'
import QuestionSetsSingle from './modules/QuestionSets/single'
import PackagesIndex from './modules/Packages'
import PackagesSingle from './modules/Packages/single'
import StudentsIndex from './modules/Students'
import StudentsSingle from './modules/Students/single'
import EnablingSkillsIndex from './modules/EnablingSkills'
import EnablingSkillsSingle from './modules/EnablingSkills/single'
import CommunicationSkillsIndex from './modules/CommunicationSkills'
import CommunicationSkillsSingle from './modules/CommunicationSkills/single'
import TerminalsIndex from './modules/Terminals'
import TerminalsSingle from './modules/Terminals/single'
import ExamsReview from './modules/Exams/review'
import StudentPanel from './modules/Student/single'
import StudentExam from './modules/Student/exam'
import PracticeQuestionsTest from './modules/PracticeQuestions/single'
import createPersistedState from 'vuex-persistedstate'
Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        Alert,
        Profile,
        ChangePassword,
        Rules,
        PermissionsIndex,
        PermissionsSingle,
        RolesIndex,
        RolesSingle,
        UsersIndex,
        UsersSingle,
        IndustriesIndex,
        IndustriesSingle,
        CoursesIndex,
        CoursesSingle,
        SubjectsIndex,
        SubjectsSingle,
        ChaptersIndex,
        ChaptersSingle,
        TopicsIndex,
        TopicsSingle,
        SkillsIndex,
        SkillsSingle,
        QuestionTypesIndex,
        QuestionTypesSingle,
        ModulesIndex,
        ModulesSingle,
        LearningMaterialsIndex,
        LearningMaterialsSingle,
        LearningMaterialDocumentsIndex,
        LearningMaterialDocumentsSingle,
        QuestionsTypesIndex,
        QuestionsTypesSingle,
        AnswersTypesIndex,
        AnswersTypesSingle,
        QuestionsBanksIndex,
        QuestionsBanksSingle,
        ExamsIndex,
        ExamsSingle,
        ExamSectionsIndex,
        ExamSectionsSingle,
        ExamSectionsMultiple,
        ExamSectionSubjectMappingsIndex,
        ExamSectionSubjectMappingsSingle,
        QuestionSetsIndex,
        QuestionSetsSingle,
        PackagesIndex,
        PackagesSingle,
        StudentsIndex,
        StudentsSingle,
        ExamsReview,
        EnablingSkillsIndex,
        EnablingSkillsSingle,
        CommunicationSkillsIndex,
        CommunicationSkillsSingle,
        TerminalsIndex,
        TerminalsSingle,
        StudentPanel,
        StudentExam,
        PracticeQuestionsTest        
    },
    strict: debug,
    plugins: [createPersistedState()]
})
