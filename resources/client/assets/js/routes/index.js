import Vue from 'vue'
import VueRouter from 'vue-router'

// Containers
import VueSkeletonLoading from 'vue-skeleton-loading';
import Full from '../container/Full.vue';
import Auth from '../container/Auth.vue';
import StudentDashboard from '../container/Student.vue';
import ExamView from '../container/Exam.vue';

import ChangePassword from '../components/ChangePassword.vue'
import PermissionsIndex from '../components/cruds/Permissions/Index.vue'
import PermissionsCreate from '../components/cruds/Permissions/Create.vue'
import PermissionsShow from '../components/cruds/Permissions/Show.vue'
import PermissionsEdit from '../components/cruds/Permissions/Edit.vue'
import RolesIndex from '../components/cruds/Roles/Index.vue'
import RolesCreate from '../components/cruds/Roles/Create.vue'
import RolesShow from '../components/cruds/Roles/Show.vue'
import RolesEdit from '../components/cruds/Roles/Edit.vue'
import UsersIndex from '../components/cruds/Users/Index.vue'
import UsersCreate from '../components/cruds/Users/Create.vue'
import UsersShow from '../components/cruds/Users/Show.vue'
import UsersEdit from '../components/cruds/Users/Edit.vue'
import DashboardIndex from '../components/cruds/dashboard/index.vue'
import IndustriesIndex from '../components/cruds/Industries/Index.vue'
import IndustriesCardIndex from '../components/cruds/Industries/IndexList.vue'
import IndustriesCreate from '../components/cruds/Industries/Create.vue'
import IndustriesShow from '../components/cruds/Industries/Show.vue'
import IndustriesEdit from '../components/cruds/Industries/Edit.vue'
import CoursesIndex from '../components/cruds/Courses/Index.vue'
import CoursesCreate from '../components/cruds/Courses/Create.vue'
import CoursesShow from '../components/cruds/Courses/Show.vue'
import CoursesEdit from '../components/cruds/Courses/Edit.vue'
import SubjectsIndex from '../components/cruds/Subjects/Index.vue'
import SubjectsCreate from '../components/cruds/Subjects/Create.vue'
import SubjectsShow from '../components/cruds/Subjects/Show.vue'
import SubjectsEdit from '../components/cruds/Subjects/Edit.vue'
import ChaptersIndex from '../components/cruds/Chapters/Index.vue'
import ChaptersCreate from '../components/cruds/Chapters/Create.vue'
import ChaptersShow from '../components/cruds/Chapters/Show.vue'
import ChaptersEdit from '../components/cruds/Chapters/Edit.vue'
import TopicsIndex from '../components/cruds/Topics/Index.vue'
import TopicsCreate from '../components/cruds/Topics/Create.vue'
import TopicsShow from '../components/cruds/Topics/Show.vue'
import TopicsEdit from '../components/cruds/Topics/Edit.vue'
import SkillsIndex from '../components/cruds/Skills/Index.vue'
import SkillsCreate from '../components/cruds/Skills/Create.vue'
import SkillsShow from '../components/cruds/Skills/Show.vue'
import SkillsEdit from '../components/cruds/Skills/Edit.vue'
// import QuestionTypesIndex from '../components/cruds/QuestionTypes/Index.vue'
// import QuestionTypesCreate from '../components/cruds/QuestionTypes/Create.vue'
// import QuestionTypesShow from '../components/cruds/QuestionTypes/Show.vue'
// import QuestionTypesEdit from '../components/cruds/QuestionTypes/Edit.vue'
import ModulesIndex from '../components/cruds/Modules/Index.vue'
import ModulesCreate from '../components/cruds/Modules/Create.vue'
import ModulesShow from '../components/cruds/Modules/Show.vue'
import ModulesEdit from '../components/cruds/Modules/Edit.vue'
import LearningMaterialsIndex from '../components/cruds/LearningMaterials/Index.vue'
import LearningMaterialsCreate from '../components/cruds/LearningMaterials/Create.vue'
import LearningMaterialsShow from '../components/cruds/LearningMaterials/Show.vue'
import LearningMaterialsEdit from '../components/cruds/LearningMaterials/Edit.vue'
import LearningMaterialDocumentsIndex from '../components/cruds/LearningMaterialDocuments/Index.vue'
import LearningMaterialDocumentsCreate from '../components/cruds/LearningMaterialDocuments/Create.vue'
import LearningMaterialDocumentsShow from '../components/cruds/LearningMaterialDocuments/Show.vue'
import LearningMaterialDocumentsEdit from '../components/cruds/LearningMaterialDocuments/Edit.vue'
import QuestionsTypesIndex from '../components/cruds/QuestionsTypes/Index.vue'
import QuestionsTypesCreate from '../components/cruds/QuestionsTypes/Create.vue'
import QuestionsTypesShow from '../components/cruds/QuestionsTypes/Show.vue'
import QuestionsTypesEdit from '../components/cruds/QuestionsTypes/Edit.vue'
import AnswersTypesIndex from '../components/cruds/AnswersTypes/Index.vue'
import AnswersTypesCreate from '../components/cruds/AnswersTypes/Create.vue'
import AnswersTypesShow from '../components/cruds/AnswersTypes/Show.vue'
import AnswersTypesEdit from '../components/cruds/AnswersTypes/Edit.vue'
import QuestionsBanksIndex from '../components/cruds/QuestionsBanks/Index.vue'
import QuestionsBanksCreate from '../components/cruds/QuestionsBanks/Create.vue'
import QuestionsBanksShow from '../components/cruds/QuestionsBanks/Show.vue'
import QuestionsBanksEdit from '../components/cruds/QuestionsBanks/Edit.vue'
import QuestionsBanksClone from '../components/cruds/QuestionsBanks/Clone.vue'
import ExamsIndex from '../components/cruds/Exams/Index.vue'
import ExamsCreate from '../components/cruds/Exams/Create.vue'
import ExamsShow from '../components/cruds/Exams/Show.vue'
import ExamsEdit from '../components/cruds/Exams/Edit.vue'
import ExamsClone from '../components/cruds/Exams/Clone.vue'
import UserProfileSettings from '../components/settings/Profile.vue'
import StudentProfileSettings from '../components/settings/StudentProfile.vue'
import ExamSectionsIndex from '../components/cruds/ExamSections/Index.vue'
import ExamSectionsCreate from '../components/cruds/ExamSections/Create.vue'
import ExamSectionsShow from '../components/cruds/ExamSections/Show.vue'
import ExamSectionsEdit from '../components/cruds/ExamSections/Edit.vue'
import ExamSectionSubjectMappingsIndex from '../components/cruds/ExamSectionSubjectMappings/Index.vue'
import ExamSectionSubjectMappingsCreate from '../components/cruds/ExamSectionSubjectMappings/Create.vue'
import ExamSectionSubjectMappingsShow from '../components/cruds/ExamSectionSubjectMappings/Show.vue'
import ExamSectionSubjectMappingsEdit from '../components/cruds/ExamSectionSubjectMappings/Edit.vue'
import PackagesIndex from '../components/cruds/Packages/Index.vue'
import PackagesCreate from '../components/cruds/Packages/Create.vue'
import PackagesShow from '../components/cruds/Packages/Show.vue'
import PackagesEdit from '../components/cruds/Packages/Edit.vue'
import QuestionSetsIndex from '../components/cruds/QuestionSets/Index.vue'
import QuestionSetsCreate from '../components/cruds/QuestionSets/Create.vue'
import QuestionSetsShow from '../components/cruds/QuestionSets/Show.vue'
import QuestionSetsEdit from '../components/cruds/QuestionSets/Edit.vue'
import StudentsIndex from '../components/cruds/Students/Index.vue'
import StudentsCreate from '../components/cruds/Students/Create.vue'
import StudentsShow from '../components/cruds/Students/Show.vue'
import StudentsEdit from '../components/cruds/Students/Edit.vue'
import ExamsListStudents from '../components/cruds/Exams/ListStudents.vue'
import ExamsReviewStudents from '../components/cruds/Exams/ShowReview.vue'
import CommunicationSkillsIndex from '../components/cruds/CommunicationSkills/Index.vue'
import CommunicationSkillsCreate from '../components/cruds/CommunicationSkills/Create.vue'
import CommunicationSkillsShow from '../components/cruds/CommunicationSkills/Show.vue'
import CommunicationSkillsEdit from '../components/cruds/CommunicationSkills/Edit.vue'
import Login from '../components/auth/Login.vue'
import EnablingSkillsIndex from '../components/cruds/EnablingSkills/Index.vue'
import EnablingSkillsCreate from '../components/cruds/EnablingSkills/Create.vue'
import EnablingSkillsShow from '../components/cruds/EnablingSkills/Show.vue'
import EnablingSkillsEdit from '../components/cruds/EnablingSkills/Edit.vue'
import TerminalsIndex from '../components/cruds/Terminals/Index.vue'
import TerminalsCreate from '../components/cruds/Terminals/Create.vue'
import TerminalsShow from '../components/cruds/Terminals/Show.vue'
import TerminalsEdit from '../components/cruds/Terminals/Edit.vue'
import StudentVideos from '../components/student/videos/Index.vue'
import StudentVideosSeen from '../components/student/videos/Seen.vue'
import StudentVideosNotSeen from '../components/student/videos/Notseen.vue'
import StudentDocuments from '../components/student/documents/Index.vue'
import StudentDocumentsSeen from '../components/student/documents/Seen.vue'
import StudentDocumentsNotSeen from '../components/student/documents/Notseen.vue'
import StudentPracticeQuestions from '../components/student/practicequestions/Index.vue'
import StudentTestPracticeQuestions from '../components/student/practicequestions/Questions.vue'
import StudentPracticeQuestionsSeen from '../components/student/practicequestions/Seen.vue'
import StudentPracticeQuestionsSeenSingle from '../components/student/practicequestions/QuestionSeen.vue'
import StudentPracticeQuestionsNotSeen from '../components/student/practicequestions/Notseen.vue'

