<template>
  <div>
    <form @submit.prevent="onSubmit">
      <div class="form-group">
        <label>
          Title
        </label>
        <input
          v-model="form.title"
          type="text"
          class="form-control"
          :class="{ 'border-danger' : form.errors.has('title') }"
        >
      </div>
      <div class="form-group">
        <label>
          Description
        </label>
        <textarea
          v-model="form.description"
          class="form-control"
          :class="{ 'border-danger' : form.errors.has('description') }"
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
            :to="{ name: Routes.course }"
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
    course: {
      type: Object,
    }
  },
  data() {
    return {
      Routes,
      form: new Form({
        title: '',
        description: '',
      }),
      showMessage: false,
    }
  },
  async created() {
    if (this.course) {
      _.extend(
        this.form,
        _.pick(
          _.cloneDeep(this.course),
          [
            'id',
            'title',
            'description'
          ]
        )
      )
    }
  },
  methods: {
    onSubmit() {
      if (this.course) {
        this.form.put(`/web-api/course/${this.$route.params.id}`)
          .then(() => {
            this.showMessage = true
            this.fadeMessage()
          })
      } else {
        this.form.post('/web-api/course')
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