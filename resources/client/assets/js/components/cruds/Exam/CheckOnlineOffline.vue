<template>
  <!-- @detected-condition fires when the connectivity status of the device changes -->
  <v-offline
  online-class="online"
  offline-class="offline"
  @detected-condition="amIOnline">
  <template v-slot:[onlineSlot] :slot-name="onlineSlot">    
    <a href="#" v-if="onLine"><i class="fa fa-circle text-success"></i> Online</a>
    <a href="#" v-else class="text-danger"><i class="fa fa-circle text-danger"></i> Offline</a>
  </template>
  <template v-slot:[offlineSlot] :slot-name="offlineSlot">
    <a href="#" v-if="onLine"><i class="fa fa-circle text-success"></i> Online</a>
    <a href="#" v-else class="text-danger"><i class="fa fa-circle text-danger"></i> Offline</a>
  </template>
</v-offline>
</template>

<script>
import VOffline from 'v-offline';


export default {
  components: {
    VOffline
  },
  data: () => ({
    onLine: true,
    onlineSlot: 'online',
    offlineSlot: 'offline',
  }),
  props:['id'],
   watch: {
        
    },
    mounted(){
      console.log("yes its");
    },

  methods: {
    amIOnline(e) {
      this.onLine = e;
    },
  }
}
</script>