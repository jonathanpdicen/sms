<template>
  <div class="w-50">
    <div class="card form-layout">
      <h5 class="card-header">
        Edit Event
      </h5>
      <div class="card-body">
        <div class="text-center" v-if="!event && loading">
          <p>
            Loading...
          </p>
        </div>
        <div v-else>
          <event-form :event="event"></event-form>
        </div>
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
  data() {
    return {
      event: null,
      loading: false,
      courses: [],
    }
  },
  async created() {
    await this.initEvent()
  },
  methods: {
    async initEvent() {
      try {
        this.loading = true
        const response = await axios.get(`/web-api/event/${this.$route.params.id}`)
        this.event = response.data
      } catch (error) {
        console.error("Error fetching event:", error)
      } finally {
        this.loading = false
      }
    },
  }
}
</script>