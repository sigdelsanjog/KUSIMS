<template>
  <div>
    <b-form-select
      name="job_id"
      id="job_id"
      v-model="jobId"
      :options="jobs"
    
      class="form-control mb-3"
    >
      <!-- This slot appears above the options from 'options' prop -->
      <template slot="first">
        <option :value="null" disabled>Job Type</option>
      </template>
    </b-form-select>
    <template v-if="jobId==1">
      <b-button variant="danger" @click="showModal">Assign Courses</b-button>
      <b-table :fields="fields" :items="items" class="mt-3" outlined show-empty strip hover>
        <template slot="empty" slot-scope="scope">
          <h4>{{ scope.emptyText }}</h4>
        </template>
        <template slot="index" slot-scope="data">
          <button
            type="button"
            class="btn btn-sm btn-danger"
            @click="deleteEvent(data.index, data.item.id)"
          >
            <i class="far fa-trash-alt"></i>
          </button>
        </template>
      </b-table>
    </template>
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
        title="Assign Courses"
        @shown="clearName"
      >
        <div slot="modal-footer">
          <button type="button" class="btn btn-secondary" @click="modalShow=false">Cancel</button>
          <button type="submit" class="btn btn-danger">Save</button>
        </div>
        <div class="d-block">
          <div class="form-group">
            <label for="department" class="control-label">Department</label>
            <b-form-select
              name="department"
              id="department"
              v-validate="'required'"
              v-model="model.dept_id"
              :options="depts"
              class="form-control"
              :class="{'input': true, 'is-danger': errors.has('course-modal.department') }"
            >
              <template slot="first">
                <option :value="null" disabled>Department</option>
              </template>
            </b-form-select>
            <span
              v-show="errors.has('course-modal.department')"
              class="help is-danger"
            >{{ errors.first('course-modal.department') }}</span>
          </div>
          <div class="form-group">
            <label for="programs" class="control-label">Program</label>
            <b-form-select
              name="programs"
              id="programs"
              v-model="model.program_id"
              :options="programs"
              v-validate="'required'"
              :class="{'input': true, 'is-danger': errors.has('course-modal.programs') }"
              class="form-control"
            >
              <template slot="first">
                <option :value="null" disabled>Program</option>
              </template>
            </b-form-select>
            <span
              v-show="errors.has('course-modal.programs')"
              class="help is-danger"
            >{{ errors.first('course-modal.programs') }}</span>
          </div>
          <div class="form-group">
            <label for="batch" class="control-label">Batch</label>
            <b-form-select
              name="batch"
              id="batch"
              v-model="model.batch_id"
              :options="batches"
              v-validate="'required'"
              :class="{'input': true, 'is-danger': errors.has('course-modal.programs') }"
              class="form-control"
            >
              <template slot="first">
                <option :value="null" disabled>Batch</option>
              </template>
            </b-form-select>
            <span
              v-show="errors.has('course-modal.batch')"
              class="help is-danger"
            >{{ errors.first('course-modal.batch') }}</span>
          </div>
          <div class="form-group">
            <label for="course" class="control-label">Course</label>
            <b-form-select
              name="course"
              id="course"
              v-model="model.course_id"
              :options="courseList"
              v-validate="'required'"
              :class="{'input': true, 'is-danger': errors.has('course-modal.course') }"
              class="form-control"
            >
              <template slot="first">
                <option :value="null" disabled>Course</option>
              </template>
            </b-form-select>
            <span
              v-show="errors.has('course-modal.course')"
              class="help is-danger"
            >{{ errors.first('course-modal.course') }}</span>
          </div>
        </div>
      </b-modal>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    teacherId: {
      type: String
    },
    job_id: {
      type: String
    },
    job: {
      type: String,
      required: true
    },
    batch: {
      type: String,
      required: true
    },
    dept: {
      type: String,
      required: true
    },
    program: {
      type: String,
      required: true
    },
    course: {
      type: String,
      required: true
    },
    itemList: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      jobId: this.job_id,
      jobs: JSON.parse(this.job),
      batches: JSON.parse(this.batch),
      depts: JSON.parse(this.dept),
      programs: JSON.parse(this.program),
      courses: JSON.parse(this.course),

      modalShow: false,
      isBusy: false,
      model: {
        batch_id: null,
        program_id: null,
        teacher_id: this.teacherId,
        dept_id: null,
        course_id: null
      },
      items: JSON.parse(this.itemList),
      fields: [
        // A virtual column that doesn't exist in items
        { key: "index", label: "Action" },
        // A column that needs custom formatting
        { key: "program", label: "Program" },
        { key: "department", label: "Department" },
        // A virtual column made up from two fields
        { key: "course", label: "Course" },
        { key: "batch", label: "Batch" }
      ]
    };
  },
  computed: {
    courseList() {
      return this.courses.map(item => {
        return {
          text: item.name + "--" + item.code,
          value: item.id
        };
      });
    }
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    showModal() {
      this.$refs.myModalRef.show();
    },
    hideModal() {
      this.$refs.myModalRef.hide();
    },
    onHidden(evt) {
      // Return focus to our Open Modal button
      // See accessibility below for additional return-focus methods
      this.$refs.btnShow.$el.focus();
    },
    toggleBusy() {
      this.isBusy = !this.isBusy;
    },
    deleteEvent: function(index, id) {
      axios
        .delete("/setting/teacher/removecourse", { params: { id: id } })
        .then(response => {
          alert(response.data);
          this.items.splice(index, 1);
        })
        .catch(e => {
          console.log(e);
        });
    },
    addNewContact() {},
    formSubmit(scope) {
      this.$validator.validateAll(scope).then(result => {
        if (result) {
          // eslint-disable-next-lin
          axios
            .post("/setting/teacher/course", this.model)
            .then(response => {
              this.items = response.data;
              // console.log(response.data);
            })
            .catch(e => {
              console.log(e);
            });
          this.$refs.myModalRef.hide();
        }
      });
    },
    clearName() {
      this.model.batch_id = null;
      this.model.batch_id = null;
      this.model.program_id = null;
      this.model.dept_id = null;
      this.model.course_id = null;
    }
  }
};
</script>



