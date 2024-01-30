<template>
  <div class="user-view-page w-50">
    <div class="card form-layout">
      <h5 class="card-header">
        User Details
      </h5>
      <div class="card-body">
        <div class="text-center" v-if="!user && loading">
          <p>
            Loading...
          </p>
        </div>
        <div v-else>
          <div class="d-flex justify-content-center mb-4">
            <div>
              <div class="avatar mx-auto mb-4">
                {{ user.name | initial }}
              </div>
              <div>
                <h3 class="font-weight-bold">
                  {{ user.name }}
                </h3>
              </div>
            </div>
          </div>
          <div class="text-center mb-4">
            <label>
              Email Address
            </label>
            <h5>
              {{ user.email }}
            </h5>
          </div>
          <div class="text-center">
            <label>
              Date Created
            </label>
            <h5>
              {{ user.created_at | local_date }}
            </h5>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div>
          <router-link
            tag="a"
            :to="{ name: Routes.user }"
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
import Routes from "@/constants/routes";

export default {
  data() {
    return {
      Routes,
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
        this.loading = true;
        const response = await axios.get(`/web-api/user/${this.$route.params.id}`);
        this.user = response.data;
      } catch (error) {
        console.error("Error fetching user:", error);
      } finally {
        this.loading = false;
      }
    }
  }
}
</script>