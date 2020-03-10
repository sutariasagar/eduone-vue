<template>
    <div class="card" data-order-id="card-11">
        <div class="card-header ui-sortable-handle">
        <div class="pull-right cui-utils-sortable-control">
            
        </div>
        <!-- <div class="cui-utils-title"><strong>Exam Performance:</strong></div>         -->
        </div>
        <div class="card-body">
        <div class="chart-overlapping-bar chartist">
            <div class="chartist-tooltip"></div>
                <apexchart width="100%" height="430" type="line" :options="options" :series="series" v-if="!loading"></apexchart>
        </div>
        </div>
    </div>
</template>
<script>
import VueApexCharts from 'vue-apexcharts'
import Vue from 'vue';
Vue.component('apexchart', VueApexCharts)

export default {
    props: ['exams_with_results'],
    data() {
            return {
                options: {                    
                    chart: {                                                
                        height: 380,
                        type: 'line',
                        shadow: {
                            enabled: true,
                            color: '#000',
                            top: 18,
                            left: 7,
                            blur: 10,
                            opacity: 1
                        },
                        toolbar: {
                            show: false
                        }
                    },                    
                    dataLabels: {
                        enabled: true,
                    },
                    stroke: {
                        curve: 'smooth'
                    },                    
                    title: {
                        text: 'Exam wise performance',
                        align: 'left'
                    },
                    grid: {
                        borderColor: '#e7e7e7',
                        row: {
                            colors: ['#f3f3f3'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                    markers: {                        
                        size: 6
                    },
                    xaxis: {                        
                        title: {
                            text: 'Exam'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Score'
                        },
                        min: 10,
                        max: 90
                    },
                    legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            floating: true,
                            offsetY: -25,
                            offsetX: -5
                        }
                },   
                series: [],             
                loading: true,
                averageScore: 0                
            }            
        },

    mounted(){       

        let tempCategory = [];
        let tempScore = [];
        let averageScore = 0;
        let count = 0;
        this.loading = true
        let vm = this;        
            this.exams_with_results.forEach(result => {     
                let data = []                           
                let examResult = JSON.parse(result.pivot.result)                
                for(let skill in examResult.communicative_skills){
                    let skillData = {}
                    skillData.x = skill
                    skillData.y = examResult.communicative_skills[skill].skill_score
                    data.push(skillData)                    
                }
                for(let skill in examResult.enabling_skills){
                    let skillData = {}
                    skillData.x = skill
                    skillData.y = examResult.enabling_skills[skill].skill_score
                    data.push(skillData)                    
                }
                let tempObj = {}
                tempObj.data = data;
                tempObj.name = "Exam on "+ (result.pivot.created_at)
                vm.series.push(tempObj)                
                count++;
                //this.score.push(JSON.parse(result.pivot.result).overall_communicative_skills)
            });    
            console.log(vm.series)        
            //this.options.xaxis.categories = tempCategory            
            this.loading = false
                
    }
}
</script>

