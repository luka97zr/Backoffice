export default {
    methods: {
        checkPermission(permissionSlug) {
            return !!Object.values(this.$store.state.user.role.role_permission).find(permisson => permisson.permission.slug === permissionSlug)
        }
    },
}