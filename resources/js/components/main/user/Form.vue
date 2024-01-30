<template>
  <div>
    <form @submit.prevent="onSubmit">
      <div class="form-group">
        <label>
          Full Name
        </label>
        <input
          v-model="form.name"
          type="text"
          class="form-control"
          :class="{ 'border-danger' : form.errors.has('name') }"
        >
      </div>
      <div class="form-group">
        <label>
          Email address
        </label>
        <input
          v-model="form.email"
          type="email"
          class="form-control"
          :class="{ 'border-danger' : form.errors.has('email') }"
        >
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
            :to="{ name: Routes.user }"
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
    user: {
      type: Object,
    }
  },
  data() {
    return {
      Routes,
      form: new Form({
        name: '',
        email: '',
      }),
      showMessage: false,
    }
  },
  async created() {
    if (this.user) {
      _.extend(
        this.form,
        _.pick(
          _.cloneDeep(this.user),
          [
            'id',
            'name',
            'email'
          ]
        )
      )
    }
  },
  methods: {
    onSubmit() {
      if (this.user) {
        this.form.put(`/web-api/user/${this.$route.params.id}`)
          .then(() => {
            this.showMessage = true
            this.fadeMessage()
          })
      } else {
        this.form.post('/web-api/user')
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