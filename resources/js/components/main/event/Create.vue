<template>
  <div class="w-50">
    <div class="card form-layout">
      <h5 class="card-header">
        Create Event
      </h5>
      <div class="card-body">
        <event-form></event-form>
      </div>
    </div>
  </div>
</template>
<script>
import EventForm from '@/components/main/event/Form'

export default {
  components: {
    EventForm
  },
}
</script>

