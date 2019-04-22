<template>
  <div>
    <form
      @submit.stop.prevent="formSubmit('course-modal')"
      data-vv-scope="course-modal"
      autocomplete="off"
    >
      <b-modal
        v-model="modalShow"
        ref="myModalRef"
        centered
        ok-only
        no-close-on-backdrop
        title="Upload Marks"
      >
        <div slot="modal-footer">
          <button type="button" class="btn btn-secondary" @click="modalShow=false">Cancel</button>
          <button type="submit" class="btn btn-danger">Save</button>
        </div>
        <div class="d-block">
          <div class="form-group">
            <b-form-file
              @change="onFileChange"
              placeholder="Choose a file..."
              drop-placeholder="Drop file here..."
            ></b-form-file>
          </div>
        </div>
      </b-modal>
    </form>
    <b-table :items="items" :fields="fields" class="mt-3" outlined show-empty strip hover>
      <div slot="empty" slot-scope="scope">
        <h4>{{ scope.emptyText }}</h4>
      </div>
      <div slot="index" slot-scope="data">
        <button
          type="button"
          class="btn btn-sm btn-danger"
          @click="marksUpload(data.index, data.item.course_id)"
        >Marks Upload</button>
      </div>
    </b-table>
    <vue-snotify/>
  </div>
</template>

<script>
export default {
  props: ["teacherId"],
  created() {
    this.pullCourse();
  },
  methods: {
    marksUpload: function(index, id) {
      this.course_id = id;
      this.$refs.myModalRef.show();
    },
    onFileChange(e) {
      const file = e.target.files[0];
      this.uploadFile = file;
    },
    formSubmit() {
      let formdata = new FormData();
      if (!this.uploadFile) {
        this.$snotify.error("Please select the file", "Warning");
        return 0;
      }
      formdata.append("file", this.uploadFile);
      formdata.append("course_id", this.course_id);
      axios
        .post("/employee/marksupload", formdata, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          this.$refs.myModalRef.hide();
          this.$snotify.success("Marks Uploaded Sucessfully", "Success");
        })
        .catch(e => {
          console.log(e);
        });
    },
    pullCourse() {
      axios
        .get(`profile/teacher/course/${this.teacherId}`)
        .then(response => {
          this.items = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },
  data() {
    return {
      fields: [
        // A virtual column that doesn't exist in items
        { key: "index", label: "Action" },
        // A column that needs custom formatting
        { key: "program", label: "Program" },
        { key: "department", label: "Department" },
        // A virtual column made up from two fields
        { key: "course", label: "Course" },
        { key: "batch", label: "Batch" }
      ],
      uploadFile: null,
      modalShow: false,
      items: null,
      course_id: null,
      model: {
        id: this.teacherId
      }
    };
  }
};
</script>



