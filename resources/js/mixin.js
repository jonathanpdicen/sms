import Vue from "vue"
import auth from '@/mixins/auth'

Vue.mixin({
    mixins: [
        auth
    ],
});
