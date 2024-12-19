<template>
    <div>
      <Navbar/>
    <div class="container mt-5">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" :class="{ active: activeTab === 'user' }" href="#" @click="activeTab = 'user'">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" :class="{ active: activeTab === 'ibanList' }" href="#" @click="activeTab = 'ibanList'">IBAN List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" :class="{ active: activeTab === 'create' }" href="#" @click="activeTab = 'create'"><i class="fa fa-plus"></i> Create</a>
        </li>
      </ul>

      <div class="tab-content mt-3">
        <div v-show="activeTab === 'user'" class="container">
          <h2>Manage Users</h2>
          <!-- User management content here -->
        </div>
        <div v-show="activeTab === 'ibanList'" class="container">
          <h2>IBAN Records</h2>
          <table class="table">
            <thead>
              <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>IBAN Number</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="iban in ibanList" :key="iban.id">
                <td>{{ iban.user_id }}</td>
                <td>{{ iban.user.name }}</td>
                <td>{{ iban.user.email }}</td>
                <td>{{ iban.iban }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-show="activeTab === 'create'" class="container">
          <h2>Create New Entry</h2>
          <!-- Form to create new entries -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Navbar from '@/components/Navbar.vue';

export default {
  components: {
    Navbar
  },
  data() {
    return {
      activeTab: 'user',  // default tab
      ibanList: [],  // Array to hold the IBAN list data
    };
  },
  methods: {
    fetchIbanList() {
      axios.get('http://127.0.0.1:8000/api/v1/users/iban/list')
        .then(response => {
          this.ibanList = response.data;  // Assume the response data is the list you want
        })
        .catch(error => {
          console.error('Error fetching IBAN list:', error);
        });
    }
  },
  mounted() {
    this.fetchIbanList();  // Fetch the list when the component is mounted
  }
}
</script>



<style scoped>
.container {
  max-width: 1200px; /* Wider container for admin panel */
  margin: 0 auto;
  font-family: 'Arial', sans-serif;
  color: #333;
}

.nav-tabs {
  border-bottom: 2px solid #007bff;
  margin-bottom: 20px;
}

.nav-tabs .nav-link {
  color: #007bff;
  border: 1px solid transparent;
  border-radius: 0.25rem; /* Rounded corners for tabs */
  padding: 10px 15px;
  font-size: 16px;
  transition: background-color 0.3s, border-color 0.3s, color 0.3s;
}

.nav-tabs .nav-link:hover,
.nav-tabs .nav-link:focus {
  color: #0056b3;
  background-color: #f1f1f1;
  border-color: #ddd;
}

.nav-tabs .nav-link.active {
  background-color: #007bff;
  color: #fff;
  border-color: #007bff #007bff transparent;
}

.card {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border: none;
  border-radius: 8px;
}

.card-header {
  background-color: #007bff;
  color: #fff;
  font-size: 18px;
  font-weight: bold;
  padding: 15px;
  text-align: center;
}

.card-body {
  padding: 20px;
}

.form-control {
  border-radius: 0.25rem;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0056b3;
}

.alert {
  border-radius: 0.25rem;
}

/* Responsive Design */
@media (max-width: 768px) {
  .btn-primary,
  .form-label,
  .nav-tabs .nav-link {
    font-size: 14px;
  }
}
</style>

