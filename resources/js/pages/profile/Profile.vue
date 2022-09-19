<template>
    <div class="dashboard">
        <Sidebar></Sidebar>
        <v-subheader class="py-0 d-flex justify-space-between rounded-lg">
            <h3>Profile</h3>
        </v-subheader>
        <v-row>
            <v-col>
                <v-img
                    lazy-src="https://picsum.photos/id/11/100/60"
                    max-height="217"
                    max-width="368"
                    src="https://www.business2community.com/wp-content/uploads/2017/08/blank-profile-picture-973460_640.png"
                    ></v-img>
            </v-col>
            <v-col>
                <v-file-input accept="image/png, image/jpeg, image/bmp" placeholder="Pick an avatar" prepend-icon="mdi-camera" label="Avatar"></v-file-input>   
                <v-form ref="form"  lazy-validation>
                    <v-text-field
                        label="Name"
                        required
                        v-model="name"
                    ></v-text-field>
                    <v-text-field
                        label="Username"
                        required
                        v-model="username"
                    ></v-text-field>
                    <v-text-field  type="email" label="Email" required v-model="email" :rules="emailRules" ></v-text-field>
                    <v-text-field
                        type="password"
                        name="input-10-1"
                        hint="At least 8 characters"
                        label="Password"
                        :rules="passwordRules"
                        v-model="password"
                        counter
                    ></v-text-field>
                    <v-text-field
                        type="password"
                        name="input-10-1"
                        hint="At least 8 characters"
                        label="Retype Password"
                        v-model="retypePassword"
                        :rules="retypePasswordRules"
                        counter
                    ></v-text-field>
                    <v-btn
                        color="success"
                        class="mr-4"
                        type="submit"
                        @click.prevent="updateUser()"
                        :loading="!loaded"
                    >
                        Update
                    </v-btn>
                    <Success v-if="success" msg="Updated Successfully"></Success>
                </v-form>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import ClearMessage from '../../mixins/ClearMessage';
export default {
    data() {
        return {
            name: null,
            username: null,
            email: null,
            password: null,
            retypePassword: null,
            userId: null,
            emailRules: [
                (v) => !!v || "E-mail is required",
                (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
            ],
            passwordRules: [
                (v) => !!v || "Password is required",
                (v) => v?.length >= 8 || "Pasword has to contain at least 8 characters"
            ],
            retypePasswordRules: [
                (v) => !!v || "Please retype password",
                (v) => v === this.password || "Passwords don't match"
            ],
            loaded: true,
            errors: null,
            success: false,
        }
    },
    mixins: [ClearMessage],
    methods: {
        async updateUser() {
            try {
                this.errors = null;
                if(!this.validate) return;
                this.loaded = false;
                await axios.put(`/api/user/${this.userId}`, {
                    name: this.name,
                    email: this.email,
                    password: this.password
                });
                this.loaded = true;
                this.success = true;
                this.clearMessage(1000);
            } catch(error) {
                this.loaded = true;
                this.errors = error.response.data.errors;
            }
        },
    },
    computed: {
        populateFields() {
            this.name = this.$store.state.user.name;
            this.email = this.$store.state.user.email;
            this.userId = this.$store.state.user.id;
        },
        validate() {
            return this.$refs.form.validate();
        }
    },
    mounted() {
        this.populateFields;
    }
};
</script>

<style></style>
