<template>
    <div class="dashboard">
        <Sidebar></Sidebar>
        <template>
            <v-row justify="center">
                <v-dialog v-model="dialog" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="text-h5">User Profile</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            label="Name*"
                                            required
                                            v-model="name"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field
                                            label="Email*"
                                            required
                                            v-model="email"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6">
                                        <v-select
                                            :items="roles"
                                            label="Role*"
                                            required
                                            item-text="name"
                                            item-value="id"
                                            v-model="roleId"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                            </v-container>
                            <small>*indicates required field</small>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="$emit('closeDialog')"
                            >
                                Close
                            </v-btn>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="updateUser()"
                            >
                                Save
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>
        </template>
    </div>
</template>
<script>
export default {
    name: "UserModal",
    props: ["user", "dialog", "roles"],
    data() {
        return {
            name: null,
            email: null,
            roleId: null,
        };
    },
    methods: {
        populateFields() {
            this.name = this.user.name;
            this.email = this.oldEmail = this.user.email;
            this.roleId = this.user.role.id
        },
        async updateUser() {
            axios.put(`/api/user/${this.user.id}`, {
                name: this.name,
                email: this.email,
                role_id: this.roleId,
            });
            this.$emit('userUpdated')
        }
    },
    watch: {
        dialog: {
            handler() {
                this.populateFields();
            },
        },
    },
};
</script>
