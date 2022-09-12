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