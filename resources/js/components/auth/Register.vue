<template>
  <div>
    <div class="wrapper-page">
      <div>
        <h2>
          Create a <span>SMS</span> Account
        </h2>
        <p>
          All the details below are required.
        </p>
      </div>
      <div class="form-inner-wrapper">
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
          <div class="form-group">
            <label>
              Password
            </label>
            <input
              v-model="form.password"
              type="password"
              class="form-control"
              :class="{ 'border-danger' : form.errors.has('password') }"
            >
          </div>
          <div class="mt-4">
            <button
              type="submit"
              class="btn btn-primary w-100"
            >
              Signup
            </button>
          </div>
        </form>
        <div class="my-4 text-center">
          <router-link
            :to="{ name: Routes.login }"
            tag="a"
          >
            Login to your account
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Routes from "@/constants/routes";
import { Form } from '../../forms/form.js';

export default {
  data() {
    return {
      Routes,
      form: new Form({
        name: '',
        email: '',
        password: ''
      })
    }
  },
  methods: {
    onSubmit() {
      this.form.post('/register')
        .then(() => {
          this.$router.push({
            name: Routes.login
          })
        })
        .catch(errro => console.log(errro))
        
    }
  }
}
</script>
  