export default {
    computed: {
        auth() {
            return {
                user: this.$store.state.user,
                loggedIn: !!this.$store.state.user,
            }
        }
    },
}
