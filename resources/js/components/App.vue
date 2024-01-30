<template>
  <div>
    <div>
      <base-header v-if="auth.loggedIn" />
      <div class="view-wrapper has-top-nav">
        <div class="page-content-wrapper">
          <div class="page-content d-flex justify-content-center">
            <router-view/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import BaseHeader from '@/components/custom/Header'
import AuthUtil from "@/utils/auth";

export default {
  components: {
    BaseHeader
  }
}
</script>
