<template>
    <div class="dashboard">
        <Sidebar></Sidebar>
        <v-subheader class="py-0 d-flex justify-space-between rounded-lg">
            <h3>Type</h3>
        </v-subheader>
        <form>
            <v-text-field
                v-model="name"
                @keyup="slugifyName()"
                @change="uuidv4()"
                label="Name"
                required
            ></v-text-field>
            <v-text-field
                v-model="slug"
                label="Slug"
                required
                disabled
            ></v-text-field>
            <v-text-field
                v-model="uuid"
                label="Uuid"
                required
                disabled
            ></v-text-field>
            <v-btn class="mr-4" @click="registerType()"> submit </v-btn>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: null,
            slug: null,
            uuid: null
        }
    },
    methods: {
        slugifyName() {
            this.slug = this.name.split(' ').join('-').toLowerCase();
        },
        uuidv4() {
            this.uuid = ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
                (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
            );
        },
        async registerType() {
            try {
                await axios.post('/api/contentType', {
                    name: this.name,
                    slug: this.slug,
                    uuid: this.uuid
                })
            } catch(error) {
                console.log(error);
            }
        }
    },
};
</script>

<style></style>
