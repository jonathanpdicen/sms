<template>
  <div class="w-50">
    <div class="card form-layout">
      <h5 class="card-header">
        Create User
      </h5>
      <div class="card-body">
        <user-form></user-form>
      </div>
    </div>
  </div>
</template>
<script>
import UserForm from '@/components/main/user/Form'

export default {
  components: {
    UserForm
  },
}
</script>