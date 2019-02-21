<template>
  <AppHeaderDropdown right no-caret>
    <template slot="header">
      <img :src="'img/profile.png'" class="img-avatar" alt="admin@bootstrapmaster.com">
    </template>
    <template slot="dropdown">
      <b-dropdown-header tag="div" class="text-center">
        <strong>Account</strong>
      </b-dropdown-header>
      <b-dropdown-item to="/profile">
        <i class="fa fa-user"/> Profile
      </b-dropdown-item>
      <b-dropdown-item>
        <i class="fa fa-wrench"/> Settings
      </b-dropdown-item>
      <b-dropdown-item @click="logOut">
        <i class="fa fa-lock"/>
        Log Out
      </b-dropdown-item>
    </template>
  </AppHeaderDropdown>
</template>

<script>
import { HeaderDropdown as AppHeaderDropdown } from "@coreui/vue";
import { mapGetters } from "vuex";

export default {
  name: "DefaultHeaderDropdownAccnt",
  components: {
    AppHeaderDropdown
  },
  data: () => {
    return { itemsCount: 42 };
  },
  computed: {
    ...mapGetters("global", {
      isLoggedIn: "isLoggedIn",
      currentUser: "currentUser"
    })
  },
  methods: {
    logOut() {
      localStorage.removeItem("currentUser");
      this.$store.commit("global/removeCurrentUser");
      this.$router.push("/login");
    }
  }
};
</script>