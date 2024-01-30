import store from '@/store/index'

export default {
    loggedIn() {
        return !!store.state.user;
    },
}