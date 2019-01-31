<template>
  <div class="animated fadeIn">
    <div class="col-4 mx-auto">
      <b-card
        title="Welcome to Kathmandu University"
        img-src="img/ku-logo.png"
        img-alt="Image"
        img-top
        class="mb-2 text-center"
      >
        <p class="card-text">Student Information Management System</p>
      </b-card>
    </div>
  </div>
</template>



<script>
export default {
  name: "standard-buttons",
  data: () => {
    return { togglePress: false };
  }
};
</script>

<style scoped>
.btn.disabled {
  cursor: auto;
}
</style>