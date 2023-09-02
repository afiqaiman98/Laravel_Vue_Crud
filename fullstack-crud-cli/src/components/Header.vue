<template>
  <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="container">
      <div class="navbar-brand">
        <a class="navbar-item" href="#">{{ title }}</a>
        <a
          role="button"
          class="navbar-burger"
          aria-label="menu"
          aria-expanded="false"
          data-target="navbarColor01"
          @click="toggleMobileMenu"
        >
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>

      <div :class="['navbar-menu', { 'is-active': isMobileMenuActive }]" id="navbarColor01">
        <div class="navbar-start">
          <router-link class="navbar-item is-active" to="/">
            Home
          </router-link>
          <router-link class="navbar-item" to="add_contact">
            Add Contact
          </router-link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'AppHeader',
  props: {
    title: String,
  },
  data() {
    return {
      isMobileMenuActive: false,
    };
  },
  methods: {
    toggleMobileMenu() {
      this.isMobileMenuActive = !this.isMobileMenuActive;
    },
  },
};
</script>
