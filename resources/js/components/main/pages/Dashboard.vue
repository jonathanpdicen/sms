<template>
  <div class="w-100">
    <div class="row">
      
      <div class="col-md-4 col-xl-4">
        <div class="card bg-c-green order-card">
            <div class="card-block">
              <h6 class="m-b-20">Users</h6>
              <h2 class="text-right">
                <i class="mdi mdi-account-group f-left"></i>
                <span>486</span>
              </h2>
            </div>
        </div>
      </div>
      
      <div class="col-md-4 col-xl-4">
        <div class="card bg-c-yellow order-card">
          <div class="card-block">
            <h6 class="m-b-20">Courses</h6>
            <h2 class="text-right">
              <i class="mdi mdi-book-open f-left"></i>
              <span>486</span>
            </h2>
          </div>
        </div>
      </div>
      
      <div class="col-md-4 col-xl-4">
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h6 class="m-b-20">Events</h6>
            <h2 class="text-right">
              <i class="mdi mdi-calendar-month f-left"></i>
              <span>486</span>
            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Routes from "@/constants/routes";

export default {
  data() {
    return {
      Routes
    }
  }
}
</script>
<style scoped>
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
</style>