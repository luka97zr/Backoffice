<template>
    <div>
        <v-navigation-drawer app>
            <div class="text-center">
                <v-row>
                    <v-col>
                        <v-btn to="/" color="primary" exact>
                            Back to Dashboard
                        </v-btn>
                    </v-col>
                </v-row>
            </div>
        </v-navigation-drawer>
        <v-tabs fixed-tabs background-color="indigo" dark>
            <v-tab
                v-for="(link, index) in links"
                :key="index"
                :to="'/' + link.page"
                exact-path
            >
                {{ link.title }}
            </v-tab>
        </v-tabs>
        <slot></slot>
    </div>
</template>

<script>
export default {
    data() {
        return {
            links: [],
        };
    },
    computed: {
        contentTypes() {
            return this.$store.state.contentTypes;
        },
    },
    methods: {
        async createLinks() {
            await this.contentTypes.forEach((type) => {
                this.links.push({
                    page: `content/${type.slug}`,
                    title: `${type.name}`,
                });
            });
        },
    },
    async created() {
        if (this.$store.state.contentTypes.length <= 0) {
            await this.$store.dispatch("getContentType");
        }
        this.createLinks();
    },
};
</script>

<style scoped>
a {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white !important;
    text-decoration: none;
}
</style>
