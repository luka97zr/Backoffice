<template>
  
</template>

<script>
export default {
    methods: {
        async logOut() {
            try {
                await axios.get('/api/logout');
                this.$router.push({path: '/login'});
                this.$store.commit('setUser', {});
               this.$store.commit('setLoggedIn', false);

            }catch(error) {
                console.log(error);
            }
        }
    },
    created() {
        this.logOut();
    }
}
</script>
<style>

</style>