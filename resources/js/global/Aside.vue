<template>
  <v-navigation-drawer app>
      <div class="text-center">
        <v-row>
          <v-col>
            <h4 class="black--text">{{$store.state.user.name}}</h4>
          </v-col>
        </v-row>
      </div>
    <v-divider></v-divider>
      <dropdown></dropdown>
    <v-list>
      <v-list-item v-for="(entry, index) in links" :key="index">
        <v-list-item-icon>
            <v-icon>{{ entry.icon }}</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>
            <router-link :to="entry.page">
              {{ entry.title }}
            </router-link>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import Dropdown from './Dropdown.vue'
export default {
  name: "Sidebar",
  data() {
    return {
      links: [
        {
          page: '/',
          icon: 'mdi-microsoft-windows',
          title: 'Dashboard'
        },
        {
          page: '/profile',
          icon: 'mdi-account',
          title: 'Profile'
        },
        {
          page: '/users',
          icon: 'mdi-clipboard-list-outline',
          title: 'Users'
        },
        {
          page: '/type',
          icon: 'mdi-cog',
          title: ' Type'
        },
        {
          page: '/logout',
          icon: 'mdi-logout',
          title: 'Logout'
        }
      ]
    };
  },
  components: {
    Dropdown
  },
  computed: {
    contentTypes() {
       return this.$store.state.contentTypes;
    },
  },
  methods: {
      async test() {
        await this.contentTypes.forEach(type => {
        this.links.push({
          page: `content/${type.slug}`,
          title: `${type.name}`
        })
      })
    }
  },
  async created() {
    if (this.$store.state.contentTypes.length <= 0) {
      await this.$store.dispatch('getContentType')
    }
    this.test()
  }
};
</script>

<style scoped></style>