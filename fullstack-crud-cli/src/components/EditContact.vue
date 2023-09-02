<template>
  <div class="container">
    <div class="columns">
      <div class="column is-centered">
        <div class="notification is-danger mt-4" v-if="errors.length">
          <ul class="mb-0">
            <li v-for="(error, index) in errors" :key="index">
              {{ error }}
            </li>
          </ul>
        </div>

        <form @submit.prevent="updateContact" novalidate>
          <div class="field">
            <label class="label mt-4">Name</label>
            <div class="control">
              <input
                class="input"
                type="text"
                v-model="contact.name"
                placeholder="Enter Name"
              />
            </div>
          </div>
          <div class="field">
            <label class="label mt-4">Email</label>
            <div class="control">
              <input
                class="input"
                type="text"
                v-model="contact.email"
                placeholder="Enter Email"
              />
            </div>
          </div>
          <div class="field">
            <label class="label mt-4">Designation</label>
            <div class="control">
              <input
                class="input"
                type="text"
                v-model="contact.designation"
                placeholder="Enter Designation"
              />
            </div>
          </div>
          <div class="field">
            <label class="label mt-4">Contact No</label>
            <div class="control">
              <input
                class="input"
                type="text"
                v-model="contact.contact_no"
                placeholder="Enter Contact No"
              />
            </div>
          </div>

          <button class="button is-primary mt-4">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "EditContact",
  data() {
    return {
      contact: {
        name: "",
        email: "",
        designation: "",
        contact_no: "",
      },
      errors: [],
    };
  },
  created() {
    this.getContactById();
  },
  methods: {
    async getContactById() {
      let url = `http://127.0.0.1:8000/api/contact/edit/${this.$route.params.id}`;
      await axios.get(url).then((response) => {
        console.log(response);
        this.contact = response.data.contact;
      });
    },
    mounted: function () {
      console.log("Edit Component Form COmponentn Load");
    },

    async updateContact() {
      this.errors = [];
      if (!this.contact.name) {
        this.errors.push("Name is required");
      }
      if (!this.contact.email) {
        this.errors.push("Email is required");
      }
      if (!this.contact.designation) {
        this.errors.push("Designation is required");
      }
      if (!this.contact.contact_no) {
        this.errors.push("Contact No is required");
      }

      if (!this.errors.length) {
        let formData = new FormData();
        formData.append("name", this.contact.name);
        formData.append("email", this.contact.email);
        formData.append("designation", this.contact.designation);
        formData.append("contact_no", this.contact.contact_no);

        let url = `http://127.0.0.1:8000/api/update_contact/${this.$route.params.id}`;
        await axios
          .post(url, formData)
          .then((response) => {
            console.log(response);
            if (response.status == 200) {
              alert(response.data.message);
            } else {
              console.log("error");
            }
          })
          .catch((error) => {
            this.errors.push(error.response);
          });
      }
    },
  },
};
</script>
