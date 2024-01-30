<template>
  <div class="w-100">
    <div class="d-flex justify-content-end mb-3">
      <div>
        <router-link
          tag="a"
          :to="{ name: Routes.create_course }"
          class="btn btn-primary"
        >
          <i class="mdi mdi-plus"/>
          Add Course
        </router-link>
      </div>
    </div>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Created By</th>
            <th>Date Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="course in courses"
            :key="course.id"
          >
            <td>{{ course.id }}</td>
            <td class="text-truncate truncated-col">{{ course.title }}</td>
            <td class="text-truncate truncated-col">{{ course.description }}</td>
            <td>{{ course.created_by_user.name }}</td>
            <td>{{ course.created_at | local_date }}</td>
            <td class="action-col">
              <button
                type="submit"
                class="btn btn-outline-secondary btn-sm"
                @click="viewCourse(course)"
              >
                View
              </button>
              <button
                type="submit"
                class="btn btn-outline-primary btn-sm"
                @click="editCourse(course)"
              >
                Edit
              </button>
              <button
                type="submit"
                class="btn btn-outline-danger btn-sm"
                @click="deleteCourse(course)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-if="!courses.length" class="text-center">
        No Data.
      </div>
    </div>
  </div>
</template>
<script>
import Routes from "@/constants/routes";

export default {
  data() {
    return {
      Routes,
      courses: []
    }
  },
  async created() {
    await this.initCourses()
  },
  methods: {
    async initCourses() {
      try {
        const response = await axios.get('/web-api/course?include=createdByUser');
        this.courses = response.data.data;
      } catch (error) {
        console.error(error);
      }
    },
    viewCourse(course) {
      this.$router.push({
        name: Routes.view_course,
        params: {
          id: course.id,
        },
      })
    },
    editCourse(course) {
      this.$router.push({
        name: Routes.edit_course,
        params: {
          id: course.id,
        },
      })
    },
    deleteCourse(course) {
      const isConfirmed = confirm("Are you sure you want to delete this user?");

      if (!isConfirmed) {
        return
      }

      axios.delete(`/web-api/course/${course.id}`)
        .then(() => {
          this.initCourses()
        })
    }
  }
}
</script>