<template>
    <v-app id="inspire">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Login form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-form ref="form" lazy-validation>
                                    <v-text-field
                                        v-model="email"
                                        :rules="emailRules"
                                        prepend-icon="person"
                                        name="email"
                                        label="Login"
                                        type="text"
                                        required
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="password"
                                        :rules="passwordRules"
                                        id="password"
                                        prepend-icon="lock"
                                        name="password"
                                        label="Password"
                                        type="password"
                                    ></v-text-field>
                                    <span v-if="errors">{{ errors }}</span>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn :loading="!loaded" color="primary" to="/" @click="login()"
                                    >Login</v-btn
                                >
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
import doesCookieExist from '../../helpers/CookieCheck'
export default {
   name: "Login",
   data() {
        return {
            email: null,
            emailRules: [
                (v) => !!v || "E-mail is required",
                (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
            ],
            password: null,
            passwordRules: [(v) => !!v || "Password is required"],
            errors: null,
            valid: false,
            loaded: true
        };
   },
   created() {
      if (doesCookieExist('token')) this.$router.push({ path: "/" });
   },
   methods: {
      async login() {
         try {
               this.errors = null;
               if (!this.validate) return;
               this.loaded = false;
               await axios.post("/api/login", {
                  email: this.email,
                  password: this.password,
               });
               this.loaded = true;
               this.$router.push({ path: "/" });
         } catch (error) {
               this.loaded = true;
               this.errors = error.response.data?.message;
         }
      },
   },
   computed: {
      validate() {
         return this.$refs.form.validate();
      },
   },
};
</script>