import ExamHome from '../components/cruds/Exam/Home.vue';
import Headphones from '../components/cruds/Exam/EquipmentCheckHeadphones.vue';
import Microphones from '../components/cruds/Exam/EquipmentCheckMicrophones.vue';
import Keyboard from '../components/cruds/Exam/EquipmentCheckKeyboard.vue';
import ExamInstructions from '../components/cruds/Exam/Instructions.vue';
import ExamIntroduction from '../components/cruds/Exam/Introduction.vue';
import SpeakingIntroduction from '../components/cruds/Exam/SpeakingIntroduction.vue';
import SpeakingQuestions from '../components/cruds/Exam/SpeakingQuestions.vue';
import WritingIntroduction from '../components/cruds/Exam/WritingIntroduction.vue';
import WritingQuestions from '../components/cruds/Exam/WritingQuestions.vue';
import ReadingIntroduction from '../components/cruds/Exam/ReadingIntroduction.vue';
import ReadingQuestions from '../components/cruds/Exam/ReadingQuestions.vue';
import ListeningSSRIntroduction from '../components/cruds/Exam/ListeningSSRIntroduction.vue';
import ListeningSSRQuestions from '../components/cruds/Exam/ListeningSSRQuestions.vue';
import ListeningROLIntroduction from '../components/cruds/Exam/ListeningROLIntroduction.vue';
import ListeningROLQuestions from '../components/cruds/Exam/ListeningROLQuestions.vue';
import OptionalBreak from '../components/cruds/Exam/OptionalBreak.vue';
import EndExam from '../components/cruds/Exam/EndExam.vue';


