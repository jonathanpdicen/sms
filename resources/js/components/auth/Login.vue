<template>
  <div>
    <div class="wrapper-page">
      <div>
        <h2>
          <span>SMS</span> Account Login
        </h2>
        <p>
          Welcome back! Provide your login details below.
        </p>
      </div>
      <div class="form-inner-wrapper">
        <form @submit.prevent="onLogin">
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
              Login
            </button>
          </div>
        </form>
        <div class="my-4 text-center">
          <router-link
            :to="{ name: Routes.register }"
            tag="a"
          >
            Create an account
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
        email: '',
        password: ''
      })
    }
  },
  methods: {
    onLogin() {
      this.form.post('/login')
        .then(() => {
          location.href = '/dashboard';
        })
        .catch(errro => console.log(errro))
        
    }
  }
}
</script>
