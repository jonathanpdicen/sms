<template>
  <div class="user-view-page w-75">
    <div class="card form-layout">
      <h5 class="card-header">
        Course Details
      </h5>
      <div class="card-body">
        <div class="text-center" v-if="!event && loading">
          <p>
            Loading...
          </p>
        </div>
        <div v-else>
          <div class="text-center mb-4">
            <div>
              <i class="mdi mdi-calendar-month mdi-48px"/>
              <div>
                <h3 class="font-weight-bold">
                  {{ event.name }}
                </h3>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-center mb-4">
            <div>
              <i class="mdi mdi-book-open"/>
              <span>
                {{ event.course.title }}
              </span>
            </div>
            <div class="vr"></div>
            <div>
              <i class="mdi mdi-account"/>
              <span>
                {{ event.created_by_user.name }}
              </span>
            </div>
            <div class="vr"></div>
            <div>
              <i class="mdi mdi-calendar"/>
              <span>
                {{ event.created_at | local_date }}
              </span>
            </div>
          </div>
          <div class="text-justify mb-4">
            <p>
              {{ event.description }}
            </p>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div>
          <router-link
            tag="a"
            :to="{ name: Routes.event }"
            class="btn btn-outline-secondary"
          >
            <i class="mdi mdi-arrow-left"/>
            Back
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Routes from '@/constants/routes'

export default {
  data() {
    return {
      Routes,
      event: null,
      loading: false,
    }
  },
  async created() {
    await this.initEvent()
  },
  methods: {
    async initEvent() {
      try {
        this.loading = true;
        const response = await axios.get(`/web-api/event/${this.$route.params.id}?include=createdByUser,course`)
        this.event = response.data
      } catch (error) {
        console.error("Error fetching event:", error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>