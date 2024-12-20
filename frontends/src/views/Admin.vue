<template>
  <div>
    <Navbar/>
    <div class="container mt-5">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" :class="{ active: activeTab === 'user' }" @click.prevent="activeTab = 'user'">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" :class="{ active: activeTab === 'ibanList' }" @click.prevent="activeTab = 'ibanList'">IBAN List</a>
        </li>
      </ul>

      <div class="tab-content mt-3">
        <div v-show="activeTab === 'user'">
          <h2 class="fw-bold">IBAN List</h2>
          <table class="table table-bordered">
            <thead class="fw-bold">
              <tr>
                <th class="fw-bold">IBAN Number</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="iban in ibanList.data" :key="iban.id">
                <td>{{ iban.iban }}</td>
              </tr>
            </tbody>
          </table>
          <!-- Pagination Controls -->
          <nav>
            <ul class="pagination">
              <li class="page-item" :class="{ disabled: ibanList.current_page === 1 }">
                <a class="page-link" href="#" @click="fetchIbanList(ibanList.current_page - 1)">Previous</a>
              </li>
              <li class="page-item" :class="{ disabled: ibanList.current_page === ibanList.last_page }">
                <a class="page-link" href="#" @click="fetchIbanList(ibanList.current_page + 1)">Next</a>
              </li>
            </ul>
          </nav>
        </div>
        <div v-show="activeTab === 'ibanList'">
          <h2 class="fw-bold">IBAN Detail Record</h2>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="fw-bold">User ID</th>
                <th class="fw-bold"> User Name</th>
                <th class="fw-bold">Email</th>
                <th class="fw-bold">IBAN Number</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="detail in ibanList.data" :key="detail.id">
                <td>{{ detail.user_id }}</td>
                <td>{{ detail.name }}</td>
                <td>{{ detail.email }}</td>
                <td>{{ detail.iban }}</td>
              </tr>
            </tbody>
          </table>
          <!-- Pagination Controls -->
          <nav>
            <ul class="pagination">
              <li class="page-item" :class="{ disabled: ibanList.current_page === 1 }">
                <a class="page-link" href="#" @click="fetchIbanList(ibanList.current_page - 1)">Previous</a>
              </li>
              <li class="page-item" :class="{ disabled: ibanList.current_page === ibanList.last_page }">
                <a class="page-link" href="#" @click="fetchIbanList(ibanList.current_page + 1)">Next</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
import axios from 'axios';
import Navbar from '@/components/Navbar.vue';
import Pagination from '@/components/Pagination.vue';
import config from '@/config';
export default {
  components: {
    Navbar,
    Pagination  // Make sure to register the Pagination component here
  },
  data() {
  return {
    activeTab: 'user',
    ibanList: {
      data: [],
      current_page: 1,
      last_page: 1,
      links: []
    },
    apiUrl:config.apiUrl
  };
},
methods: {
  fetchIbanList(page = 1) {
    // First, ensure CSRF protection by retrieving the CSRF cookie
    axios.get('/sanctum/csrf-cookie').then(response => {
      // After ensuring the CSRF cookie is set, make the actual GET request
      axios.get(`${this.apiUrl}/v1/users/ibans/list?page=${page}`, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')  // Ensure you have the auth token
        }
      })
      .then(response => {
        this.ibanList = response.data;
      })
      .catch(error => {
        console.error('Error fetching IBAN list:', error);
      });
    }).catch(error => {
      console.error('Error retrieving CSRF token:', error);
    });
  }
},

  mounted() {
    this.fetchIbanList();
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

