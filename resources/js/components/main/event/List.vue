<template>
  <div class="w-100">
    <div class="d-flex justify-content-end mb-3">
      <div>
        <router-link
          tag="a"
          :to="{ name: Routes.create_event }"
          class="btn btn-primary"
        >
          <i class="mdi mdi-plus"/>
          Add Event
        </router-link>
      </div>
    </div>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Course</th>
            <th>Created By</th>
            <th>Date Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="event in events"
            :key="event.id"
          >
            <td>{{ event.id }}</td>
            <td class="text-truncate truncated-col">{{ event.name }}</td>
            <td class="text-truncate truncated-col">{{ event.description }}</td>
            <td class="text-truncate truncated-col">{{ event.course.title }}</td>
            <td>{{ event.created_at | local_date }}</td>
            <td>{{ event.created_by_user.name }}</td>
            <td class="action-col">
              <button
                type="submit"
                class="btn btn-outline-secondary btn-sm"
                @click="viewEvent(event)"
              >
                View
              </button>
              <button
                type="submit"
                class="btn btn-outline-primary btn-sm"
                @click="editEvent(event)"
              >
                Edit
              </button>
              <button
                type="submit"
                class="btn btn-outline-danger btn-sm"
                @click="deleteEvent(event)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-if="!events.length" class="text-center">
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
      events: []
    }
  },
  async created() {
    await this.initEvents()
  },
  methods: {
    async initEvents() {
      try {
        const response = await axios.get('/web-api/event?include=createdByUser,course');
        this.events = response.data.data;
      } catch (error) {
        console.error(error);
      }
    },
    viewEvent(event) {
      this.$router.push({
        name: Routes.view_event,
        params: {
          id: event.id,
        },
      })
    },
    editEvent(event) {
      this.$router.push({
        name: Routes.edit_event,
        params: {
          id: event.id,
        },
      })
    },
    deleteEvent(event) {
      const isConfirmed = confirm("Are you sure you want to delete this event?");

      if (!isConfirmed) {
        return
      }

      axios.delete(`/web-api/event/${event.id}`)
        .then(() => {
          this.initEvents()
        })
    }
  }
}
</script>