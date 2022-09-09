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
                    ></v-text-field>
                    <v-text-field
                        label="Username"
                        required
                    ></v-text-field>
                    <v-text-field  type="email" label="Email" required></v-text-field>
                    <v-text-field
                        type="password"
                        name="input-10-1"
                        hint="At least 8 characters"
                        label="Password"
                        counter
                    ></v-text-field>
                    <v-text-field
                        type="password"
                        name="input-10-1"
                        hint="At least 8 characters"
                        label="Retype Password"
                        counter
                    ></v-text-field>
                    <v-btn
                        color="success"
                        class="mr-4"
                    >
                        Update
                    </v-btn>
                </v-form>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
};
</script>

<style></style>
