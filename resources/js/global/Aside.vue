<template>
  <v-navigation-drawer app>
      <div class="text-center">
        <h2 class="white--text">Web Burden</h2>
      </div>
    <v-divider></v-divider>
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
export default {
  // name: "Sidebar",
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
          page: '/settings',
          icon: 'mdi-cog',
          title: 'Settings'
        },
        {
          page: '/logout',
          icon: 'mdi-logout',
          title: 'Logout'
        }
      ]
    };
  },
};
</script>

<style scoped></style>