<template>
    <div class="card" data-order-id="card-11">   
        <FullCalendar defaultView="dayGridMonth" :plugins="calendarPlugins" :events="[
    { title: 'event 1', date: '2019-04-01' },
    { title: 'event 2', date: '2019-04-02' }
  ]"/>     
    </div>
</template>
<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data() {
        return {
        calendarPlugins: [ dayGridPlugin ]
        }
    }
    
}
</script>

