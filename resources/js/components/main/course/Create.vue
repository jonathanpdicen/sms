<template>
  <div class="w-50">
    <div class="card form-layout">
      <h5 class="card-header">
        Create Course
      </h5>
      <div class="card-body">
        <course-form></course-form>
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
}
</script>