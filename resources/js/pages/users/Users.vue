<template>
  <div class="dashboard">
    <Sidebar></Sidebar>
    <v-subheader class="py-0 d-flex justify-space-between rounded-lg">
      <h3>Users</h3>
    </v-subheader>
    <template>
      <v-simple-table fixed-header height="300px">
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
              <td>{{ item.role.name }}</td>
              <td>
                <v-icon small class="mr-2" @click="editItem(item)">
                  mdi-pencil
                </v-icon>
                <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </template>
    <user-modal :item="editedItem" :dialog="dialog" :test="'Luka'"></user-modal>
  </div>
</template>

<script>
import UserModal from './UserModal.vue';
export default {
    components: {
        UserModal
    },
  data: () => ({
    roles: ["Admin", "Subscriber", "User"],
    dialog: false,
    dialogDelete: false,
    errors: null,
    allUsers: [],
    headers: [
      {
        text: "Name",
        align: "start",
        sortable: false,
        value: "name",
      },
      { text: "Username", value: "calories" },
      { text: "Email", value: "email" },
      { text: "Role", value: "role.name" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      calories: 0,
      email: 0,
      role: 0,
      protein: 0,
    },
    defaultItem: {
      name: "",
      calories: 0,
      email: 0,
      role: 0,
      protein: 0,
    },
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
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.getUsers();
  },

  methods: {
    async getUsers() {
      try {
        this.allUsers = (await axios.get("/api/user")).data;
      } catch (error) {
        this.errors = error.response.data;
      }
    },
    editItem(item) {
      this.editedIndex = this.allUsers.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.allUsers.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.allUsers.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.allUsers[this.editedIndex], this.editedItem);
      } else {
        this.allUsers.push(this.editedItem);
      }
      this.close();
    },
  },
};
</script>

<style></style>
