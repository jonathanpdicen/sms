<template>
  <div class="w-50">
    <div class="card form-layout">
      <h5 class="card-header">
        Edit User
      </h5>
      <div class="card-body">
        <div class="text-center" v-if="!course && loading">
          <p>
            Loading...
          </p>
        </div>
        <div v-else>
          <course-form :course="course"></course-form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CourseForm from '@/components/main/course/Form'

export default {
  components: {
    CourseForm
  },
  data() {
    return {
      course: null,
      loading: false,
    }
  },
  async created() {
    await this.initCourse();
  },
  methods: {
    async initCourse() {
      try {
        this.loading = true
        const response = await axios.get(`/web-api/course/${this.$route.params.id}`)
        this.course = response.data
      } catch (error) {
        console.error("Error fetching user:", error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>