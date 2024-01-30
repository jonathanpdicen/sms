<template>
  <nav>
    <div class="navbar-inner">
      <div class="left">
        <router-link
          tag="a"
          :to="{ name: Routes.dashboard }"
          class="logo"
        >
          <span>
            SMS
          </span>
        </router-link>
      </div>
      <div class="center">
        <div class="centered-links">
          <router-link
            v-for="(menu, index) in menu_list"
            :key="index"
            tag="a"
            :to="{ name: menu.route_name }"
            class="menu-link"
          >
            <i v-html="menu.icon" class="menu-icon"/>
            <span>
              {{ menu.title }}
            </span>
          </router-link>
        </div>
      </div>
      <div class="right">
        <div>
          <a
            aria-expanded="false"
            aria-haspopup="false"
            class="avatar dropdown-toggle"
            data-toggle="dropdown"
            href="#"
            role="button"
          >
            {{ auth.user.name | initial }}
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a
              class="dropdown-item"
              href="#"
              @click.prevent="logout"
            >
              <i class="mdi mdi-power"/>
              Logout
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>
<script>
import Routes from "@/constants/routes";

export default {
  data() {
    return {
      Routes,
      menu_list: [
        {
            title: 'Dashboard',
            route_name: Routes.dashboard,
            icon: `<i class="mdi mdi-view-dashboard mdi-24px"/>`
        },
        {
            title: 'Courses',
            route_name: Routes.course,
            icon: `<i class="mdi mdi-book-open mdi-24px"/>`,
        },
        {
            title: 'Events',
            route_name: Routes.event,
            icon: `<i class="mdi mdi-calendar-month mdi-24px"/>`
        },
        {
            title: 'Users',
            route_name: Routes.user,
            icon: `<i class="mdi mdi-account-group mdi-24px"/>`,
        }
      ]
    }
  },
  methods: {
    logout() {
      axios.post('/logout', {
        _token: this.$store.state.csrf
      })
        .then(() => {
            location.href = '/login';
        })
    },
  }
}
</script>