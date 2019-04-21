<template>
  <div>
    <div class="card-body table-responsive">
      <b-table :items="items" :fields="fields" class="mt-3" outlined bordered show-empty strip hover></b-table>
    </div>
  </div>
</template>
<script>
export default {
  props: ["id"],
  created() {
    this.getMarksInfo();
  },
  data() {
    return {
      items: [],
       fields: [
        { key: "course_name", label: "Course Name" },
        { key: "course_code", label: "Course Code" },
        { key: "marks", label: "Internal Mark" },
        { key: "attendance", label: "Attendance" },
      ]
    };
  },
  methods: {
    getMarksInfo() {
      axios
        .get(`/student/getmarks/${this.id}`)
        .then(response => {
          this.items = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
