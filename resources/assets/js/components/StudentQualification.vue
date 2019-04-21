<template>
  <div>
    <b-button @click="addItem">Add Degree</b-button>
    <table class="table b-table mt-3 table-hover table-bordered border">
      <thead>
        <tr>
          <td>Board</td>
          <td>Year of Completion</td>
          <td>Aggregate Percentage</td>
          <td>Symbol No</td>
          <td>Division</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in qitems" :key="index">
          <td>
            <b-form-select v-model="item.board" :options="options" :name="`board_${index}`"/>
          </td>
          <td>
            <b-form-input
              v-model="item.year_of_completion"
              :options="options"
              :name="`year_of_completion_${index}`"
            />
          </td>
          <td>
            <b-form-input
              v-model="item.aggregate_percent"
              :options="options"
              :name="`aggregate_percent${index}`"
            />
          </td>
          <td>
            <b-form-input v-model="item.symbol_no" :options="options" :name="`symbol_no_${index}`"/>
          </td>
          <td>
            <b-form-input v-model="item.division" :options="options" :name="`division_${index}`"/>
          </td>
        </tr>
      </tbody>
    </table>

    <b-button type="button" @click="storeQualification">Save Qualification</b-button>
      <vue-snotify/>
  </div>
</template>

<script>
export default {
  created() {
    this.pullQAttachments();
  },
  data() {
    return {
      // Note `isActive` is left out and will not appear in the rendered table
      options: [{ value: "SLC", text: "SLC" }, { value: "10 +2", text: "+2" }],
      qmodel: [],
      board: null,
      year_of_completion: null,
      aggregate_percent: null,
      symbol_no: null,
      division: null,
      fields: [
        {
          key: "board",
          label: "Board"
        },
        {
          key: "year_of_completion",
          label: "Year Of Completion"
        },
        "aggreagte_percent",
        "symbol_no",
        "division"
      ],
      qitems: []
    };
  },
  props: {
    id: {
      type: String,
      required: true
    }
  },
  methods: {
    addItem() {
      this.qitems.push({
        id: null,
        student_id: this.id,
        board: this.board,
        year_of_completion: this.year_of_completion,
        aggregate_percent: this.aggregate_percent,
        symbol_no: this.symbol_no,
        division: this.division
      });
    },
    storeQualification() {
      axios
        .post("/student/qualification", this.qitems)
        .then(response => {
          this.pullQAttachments();
          this.$snotify.success("Qualification updated Sucessfully", "Success");
        })
        .catch(e => {
          console.log(e);
        });
    },
    pullQAttachments() {
      axios
        .get(`/student/getqualification/${this.id}`)
        .then(response => {
          this.qitems = response.data;
          this.qmodel.student_id = this.id;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>

</template>
