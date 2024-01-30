<template>
  <div class="user-view-page w-75">
    <div class="card form-layout">
      <h5 class="card-header">
        Course Details
      </h5>
      <div class="card-body">
        <div class="text-center" v-if="!course && loading">
          <p>
            Loading...
          </p>
        </div>
        <div v-else>
          <div class="text-center mb-4">
            <div>
              <i class="mdi mdi-book-open mdi-48px"/>
              <div>
                <h3 class="font-weight-bold">
                  {{ course.title }}
                </h3>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-center mb-4">
            <div>
              <i class="mdi mdi-account"/>
              <span>
                {{ course.created_by_user.name }}
              </span>
            </div>
            <div class="vr"></div>
            <div>
              <i class="mdi mdi-calendar"/>
              <span>
                {{ course.created_at | local_date }}
              </span>
            </div>
          </div>
          <div class="text-justify mb-4">
            <p>
              {{ course.description }}  
            </p>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-between">
          <router-link
            tag="a"
            :to="{ name: Routes.course }"
            class="btn btn-outline-secondary"
          >
            <i class="mdi mdi-arrow-left"/>
            Back
          </router-link>
          <button
            type="submit"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#eventListModal"
          >
            <i class="mdi mdi-calendar-month"/>
            Event Lists
          </button>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="eventListModal"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-lg"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Events</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="text-center" v-if="!course && loading">
              <p>
                Loading...
              </p>
            </div>
            <div v-else>
              <table class="table">
                <tbody>
                  <tr
                    v-for="event in course.events"
                    :key="event.id"
                  >
                    <td>{{ event.name }}</td>
                    <td>{{ event.created_at | local_date }}</td>
                    <td>
                      <button
                        type="submit"
                        class="btn btn-outline-secondary btn-sm"
                        @click="viewEvent(event.id)"
                      >
                        View
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
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
      course: null,
      loading: false,
    }
  },
  async created() {
    await this.initCourse();
  },
  methods: {
    async initCourse() {
      try {
        this.loading = true;
        const response = await axios.get(`/web-api/course/${this.$route.params.id}?include=createdByUser,events`);
        console.log(response)
        this.course = response.data;
      } catch (error) {
        console.error("Error fetching user:", error);
      } finally {
        this.loading = false;
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
  }
}
</script>