import Vue from 'vue'
import moment from 'moment'

Vue.filter('local_date', value => {
    if (!value) {
        return null
    }
    return moment.utc(value).local().format('DD/MM/YYYY')
})

Vue.filter('initial', value => {
    if (!value) {
      return null;
    }
  
    const initials = value
      .split(' ')
      .map(word => word.charAt(0))
      .join('');
  
    return initials.toUpperCase();
  });