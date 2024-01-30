<template>
  <div class="w-100">
    <div class="d-flex justify-content-end mb-3">
      <div>
        <router-link
          tag="a"
          :to="{ name: Routes.create_user }"
          class="btn btn-primary"
        >
          <i class="mdi mdi-plus"/>
          Add User
        </router-link>
      </div>
    </div>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="user in users"
            :key="user.id"
          >
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.created_at | local_date }}</td>
            <td class="action-col">
              <button
                type="submit"
                class="btn btn-outline-secondary btn-sm"
                @click="viewUser(user)"
              >
                View
              </button>
              <button
                type="submit"
                class="btn btn-outline-primary btn-sm"
                @click="editUser(user)"
              >
                Edit
              </button>
              <button
                type="submit"
                class="btn btn-outline-danger btn-sm"
                @click="deleteUser(user)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import Routes from "@/constants/routes";

export default {
  data() {
    return {
      Routes,
      users: []
    }
  },
  async created() {
    await this.initUsers()
  },
  methods: {
    async initUsers() {
      try {
        const response = await axios.get('/web-api/user');
        this.users = response.data.data;
      } catch (error) {
        console.error(error);
      }
    },
    viewUser(user) {
      this.$router.push({
        name: Routes.view_user,
        params: {
          id: user.id,
        },
      })
    },
    editUser(user) {
      this.$router.push({
        name: Routes.edit_user,
        params: {
          id: user.id,
        },
      })
    },
    deleteUser(user) {
      const isConfirmed = confirm("Are you sure you want to delete this user?");

      if (!isConfirmed) {
        return
      }

      axios.delete(`/web-api/user/${user.id}`)
        .then(() => {
          this.initUsers()
        })
    }
  }
}
</script>