Vue.use(VueSkeletonLoading);
Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        redirect: '/',
        name: 'Home',
        component: Full,
        children: [
            {
                path: '/home', component: DashboardIndex, name: 'dashboard.admin', meta: {
                    breadcrumb: [
                        {
                            name: 'Home'
                        },
                        {
                            name: 'Welcome to PTE Topper'
                        }
                    ]
                }
            },
            {
                path: '/change-password', component: ChangePassword, name: 'auth.change_password', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Change Password'

                        }
                    ]
                }
            },
            {
                path: '/permissions', component: PermissionsIndex, name: 'permissions.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Permissions', link: '/permissions'

                        }
                    ]
                }
            },
            {
                path: '/permissions/create', component: PermissionsCreate, name: 'permissions.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Permissions', link: '/permissions'

                        }
                    ]
                }
            },
            {
                path: '/permissions/:id', component: PermissionsShow, name: 'permissions.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Permissions', link: '/permissions'

                        }
                    ]
                }
            },
            {
                path: '/permissions/:id/edit', component: PermissionsEdit, name: 'permissions.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Permissions', link: '/permissions'

                        }
                    ]
                }
            },
            {
                path: '/roles', component: RolesIndex, name: 'roles.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Roles', link: '/roles'

                        }
                    ]
                }
            },
            {
                path: '/roles/create', component: RolesCreate, name: 'roles.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Roles', link: '/roles'

                        }
                    ]
                }
            },
            {
                path: '/roles/:id', component: RolesShow, name: 'roles.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Roles', link: '/roles'

                        }
                    ]
                }
            },
            {
                path: '/roles/:id/edit', component: RolesEdit, name: 'roles.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Roles', link: '/roles'

                        }
                    ]
                }
            },
            {
                path: '/users', component: UsersIndex, name: 'users.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Users', link: '/users'

                        }
                    ]
                }
            },
            {
                path: '/users/create', component: UsersCreate, name: 'users.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Users', link: '/users'

                        }
                    ]
                }
            },
            {
                path: '/users/:id', component: UsersShow, name: 'users.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Users', link: '/users'
                        }
                    ]
                }
            },
            {
                path: '/users/:id/edit', component: UsersEdit, name: 'users.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Users', link: '/users'
                        }
                    ]
                }
            },
            {
                path: '/industries', component: IndustriesIndex, name: 'industries.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Products', link: '/industries'
                        }
                    ]
                }
            },
            {
                path: '/industriescard', component: IndustriesCardIndex, name: 'industriescard.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Products',
                            link: '/industries'
                        }
                    ]
                }
            },
            {
                path: '/industries/create', component: IndustriesCreate, name: 'industries.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Products', link: '/industries'
                        }
                    ]
                }
            },
            {
                path: '/industries/:id', component: IndustriesShow, name: 'industries.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Products', link: '/industries'
                        }
                    ]
                }
            },
            {
                path: '/industries/:id/edit', component: IndustriesEdit, name: 'industries.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Products', link: '/industries'
                        }
                    ]
                }
            },
            {
                path: '/courses', component: CoursesIndex, name: 'courses.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Courses', link: '/courses'
                        }
                    ]
                }
            },
            {
                path: '/courses/create', component: CoursesCreate, name: 'courses.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Courses', link: '/courses'
                        }
                    ]
                }
            },
            {
                path: '/courses/:id', component: CoursesShow, name: 'courses.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Courses', link: '/courses'

                        }
                    ]
                }
            },
            {
                path: '/courses/:id/edit', component: CoursesEdit, name: 'courses.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Courses', link: '/courses'
                        }
                    ]
                }
            },
            {
                path: '/subjects', component: SubjectsIndex, name: 'subjects.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Subjects', link: '/subjects'
                        }
                    ]
                }
            },
            {
                path: '/subjects/create', component: SubjectsCreate, name: 'subjects.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Subjects', link: '/subjects'
                        }
                    ]
                }
            },
            {
                path: '/subjects/:id', component: SubjectsShow, name: 'subjects.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Subjects', link: '/subjects'
                        }
                    ]
                }
            },
            {
                path: '/subjects/:id/edit', component: SubjectsEdit, name: 'subjects.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Subjects', link: '/subjects'
                        }
                    ]
                }
            },
            {
                path: '/chapters', component: ChaptersIndex, name: 'chapters.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Chapters', link: '/chapters'
                        }
                    ]
                }
            },
            {
                path: '/chapters/create', component: ChaptersCreate, name: 'chapters.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Chapters', link: '/chapters'
                        }
                    ]
                }
            },
            {
                path: '/chapters/:id', component: ChaptersShow, name: 'chapters.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Chapters', link: '/chapters'
                        }
                    ]
                }
            },
            {
                path: '/chapters/:id/edit', component: ChaptersEdit, name: 'chapters.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Chapters', link: '/chapters'
                        }
                    ]
                }
            },
            {
                path: '/topics', component: TopicsIndex, name: 'topics.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Topics', link: '/topics'
                        }
                    ]
                }
            },
            {
                path: '/topics/create', component: TopicsCreate, name: 'topics.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Topics', link: '/topics'
                        }
                    ]
                }
            },
            {
                path: '/topics/:id', component: TopicsShow, name: 'topics.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Topics', link: '/topics'
                        }
                    ]
                }
            },
            {
                path: '/topics/:id/edit', component: TopicsEdit, name: 'topics.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Topics', link: '/topics'
                        }
                    ]
                }
            },
            {
                path: '/skills', component: SkillsIndex, name: 'skills.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Skills', link: '/skills'
                        }
                    ]
                }
            },
            {
                path: '/skills/create', component: SkillsCreate, name: 'skills.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Skills', link: '/skills'
                        }
                    ]
                }
            },
            {
                path: '/skills/:id', component: SkillsShow, name: 'skills.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Skills', link: '/skills'
                        }
                    ]
                }
            },
            {
                path: '/skills/:id/edit', component: SkillsEdit, name: 'skills.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Skills', link: '/skills'
                        }
                    ]
                }
            },
            // {
            //     path: '/question-types', component: QuestionTypesIndex, name: 'questions_types.index',
            //     meta: {
            //         breadcrumb: [
            //             {
            //                 name: 'Home', link: '/home'
            //             },
            //             {
            //                 name: 'Question Types', link: '/question-types',
            //                 extra: 'is simply dummy text of the printing'
            //             }
            //         ]
            //     }
            // },
            // {
            //     path: '/question-types/create', component: QuestionTypesCreate, name: 'questions_types.create',
            //     meta: {
            //         breadcrumb: [
            //             {
            //                 name: 'Home', link: '/'
            //             },
            //             {
            //                 name: 'Question Types', link: '/question-types',
            //                 extra: 'is simply dummy text of the printing'
            //             }
            //         ]
            //     }
            // },
            // {
            //     path: '/question-types/:id', component: QuestionTypesShow, name: 'questions_types.show',
            //     meta: {
            //         breadcrumb: [
            //             {
            //                 name: 'Home', link: '/'
            //             },
            //             {
            //                 name: 'Question Types', link: '/question-types',
            //                 extra: 'is simply dummy text of the printing'
            //             }
            //         ]
            //     }
            // },
            // {
            //     path: '/question-types/:id/edit', component: QuestionTypesEdit, name: 'questions_types.edit',
            //     meta: {
            //         breadcrumb: [
            //             {
            //                 name: 'Home', link: '/home'
            //             },
            //             {
            //                 name: 'Question Types', link: '/question-types',
            //                 extra: 'is simply dummy text of the printing'
            //             }
            //         ]
            //     }
            // },
            {
                path: '/modules', component: ModulesIndex, name: 'modules.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Modules', link: '/modules'
                        }
                    ]
                }
            },
            {
                path: '/modules/create', component: ModulesCreate, name: 'modules.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Modules', link: '/modules'
                        }
                    ]
                }
            },
            {
                path: '/modules/:id', component: ModulesShow, name: 'modules.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Modules', link: '/modules'
                        }
                    ]
                }
            },
            {
                path: '/modules/:id/edit', component: ModulesEdit, name: 'modules.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Modules', link: '/modules'
                        }
                    ]
                }
            },
            {
                path: '/learning-materials', component: LearningMaterialsIndex, name: 'learning_materials.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Learning Materials ', link: '/learning-materials'
                        }
                    ]
                }
            },
            {
                path: '/learning-materials/create', component: LearningMaterialsCreate, name: 'learning_materials.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Learning Materials', link: '/learning-materials'
                        }
                    ]
                }
            },
            {
                path: '/learning-materials/:id', component: LearningMaterialsShow, name: 'learning_materials.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Learning Materials', link: '/learning-materials'
                        }
                    ]
                }
            },
            {
                path: '/learning-materials/:id/edit', component: LearningMaterialsEdit, name: 'learning_materials.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Learning Materials', link: '/learning-materials'
                        }
                    ]
                }
            },
            {
                path: '/learning-material-documents', component: LearningMaterialDocumentsIndex, name: 'learning_material_documents.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Learning Material Documents', link: '/learning-material-documents'
                        }
                    ]
                }
            },
            {
                path: '/learning-material-documents/create', component: LearningMaterialDocumentsCreate, name: 'learning_material_documents.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Learning Material Documents', link: '/learning-material-documents'
                        }
                    ]
                }
            },
            {
                path: '/learning-material-documents/:id', component: LearningMaterialDocumentsShow, name: 'learning_material_documents.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Learning Material Documents', link: '/learning-material-documents'
                        }
                    ]
                }
            },
            {
                path: '/learning-material-documents/:id/edit', component: LearningMaterialDocumentsEdit, name: 'learning_material_documents.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Learning Material Documents', link: '/learning-material-documents'
                        }
                    ]
                }
            },
            {
                path: '/questions-types', component: QuestionsTypesIndex, name: 'questions_types.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Questions Types', link: '/questions-types'
                        }
                    ]
                }
            },
            {
                path: '/questions-types/create', component: QuestionsTypesCreate, name: 'questions_types.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Questions Types', link: '/questions-types'
                        }
                    ]
                }
            },
            {
                path: '/questions-types/:id', component: QuestionsTypesShow, name: 'questions_types.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Questions Types', link: '/questions-types'
                        }
                    ]
                }
            },
            {
                path: '/questions-types/:id/edit', component: QuestionsTypesEdit, name: 'questions_types.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Questions Types', link: '/questions-types'
                        }
                    ]
                }
            },
            {
                path: '/answers-types', component: AnswersTypesIndex, name: 'answers_types.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Answers Types', link: '/answers-types'
                        }
                    ]
                }
            },
            {
                path: '/answers-types/create', component: AnswersTypesCreate, name: 'answers_types.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Answers Types', link: '/answers-types'
                        }
                    ]
                }
            },
            {
                path: '/answers-types/:id', component: AnswersTypesShow, name: 'answers_types.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Answers Types', link: '/answers-types'
                        }
                    ]
                }
            },
            {
                path: '/answers-types/:id/edit', component: AnswersTypesEdit, name: 'answers_types.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Answers Types', link: '/answers-types'
                        }
                    ]
                }
            },
            {
                path: '/questions-banks', component: QuestionsBanksIndex, name: 'questions_banks.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Questions', link: '/questions-banks'
                        }
                    ]
                }
            },
            {
                path: '/questions-banks/create', component: QuestionsBanksCreate, name: 'questions_banks.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Questions', link: '/questions-banks'
                        }
                    ]
                }
            },
            {
                path: '/questions-banks/:id', component: QuestionsBanksShow, name: 'questions_banks.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Questions', link: '/questions-banks'
                        }
                    ]
                }
            },
            {
                path: '/questions-banks/:id/edit', component: QuestionsBanksEdit, name: 'questions_banks.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Questions', link: '/questions-banks'
                        }
                    ]
                }
            },
            {
                path: '/questions-banks/:id/clone', component: QuestionsBanksClone, name: 'questions_banks.clone',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Questions', link: '/questions-banks'
                        }
                    ]
                }
            },
            {
                path: '/exams', component: ExamsIndex, name: 'exams.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Exams', link: '/exams'
                        }
                    ]
                }
            },
            {
                path: '/exams/create', component: ExamsCreate, name: 'exams.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Exams', link: '/exams'
                        }
                    ]
                }
            },
            {
                path: '/exams/:id', component: ExamsShow, name: 'exams.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Exams', link: '/exams'
                        }
                    ]
                }
            },
            {
                path: '/exams/:id/students', component: ExamsListStudents, name: 'exams.showstudents',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Exams', link: '/exams'
                        }
                    ]
                }
            },
            {
                path: '/exams/:exam_id/students/:id/review', component: ExamsReviewStudents, name: 'exams.review',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Exams', link: '/exams'
                        }
                    ]
                }
            },
            {
                path: '/exams/:id/edit', component: ExamsEdit, name: 'exams.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Exams', link: '/exams'
                        }
                    ]
                }
            },
            {
                path: '/exams/:id/clone', component: ExamsClone, name: 'exams.clone',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Exams', link: '/exams'
                        }
                    ]
                }
            },
            {
                path: '/profile', component: UserProfileSettings, name: 'profile', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'User Profile'
                        }
                    ]
                }
            },
            { path: '/exam-sections', component: ExamSectionsIndex, name: 'exam_sections.index' },
            { path: '/exam-sections/create', component: ExamSectionsCreate, name: 'exam_sections.create' },
            { path: '/exam-sections/:id', component: ExamSectionsShow, name: 'exam_sections.show' },
            { path: '/exam-sections/:id/edit', component: ExamSectionsEdit, name: 'exam_sections.edit' },
            { path: '/exam-section-subject-mappings', component: ExamSectionSubjectMappingsIndex, name: 'exam_section_subject_mappings.index' },
            { path: '/exam-section-subject-mappings/create', component: ExamSectionSubjectMappingsCreate, name: 'exam_section_subject_mappings.create' },
            { path: '/exam-section-subject-mappings/:id', component: ExamSectionSubjectMappingsShow, name: 'exam_section_subject_mappings.show' },
            { path: '/exam-section-subject-mappings/:id/edit', component: ExamSectionSubjectMappingsEdit, name: 'exam_section_subject_mappings.edit' },
            {
                path: '/question-sets', component: QuestionSetsIndex, name: 'question_sets.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Question Sets', link: '/question-sets'
                        }
                    ]
                }
            },
            {
                path: '/question-sets/create', component: QuestionSetsCreate, name: 'question_sets.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Question Sets', link: '/question-sets'
                        }
                    ]
                }
            },
            {
                path: '/question-sets/:id', component: QuestionSetsShow, name: 'question_sets.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Question Sets', link: '/question-sets'
                        }
                    ]
                }
            },
            {
                path: '/question-sets/:id/edit', component: QuestionSetsEdit, name: 'question_sets.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Question Sets', link: '/question-sets'
                        }
                    ]
                }
            },
            {
                path: '/packages', component: PackagesIndex, name: 'packages.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Packages', link: '/packages'
                        }
                    ]
                }
            },
            {
                path: '/packages/create', component: PackagesCreate, name: 'packages.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Packages', link: '/packages'
                        }
                    ]
                }
            },
            {
                path: '/packages/:id', component: PackagesShow, name: 'packages.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Packages', link: '/packages'
                        }
                    ]
                }
            },
            {
                path: '/packages/:id/edit', component: PackagesEdit, name: 'packages.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Packages', link: '/packages'
                        }
                    ]
                }
            },
            {
                path: '/enabling-skills', component: EnablingSkillsIndex, name: 'enabling_skills.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Enabling Skills', link: '/enabling-skills'
                        }
                    ]
                }
            },
            {
                path: '/enabling-skills/create', component: EnablingSkillsCreate, name: 'enabling_skills.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Enabling Skills', link: '/enabling-skills'
                        }
                    ]
                }
            },
            {
                path: '/enabling-skills/:id', component: EnablingSkillsShow, name: 'enabling_skills.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Enabling Skills', link: '/enabling-skills'
                        }
                    ]
                }
            },
            {
                path: '/enabling-skills/:id/edit', component: EnablingSkillsEdit, name: 'enabling_skills.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Enabling Skills', link: '/enabling-skills'
                        }
                    ]
                }
            },
            {
                path: '/students', component: StudentsIndex, name: 'students.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Students', link: '/students'
                        }
                    ]
                }
            },
            {
                path: '/students/create', component: StudentsCreate, name: 'students.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Students', link: '/students'
                        }
                    ]
                }
            },
            {
                path: '/students/:id', component: StudentsShow, name: 'students.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Students', link: '/students'
                        }
                    ]
                }
            },
            {
                path: '/students/:id/edit', component: StudentsEdit, name: 'students.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Students', link: '/students'
                        }
                    ]
                }
            },
            {
                path: '/communication-skills', component: CommunicationSkillsIndex, name: 'communication_skills.index',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Communication Skills', link: '/communication-skills'
                        }
                    ]
                }
            },
            {
                path: '/communication-skills/create', component: CommunicationSkillsCreate, name: 'communication_skills.create',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Communication Skills', link: '/communication-skills'
                        }
                    ]
                }
            },
            {
                path: '/communication-skills/:id', component: CommunicationSkillsShow, name: 'communication_skills.show',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Communication Skills', link: '/communication-skills'
                        }
                    ]
                }
            },
            {
                path: '/communication-skills/:id/edit', component: CommunicationSkillsEdit, name: 'communication_skills.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Communication Skills', link: '/communication-skills'
                        }
                    ]
                }
            },
            {
                path: '/terminals', component: TerminalsIndex, name: 'terminals.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Terminals', link: '/terminals'
                        }
                    ]
                }
            },
            {
                path: '/terminals/create', component: TerminalsCreate, name: 'terminals.create', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Terminals', link: '/terminals'
                        }
                    ]
                }
            },
            {
                path: '/terminals/:id', component: TerminalsShow, name: 'terminals.show', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Terminals', link: '/terminals'
                        }
                    ]
                }
            },
            {
                path: '/terminals/:id/edit', component: TerminalsEdit, name: 'terminals.edit',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/home'
                        },
                        {
                            name: 'Terminals', link: '/terminals'
                        }
                    ]
                }
            }

        ]
    },
    {
        path: '/dashboard',
        redirect: '/',
        name: 'Dashboard',
        component: StudentDashboard,
        children: [
            {
                path: '/me', component: StudentProfileSettings, name: 'student.profile', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Profile'
                        }
                    ]
                }
            },
            {
                path: '/changepassword', component: ChangePassword, name: 'student.change_password', meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/'
                        },
                        {
                            name: 'Change Password'

                        }
                    ]
                }
            },
            {
                path: '/dashboard', component: DashboardIndex, name: 'dashboard.index', meta: {
                    breadcrumb: [
                        {
                            name: 'Dashboard',
                            link: '/dashboard'
                        }
                    ]
                }
            },
            {
                path: '/videos/', component: StudentVideos, name: 'student.videos',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Video Tutorials', link: '/videos'
                        }
                    ]
                }
            },
            {
                path: '/videos/seen', component: StudentVideosSeen, name: 'student.videos.seen',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Video Tutorials', link: '/videos'
                        }
                    ]
                }
            },
            {
                path: '/videos/notseen', component: StudentVideosNotSeen, name: 'student.videos.notseen',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Video Tutorials', link: '/videos'
                        }
                    ]
                }
            },
            {
                path: '/documents/', component: StudentDocuments, name: 'student.documents',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Document Tutorials', link: '/documents'
                        }
                    ]
                }
            },
            {
                path: '/documents/seen', component: StudentDocumentsSeen, name: 'student.documents.seen',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Document Tutorials', link: '/documents'
                        }
                    ]
                }
            },
            {
                path: '/documents/notseen', component: StudentDocumentsNotSeen, name: 'student.documents.notseen',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Document Tutorials', link: '/documents'
                        }
                    ]
                }
            },
            {
                path: '/practicequestions/', component: StudentPracticeQuestions, name: 'student.practicequestions',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Practice Questions', link: '/practicequestions'
                        }
                    ]
                }
            },
            {
                path: '/practicequestions/seen', component: StudentPracticeQuestionsSeen, name: 'student.practicequestions.seen',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Practice Questions', link: '/practicequestions'
                        }
                    ]
                }
            },
            {
                path: '/practicequestions/seen/:id', component: StudentPracticeQuestionsSeenSingle, name: 'student.practicequestions.seenquestion',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Practice Questions', link: '/practicequestions'
                        }
                    ]
                }
            },
            {
                path: '/practicequestions/notseen', component: StudentPracticeQuestionsNotSeen, name: 'student.practicequestions.notseen',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Practice Questions', link: '/documents'
                        }
                    ]
                }
            },
            {
                path: '/practicequestions/:id', component: StudentTestPracticeQuestions, name: 'student.practicequestions.test',
                meta: {
                    breadcrumb: [
                        {
                            name: 'Home', link: '/dashboard'
                        },
                        {
                            name: 'Practice Questions', link: '/practicequestions'
                        }
                    ]
                }
            },

        ]
    },
    {
        path: '/student-exam',
        redirect: '/student-exam',
        name: 'StudentExam',
        component: ExamView,
        children: [
            { path: '/student-exam/equipment-check/headphones', component: Headphones, name: 'headphones' },
            { path: '/student-exam/equipment-check/microphones', component: Microphones, name: 'microphones' },
            { path: '/student-exam/equipment-check/keyboard', component: Keyboard, name: 'keyboard' },
            { path: '/student-exam/home', component: ExamHome, name: 'studentexam.home' },
            { path: '/student-exam/instructions', component: ExamInstructions, name: 'exam.instructions' },
            { path: '/student-exam/introduction', component: ExamIntroduction, name: 'exam.introduction' },
            { path: '/student-exam/speaking', component: SpeakingIntroduction, name: 'exam.speaking' },
            { path: '/student-exam/speaking/questions/:id', component: SpeakingQuestions, name: 'exam.speaking.questions' },
            { path: '/student-exam/writing', component: WritingIntroduction, name: 'exam.writing' },
            { path: '/student-exam/writing/questions/:id', component: WritingQuestions, name: 'exam.writing.questions' },
            { path: '/student-exam/reading', component: ReadingIntroduction, name: 'exam.reading' },
            { path: '/student-exam/reading/questions/:id', component: ReadingQuestions, name: 'exam.reading.questions' },
            { path: '/student-exam/listeningsst', component: ListeningSSRIntroduction, name: 'exam.listeningsst' },
            { path: '/student-exam/listeningsst/questions/:id', component: ListeningSSRQuestions, name: 'exam.listeningsst.questions' },
            { path: '/student-exam/listeningrol', component: ListeningROLIntroduction, name: 'exam.listeningrol' },
            { path: '/student-exam/listeningrol/questions/:id', component: ListeningROLQuestions, name: 'exam.listeningrol.questions' },
            { path: '/student-exam/optionalbreak', component: OptionalBreak, name: 'exam.optionalbreak' },
            { path: '/student-exam/end', component: EndExam, name: 'exam.end' }

        ]
    },
    {
        path: '/login',
        name: 'Login',
        component: Auth,
        children: [
            {
                path: '/login', component: Login, name: 'login'
            },
        ]
    }

]

export default new VueRouter({
    mode: 'history',
    base: '/admin',
    routes,
    linkActiveClass: "cui-menu-left-item-active",
    linkExactActiveClass: "cui-menu-left-item-active",
})
