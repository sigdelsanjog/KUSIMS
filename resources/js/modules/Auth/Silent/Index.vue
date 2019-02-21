<template></template>
<script>
import Vue from "vue";
export default {
  name: "Auth",
  mounted() {
    
    let access_token = Vue.cookie.get("authentication");
    if (access_token !== null) {
      var self = this;
      self.user = JSON.parse(access_token);
      // console.log(self.user[0].token);
      this.$store.dispatch("global/setCurrentUser", self.user[0]);
      this.$toaster.success("Login successful.");
      this.$router.push("/dashboard");
    }
  }
};
</script>