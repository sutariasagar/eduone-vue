<template>
    <div class="cui-profile-head-card-left">
        <a v-if="image" class="d-block mx-auto mb-2 cui-avatar cui-avatar-90 cui-avatar-bordered cui-avatar-border-white" href="javascript: void(0);">
        <img :src="'/storage/'+image.id+'/'+image.file_name">
        </a>
        <a v-else class="d-block mx-auto mb-2 cui-avatar cui-avatar-90 cui-avatar-bordered cui-avatar-border-white" href="javascript: void(0);">
        <img src="/cleanui/components/dummy-assets/common/img/avatars/1.jpg" alt="Alternative text to the image">
        </a>
        <strong>{{name}}</strong>
        <br>        
    </div>
</template>
<script>
export default {
    data() {
        return {
            // Code...
            
        }
    },
    props: ['image','name'],    
    
    
}
</script>
