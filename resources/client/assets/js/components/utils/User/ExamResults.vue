<template>
    <div class="card" data-order-id="card-4">
        <div class="card-header ui-sortable-handle">
          <div class="pull-right cui-utils-sortable-control">
            
          </div>
          <h6 class="card-header text-uppercase bg-white font-weight-bold">{{heading}}</h6>          
          <!-- <div class="cui-utils-title-description">Block with important Task Table information</div> -->
        </div>
        <div class="card-body">
          <table class="table mb-0" v-if="exams && exams.length > 0">
            <thead>
              <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">Date and Time</th>
                <th class="border-top-0">Action</th>                
              </tr>
            </thead>
            <tbody>
              <tr v-for="(exam, index) in exams" v-bind:key="index">
                <th scope="row">
                  <p>{{index + 1 }}</p>
                </th>
                <td>
                  <p>{{exam.pivot.created_at}}</p>
                </td>                
                <td>
                  <!-- <button class="btn bg-theme text-white cstbtnradius">Download Report</button> -->
                  <p v-if="exam.pivot.result">
                    <a :href="'/storage/scores/'+exam.id+'/'+studentid+'/result.pdf'" target="_blank" class="btn bg-theme text-white cstbtnradius">Download Report</a>
                  </p>
                  <p v-else>
                    <span class="btn bg-theme text-white cstbtnradius">Result Pending</span>
                  </p>
                </td>                
              </tr>              
            </tbody>
          </table>
          <h6 v-else>
            No Exams Found
          </h6>
        </div>
      </div>
</template>
<script>
export default {
    data() {
        return {
            // Code...
            
        }
    },
    props: ['exams','studentid','heading'],
    
    
}
</script>
