<template>
    <div class="card" data-order-id="card-11">
        <div class="card-header ui-sortable-handle">
        <div class="pull-right cui-utils-sortable-control">
            
        </div>
        <div class="cui-utils-title"><strong>Mock Tests Performace: Average Result: {{averageScore}}</strong></div>        
        </div>
        <div class="card-body">
        <div class="chart-overlapping-bar chartist">
            <div class="chartist-tooltip"></div>
                <apexchart width="100%" height="330" type="bar" :options="options" :series="series" v-if="!loading"></apexchart>
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
                        id: 'vuechart-example',
                        height: 1380
                    },
                    xaxis: {
                        //categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                        categories: []
                    },
                    yaxis:{
                        min:10,
                        max:90
                    },                    
                    
                },
                series: [{
                    name: 'series-1',
                    //data: [30, 40, 45, 50, 49, 60, 70, 91]
                    data: []
                }],
                loading: true,
                averageScore: 0                
            }            
        },

    mounted(){       

        let tempCategory = [];
        let tempScore = [];
        let averageScore = 0;
        let count = 0;
            this.exams_with_results.forEach(result => {
                
                tempCategory.push(result.pivot.created_at)
                tempScore.push(JSON.parse(result.pivot.result).overall_communicative_skills)
                averageScore+= JSON.parse(result.pivot.result).overall_communicative_skills
                count++;
                //this.score.push(JSON.parse(result.pivot.result).overall_communicative_skills)
            });
            this.options.xaxis.categories = tempCategory
            this.series[0].data = tempScore
            this.series[0].name = "Overall Score"            
            this.loading = false
            this.averageScore = averageScore/count;
        // this.exams_with_results.forEach(result => {
        //     this.categories.push(result.pivot.created_at)
        //     this.score.push(JSON.parse(result.pivot.result).overall_communicative_skills)
        // });
    }
}
</script>

