<template>
  <div class="text-center">
    <v-menu >
      <template v-slot:activator="{ on: menu, attrs }">
        <v-tooltip bottom>
          <template v-slot:activator="{ on: tooltip }">
            <v-btn
              color="primary"
              dark
              v-bind="attrs"
              v-on="{ ...tooltip, ...menu }"
            >
              Menu
            </v-btn>
          </template>
          <span>Select Menu</span>
        </v-tooltip>
      </template>
      <v-list>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
        >
            <router-link :to="item.value">
                <v-list-item-title>{{ item.title }}</v-list-item-title>
            </router-link>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>

<script>
  export default {
    data: () => ({
      items: [
        { title: 'Dashboard', value: '/' },
        { title: 'CMS', value: '/content' },
      ],
    }),
  }
</script>