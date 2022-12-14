<template>
  <div class="dashboard">
    <Sidebar></Sidebar>
    <v-subheader class="py-0 d-flex justify-space-between rounded-lg">
      <h3>Users</h3>
    </v-subheader>
    <template>
      <v-simple-table fixed-header height="auto">
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Name</th>
              <th class="text-left">Username</th>
              <th class="text-left">Email</th>
              <th class="text-left">Role</th>
              <th class="text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in allUsers" :key="item.name">
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
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    <Success v-if="success" msg="Updated Successfully"></Success>
    </template>
    <pagination :length="numOfPages" @switchPage="getUsers()" ref="pagination"></pagination>
    <user-modal :user="editedItem" :dialog="dialog" @closeDialog="dialog=false" :roles="$store.state.roles" @userUpdated="updateUserTable()"></user-modal>
  </div>
</template>

<script>
import UserModal from './UserModal.vue';
import Pagination from '../../components/Pagination.vue'
import UserPermission from '../../mixins/UserPermission';
import ClearMessage from '../../mixins/ClearMessage';

export default {
  name: 'Users',
  components: {
      UserModal,
      Pagination
  },
  mixins: [UserPermission, ClearMessage],
  data: () => ({
    dialog: false,
    dialogDelete: false,
    errors: null,
    allUsers: [],
    numOfPages: null,
    editedIndex: -1,
    editedItem:{},
  success: false,
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },
  watch: {
    dialog(val) {
      val || this.close();
    },
  },
  mounted() {
    this.getUsers();
    if (this.$store.state.roles <= 0) {
      this.$store.dispatch('getRoles');
    }
  },
  methods: {
    async getUsers() {
      try {
        const data = (await axios.get(`/api/user?page=${this.$refs.pagination.page}`)).data;
        this.allUsers = data.data
        this.numOfPages = data.last_page;
      } catch (error) {
        this.errors = error.response.data;
      }
    },
    async deleteUser(user) {
      try {
        await axios.delete(`api/user/${user}`);
        this.getUsers();
      } catch(error) {
        console.log(error);
      }
    },
    updateUserTable() {
      this.dialog = false;
      this.getUsers();
      this.success = true;
      this.clearMessage(1000);
    },
    editItem(item) {
      this.editedIndex = this.allUsers.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    }
  },
};
</script>

<style></style>
