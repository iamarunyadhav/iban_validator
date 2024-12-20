<template>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #007bff">
    <div class="container-fluid">
      <router-link class="navbar-brand text-white fw-bold ms-3" to="/" style="margin-left: 20px;">
          <i class="fas fa-home"></i> Home
       </router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item" v-if="!isAuthenticated">
            <router-link class="nav-link navbar-brand text-white fw-bold" to="/login">Login</router-link>
          </li>
          <li class="nav-item" v-if="!isAuthenticated">
            <router-link class="nav-link navbar-brand text-white fw-bold" to="/register">Sign Up</router-link>
          </li>
          <li class="nav-item" v-if="isAuthenticated">
            <button class="nav-link navbar-brand text-white btn btn-link fw-bold" @click="logout">Logout</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<<script>
import { mapGetters, mapActions } from 'vuex';
import config from '@/config';
import axios from 'axios';
export default {
  name: 'Navbar',
  data() {
    return {
      apiUrl:config.apiUrl
    }
  },
  computed: {
    ...mapGetters([
      'isAuthenticated'
    ])
  },

  methods: {
    logout() {
        axios.post(`${this.apiUrl}/v1/logout`,localStorage.getItem('token'), {
          headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token')
          }
        })
        .then(response => {
          this.$router.push('/login');
        })
        .catch(error => {
          this.$router.push('/');
        });
  }
}}
</script>
