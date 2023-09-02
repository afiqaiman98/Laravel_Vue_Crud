

<template>
  <div class="container">
    <table class="table is-hoverable is-fullwidth has-text-black">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Designation</th>
          <th>Contact No</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contact in contacts" :key="contact.id" class="is-selected has-text-black">
          <td>{{ contact.id }}</td>
          <td>{{ contact.name }}</td>
          <td>{{ contact.email }}</td>
          <td>{{ contact.designation }}</td>
          <td>{{ contact.contact_no }}</td>
          <td><button class="button is-danger" @click.prevent="deleteContact(contact.id)">Delete</button></td>
          <td><router-link :to="{name:'EditContact',params:{id: contact.id}}" class="button is-primary" >Edit</router-link></td>

        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ContactList",
  data() {
    return {
      contacts: []
    };
  },
  created() {
    this.getContacts();
  },
  methods: {
    async getContacts() {
      let url = "http://127.0.0.1:8000/api/contact";
      try {
        const response = await axios.get(url);
        this.contacts = response.data.contacts;
        console.log(this.contacts);
      } catch (error) {
        console.log(error);
      }
    },
    async deleteContact(id) {
      let url = `http://127.0.0.1:8000/api/delete_contact/${id}`;
      try {
        const response = await axios.delete(url);
        if (response.data.code === 200) {
          alert(response.data.message);
          this.getContacts();
        }
      } catch (error) {
        console.log(error);
      }
    }
  },
  mounted() {
    console.log("Contact List Component Mounted");
  }
};
</script>

