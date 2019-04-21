<template>
  <div class="card text-center">
    <div class="card-header text-left">Profile Image</div>

    <div class="card-body">
      <div class="card-text">
        <img
          v-if="image !=null"
          :src="'/' + image"
          class="smallimg mx-auto rounded"
          width="200"
          alt="avatar"
        >
        <img v-else :src="url" class="smallimg mx-auto rounded" width="200" alt="avatar">
        <div class="card-block mt-2">
          <label class="btn btn-primary" for="my-file-selector">
            <input id="my-file-selector" @change="onFileChange" type="file" style="display:none;">
            Upload
          </label>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="button" @click="uploadImage" class="btn btn-lg btn-success">
        <i class="fas fa-upload"></i> Upload
      </button>
    </div>
    <vue-snotify/>
  </div>
</template>



<script>
export default {
  props: {
    id: String,
    imagePath: String
  },
  methods: {
    onFileChange(e) {
      const file = e.target.files[0];
      this.image = null;
      this.url = URL.createObjectURL(file);
      this.uploadFile = file;
    },
    uploadImage() {
   
      let formdata = new FormData();
      formdata.append("image", this.uploadFile);
      formdata.append("id", this.id);
      axios
        .post("/manage/student/imageupload", formdata, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          this.$snotify.success("Profile Image Added Sucessfully", "Success");
          console.log(response);
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  data() {
    return {
      url: null,
      image: this.imagePath,
      url: "/storage/attachments/profile.png",
      uploadFile: null,
      model: {
        first_name: null,
        last_name: null,
        middle_name: null,
        user_profile: {
          date_of_birth: null,
          email: null
        }
      },
      data: null
    };
  },
  created() {}
};
</script>

<style scoped>
/* [hidden] {
  display: none !important;
} */
</style>
