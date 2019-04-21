<template>
  <div>
    <b-btn
      @click="modalShow = !modalShow"
      v-if="status==1 || status ==2"
      variant="success"
    >Update Hostel</b-btn>
    <form
      @submit.stop.prevent="formSubmit('hostel-modal')"
      data-vv-scope="hostel-modal"
      autocomplete="off"
    >
      <b-modal
        v-model="modalShow"
        ref="myModalRef"
        centered
        ok-only
        no-close-on-backdrop
        title="Assign Hostel"
      >
        <div slot="modal-footer">
          <button type="button" class="btn btn-secondary" @click="modalShow=false">Cancel</button>
          <button type="submit" class="btn btn-danger">Save</button>
        </div>
        <div class="d-block">
          <div class="form-group">
            <label for="block" class="control-label">Block</label>
            <b-form-select
              name="block"
              id="block"
              v-model="model.block_id"
              :options="blockList()"
              @change="onChangeBlock"
              class="form-control"
              :class="{'input': true, 'is-danger': errors.has('hostel-modal.block') }"
            >
              <template slot="first">
                <option :value="null" disabled>Block</option>
              </template>
            </b-form-select>
            <span
              v-show="errors.has('hostel-modal.department')"
              class="help is-danger"
            >{{ errors.first('hostel-modal.department') }}</span>
          </div>
          <div class="form-group">
            <label for="room" class="control-label">Room</label>
            <b-form-select
              name="room"
              id="room"
              v-model="model.room_id"
              :options="roomList()"
              :class="{'input': true, 'is-danger': errors.has('hostel-modal.room') }"
              class="form-control"
            >
              <template slot="first">
                <option :value="null" disabled>Room</option>
              </template>
            </b-form-select>
            <span
              v-show="errors.has('hostel-modal.room')"
              class="help is-danger"
            >{{ errors.first('hostel-modal.room') }}</span>
          </div>
          <div class="form-group">
            <label for="room" class="control-label">Status</label>
            <b-form-select
              name="status"
              id="status"
              v-model="model.status"
              :options="statusList"
              v-validate="'required'"
              :class="{'input': true, 'is-danger': errors.has('hostel-modal.status') }"
              class="form-control"
            >
              <template slot="first">
                <option :value="null" disabled>Status</option>
              </template>
            </b-form-select>
            <span
              v-show="errors.has('hostel-modal.status')"
              class="help is-danger"
            >{{ errors.first('hostel-modal.status') }}</span>
          </div>
          <div class="form-group">
            <label for="room" class="control-label">Remarks</label>
            <b-form-textarea
              id="textarea"
              v-model="model.remarks"
              placeholder="Enter remarks..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
            <span
              v-show="errors.has('hostel-modal.remarks')"
              class="help is-danger"
            >{{ errors.first('hostel-modal.remarks') }}</span>
          </div>
        </div>
      </b-modal>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      model: {
        id: this.id,
        room_id: null,
        block_id: null,
        status: null
      },
      statusList: [
        { value: "1", text: "Not Approved" },
        { value: "2", text: "Not Qualified" },
        { value: "3", text: "Approved" }
      ],
      modalShow: false,
      hostelBlock: [],
      hostelRoom: [],
      filterRoom: []
    };
  },
  methods: {
    formSubmit(scope) {
      this.$validator.validateAll(scope).then(result => {
        if (result) {
          axios
            .post("/hostel/hostel_status", this.model)
            .then(response => {
              this.modalShow = false;
              window.location = '/hostel/book'
            })
            .catch(e => {
              console.log(e);
            });
        }
      });
    },
    getRecords() {
      axios
        .get(`/hostel/book_block`)
        .then(response => {
          this.hostelBlock = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });

      axios
        .get(`/hostel/book_room`)
        .then(response => {
          this.hostelRoom = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    blockList() {
      return this.hostelBlock.map(item => {
        return {
          text: item.name,
          value: item.id
        };
      });
    },
    roomList() {
      return this.filterRoom.map(item => {
        return {
          text: item.room,
          value: item.id
        };
      });
    },
    onChangeBlock(id) {
      this.filterRoom = this.hostelRoom.filter(x => x.block_id === id);
    }
  },
  computed: {},
  created() {
    this.getRecords();
  },
  props: {
    status: {
      type: String
    },
    id: {
      type: String
    }
  }
};
</script>
