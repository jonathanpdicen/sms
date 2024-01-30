<template>
  <div>
    <form @submit.prevent="onSubmit">
      <div class="form-group">
        <label>Course</label>
        <select
          v-model="form.course_id"
          class="form-control"
        >
          <option
            v-for="course in courses"
            :value="course.id"
          >
            {{ course.title }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <label>
          Name
        </label>
        <input
          v-model="form.name"
          type="text"
          class="form-control"
        >
      </div>
      <div class="form-group">
        <label>
          Description
        </label>
        <textarea
          v-model="form.description"
          class="form-control"
          rows="3"
        >
        </textarea>
      </div>
      <div class="mt-4 d-flex justify-content-between">
        <div>
          <small
            v-if="showMessage"
            class="text-success fade-out"
          >
            <i class="mdi mdi-check-circle"/>
            Success!
          </small>
        </div>
        <div>
          <router-link
            tag="a"
            :to="{ name: Routes.event }"
            class="btn btn-outline-secondary mr-2"
          >
            <i class="mdi mdi-arrow-left"/>
            Cancel
          </router-link>
          <button
            type="submit"
            class="btn btn-primary"
          >
            Create
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import Routes from '@/constants/routes'
import { Form } from '@/forms/form.js'

export default {
  props: {
    event: {
      type: Object,
    }
  },
  data() {
    return {
      Routes,
      form: new Form({
        name: '',
        description: '',
        course_id: null
      }),
      courses: [],
      showMessage: false,
    }
  },
  async created() {
    if (this.event) {
      _.extend(
        this.form,
        _.pick(
          _.cloneDeep(this.event),
          [
            'id',
            'name',
            'description',
            'course_id'
          ]
        )
      )
    }
    await this.initCourses()
  },
  methods: {
    async initCourses() {
      try {
        const response = await axios.get('/web-api/course')
        this.courses = response.data.data
      } catch (error) {
        console.error(error)
      }
    },
    onSubmit() {
      if (this.event) {
        this.form.put(`/web-api/event/${this.$route.params.id}`)
          .then(() => {
            this.showMessage = true
            this.fadeMessage()
          })
      } else {
        this.form.post('/web-api/event')
          .then(() => {
            this.showMessage = true
            this.fadeMessage()
            this.form.reset()
          })
          .catch(error => console.log(error))
      }
    },
    fadeMessage() {
      setTimeout(() => {
        this.showMessage = false
      }, 1000)
    }
  }
}
</script>