<template>
  <div>
    <b-form-select v-model="job_id" :options="employees" class="form-control mb-3">
      <!-- This slot appears above the options from 'options' prop -->
      <template slot="first">
        <option :value="null" disabled>Job Type</option>
      </template>
    </b-form-select>
    <template v-if="job_id==1">
      <clientContact

      />
    </template>

    <!-- <select class="form-control" v-model="job_id">
      <option value disabled>Select a category</option>
      <option v-for="(item, key) in employees" :key="key" :value="key">{{item}}</option>
    </select>-->
  </div>
</template>

<script>
export default {
  props: {
    employee: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      job_id: null,
      employees: JSON.parse(this.employee)
    };
  },
  computed: {},
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
