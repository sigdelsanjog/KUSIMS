<template>
  <div>
    <b-table :fields="fields" :items="items" class="mt-3" outlined bordered show-empty strip hover>
      <template slot="empty" slot-scope="scope">
        <h4>{{ scope.emptyText }}</h4>
      </template>
      <span slot="status" slot-scope="data" v-html="data.value"/>
      <span slot="docname" slot-scope="data" v-html="data.value"/>
      <template v-show="isShowUpload" slot="change_status" slot-scope="data" v-html="data.value">
        <button
          v-if="data.item.status=='Not Approved'"
          type="button"
          @click="approveDoc(data.item)"
          class="btn btn-success"
        >Approve</button>
      </template>
      <template slot="file" slot-scope="data">
        <b-form-file
          v-if="data.item.status !='Approved'"
          ref="fileinput"
          v-model="files[data.index]"
          accept="image/jpeg, image/png, image/gif"
        />
      </template>
    </b-table>
    <br>
    <b-button @click="fileUpload" variant="success" size="lg">Upload Document</b-button>
    <vue-snotify/>
  </div>
</template>

<script>
export default {
  created() {
    this.pullAttachments();
  },
  props: {
    id: {
      type: String,
      required: true
    }
  },
  methods: {
    pullAttachments() {
      axios
        .get(`/manage/student/studentdocs/${this.id}`)
        .then(response => {
          this.items = response.data;
          this.showStatusChange();
          this.showFileUpload();
          
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    fileUpload() {
      this.prepareFields();
      if (!this.validate()) {
        return false;
      }
      axios
        .post("/student/docsupload", this.formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          this.resetData();
          this.pullAttachments();
          this.$snotify.success("Document Added Sucessfully", "Success");
        })
        .catch(e => {
          console.log(e);
        });
    },
    resetData() {
      this.formData = new FormData(); // Reset it completely
      this.model = [];
      this.files = [];
      this.items = [];
    },
    prepareFields() {
      for (var i = 0; i < this.files.length; i++) {
        if (this.files[i] != null) {
          console.log(this.items[i].doc_type_id);
          this.model.push({
            doc_type_id: this.items[i].doc_type_id,
            id: this.items[i].id
          });

          let attachment = this.files[i];
          this.formData.append("attachments[][0]", attachment);
        }
      }
      this.formData.append("model", JSON.stringify(this.model));
    },
    validate() {
      let bool = this.files.every(element => element === null);
      debugger;
      if (!this.files.length || bool) {
        this.$snotify.error("Please add files", "Warning");
        return false;
      }
      return true;
    },

    handleFiles(data) {
      var index = this.items.indexOf(data.index);
      if (index !== -1) {
        this.model.splice(index, 1);
      } else {
        this.model.push({ doc_type_id: data.item.doc_type_id });
      }

      console.log(this.model);
    },
    deleteEvent: function(index, id) {},
    trClass(item, type) {
      if (!item) return;
      if (item.status === "Not Upload") return "table-danger";
    },
    showFileUpload() {
      let bool = this.items.every(element => element.status === "Approved");
      if (bool) {
        let fields = this.fields.filter(function(returnableObjects) {
          return returnableObjects.key != "file";
        });
        this.fields = [];
        this.fields = fields;
      }
    },
    showStatusChange() {
      let bool = this.items.every(element => element.status === "Approved");
      if (bool) {
        let fields = this.fields.filter(function(returnableObjects) {
          return returnableObjects.key != "change_status";
        });
        this.fields = [];
        this.fields = fields;
      }
    },
    approveDoc(item) {
      axios
        .post("/student/approveDoc", {
          id: item.id,
          doc_type_id: item.doc_type_id
        })
        .then(response => {
          this.resetData();
          this.pullAttachments();
          this.$snotify.success("Document Added Sucessfully", "Success");
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  data() {
    return {
      attachments: [],
      apModel: {
        doc_type_id: null,
        id: null
      },
      items: [],
      model: [],
      files: [],
      isShowStatus: "",
      isShowUpload: false,
      formData: new FormData(),
      fields: [
        {
          key: "docname",
          label: "Document Name",
          formatter: (value, key, item) => {
            if (!item.file_name) return value;
            return `<a target="_blank" class="link" href="/${
              item.file_name
            }">${value}</a>`;
          }
        },
        {
          key: "change_status",
          label: "Change Status",
          thStyle: this.isShowStatus,
          formatter: (value, key, item) => {
            if (!item.status === "Not Upload") {
              this.showStatus("d-none");
            }
          }
        },
        {
          key: "status",
          label: "Document Status",
          formatter: (value, key, item) => {
            if (!value) return;
            if (value === "Not Upload")
              return `<span class="badge badge-danger">${value}</span>`;
            if (value === "Not Approved")
              return `<span class="badge badge-warning">${value}</span>`;
            if (value === "Verified")
              return `<span class="badge badge-info">${value}</span>`;
            if (value === "Approved")
              return `<span class="badge badge-success">${value}</span>`;
          }
        },
        {
          key: "file",
          label: "File Upload"
        }
      ]
    };
  }
};
</script>

