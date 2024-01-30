<template>
  <div class="w-50">
    <div class="card form-layout">
      <h5 class="card-header">
        Edit User
      </h5>
      <div class="card-body">
        <div class="text-center" v-if="!user && loading">
          <p>
            Loading...
          </p>
        </div>
        <div v-else>
          <user-form :user="user"></user-form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import UserForm from '@/components/main/user/Form'

export default {
  components: {
    UserForm
  },
  data() {
    return {
      user: null,
      loading: false,
    }
  },
  async created() {
    await this.initUser();
  },
  methods: {
    async initUser() {
      try {
        this.loading = true
        const response = await axios.get(`/web-api/user/${this.$route.params.id}`)
        this.user = response.data
      } catch (error) {
        console.error("Error fetching user:", error)
      } finally {
        this.loading = false
      }
    },
  }
}
</script>