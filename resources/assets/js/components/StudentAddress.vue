<template>
  <div>
    <div class="card">
      <div class="card-header">Primary/Permanent Address*:</div>
      <div class="card-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label for="inputLive">Country</label>
            <b-form-input v-model="form_fields.primary_country" type="text" placeholder="Country"/>
          </div>
          <div class="form-group col-md-4">
            <label for="state">State No.</label>
            <b-form-input
              id="state"
              v-model="form_fields.primary_state"
              type="text"
              placeholder="State No."
            />
          </div>
          <div class="form-group col-md-4">
            <label for="inputLive">District</label>
            <b-form-input
              v-model="form_fields.primary_district"
              type="text"
              placeholder="District"
            />
          </div>
          <div class="form-group col-md-4">
            <label for="inputLive">City/Town/Village</label>
            <b-form-input v-model="form_fields.primary_city" type="text" placeholder="Country"/>
          </div>
          <div class="form-group col-md-4">
            <label for="inputLive">Street Address</label>
            <b-form-input v-model="form_fields.primary_street" type="text" placeholder="Country"/>
          </div>
          <div class="form-group col-md-4">
            <label for="inputLive">Ward No.</label>
            <b-form-input v-model="form_fields.ward_no" type="text" placeholder="Ward No."/>
          </div>
          <div class="form-group col-md-4">
            <label for="inputLive">House No.</label>
            <b-form-input v-model="form_fields.house_no" type="text" placeholder="House No."/>
          </div>
          <div class="form-group col-md-6">
            <label for="inputLive">Postal Address</label>
            <b-form-textarea
              v-model="form_fields.primary_postal_address"
              type="text"
              placeholder="Postal Address"
              rows="2"
              cols="4"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div
        class="card-header"
      >Temporary/Corresponding Address : (Only if different from primary address):</div>
      <div class="card-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label for="inputLive">Country</label>
            <b-form-input v-model="form_fields.temp_country" type="text" placeholder="Country"/>
          </div>
          <div class="form-group col-md-4">
            <label for="state">State No.</label>
            <b-form-input
              id="state"
              v-model="form_fields.temp_state"
              type="text"
              placeholder="State No."
            />
          </div>
          <div class="form-group col-md-4">
            <label for="inputLive">District</label>
            <b-form-input v-model="form_fields.temp_district" type="text" placeholder="District"/>
          </div>
          <div class="form-group col-md-4">
            <label for="inputLive">City/Town/Village</label>
            <b-form-input v-model="form_fields.primary_city" type="text" placeholder="Country"/>
          </div>
          <div class="form-group col-md-4">
            <label for="inputLive">Street Address</label>
            <b-form-input v-model="form_fields.temp_street" type="text" placeholder="Country"/>
          </div>
          <div class="form-group col-md-4">
            <label for="inputLive">Ward No.</label>
            <b-form-input v-model="form_fields.temp_ward_no" type="text" placeholder="Ward No."/>
          </div>
          <div class="form-group col-md-4">
            <label for="inputLive">House No.</label>
            <b-form-input v-model="form_fields.temp_house_no" type="text" placeholder="House No."/>
          </div>
          <div class="form-group col-md-6">
            <label for="inputLive">Postal Address</label>
            <b-form-textarea
              v-model="form_fields.temp_postal_address"
              type="text"
              placeholder="Postal Address"
              rows="2"
              cols="4"
            />
          </div>
        </div>
      </div>
    </div>
    <br>
    <b-button type="button" @click="updateAddress" variant="success" size="lg">Update Address</b-button>
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
    updateAddress() {
      axios
        .post("/student/address", this.form_fields)
        .then(response => {
          this.pullAttachments();
          this.$snotify.success("Address updated Sucessfully", "Success");
        })
        .catch(e => {
          console.log(e);
        });
    },
    pullAttachments() {
      axios
        .get(`/student/getaddress/${this.id}`)
        .then(response => {
          this.form_fields = response.data;
          this.form_fields.student_id = this.id;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },

  data() {
    return {
      form_fields: {
      }
    };
  }
};
</script>
