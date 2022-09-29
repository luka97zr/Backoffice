<template>
    <ContentWrapper>
      <v-simple-table fixed-header height="auto" class="mt-16">
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Title</th>
              <th class="text-left">Author</th>
              <th class="text-left">Date</th>
              <th class="text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- <tr v-for="item in allUsers" :key="item.name">
              <td>{{ item.name }}</td>
              <td>{{ item.username }}</td>
              <td>{{ item.email }}</td>
              <td >{{ item.role.name }}</td>
              <td>
                <v-icon small class="mr-2" @click="editItem(item)" v-if="checkPermission('edit_user')">
                  mdi-pencil
                </v-icon>
                <v-icon small v-if="checkPermission('delete_user')" @click="deleteUser(item.id)"> mdi-delete </v-icon>
              </td>
            </tr> -->
          </tbody>
        </template>
      </v-simple-table>
    </ContentWrapper>
</template>

<script>
export default {
    data() {
        return {
            contentValues: [],
        }
    },
    computed: {
        getType() {
            return this.$route.params.type;
        }
    },
    methods: {
        async getTypeValues() {
            try {
                this.contentValues = (await axios.get(`api/content?type=${this.getType}`)).data
            } catch(error) {
                console.log(error);
            }
        }
    }
}
</script>

<style>

</style>