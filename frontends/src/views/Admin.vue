<template>
  <div>
    <Navbar/>
    <div class="container mt-5">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" :class="{ active: activeTab === 'user' }" @click.prevent="activeTab = 'user'">IBAN List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" :class="{ active: activeTab === 'ibanList' }" @click.prevent="activeTab = 'ibanList'">Users IBAN List</a>
        </li>
      </ul>
      <div class="tab-content mt-3">
        <div v-show="activeTab === 'user'">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="fw-bold">IBAN Number</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="detail in ibanList.data" :key="detail.id">
                <td>{{ detail.iban }}</td>
              </tr>
            </tbody>
          </table>
          <nav>
            <ul class="pagination">
              <li class="page-item" :class="{ disabled: ibanList.current_page === 1 }">
                <a class="page-link" href="#" @click.prevent="loadIbanList(ibanList.current_page - 1)">Previous</a>
              </li>
              <li class="page-item" :class="{ disabled: ibanList.current_page === ibanList.last_page }">
                <a class="page-link" href="#" @click.prevent="loadIbanList(ibanList.current_page + 1)">Next</a>
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
                <th class="fw-bold">User Name</th>
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
          <nav>
            <ul class="pagination">
              <li class="page-item" :class="{ disabled: ibanList.current_page === 1 }">
                <a class="page-link" href="#" @click.prevent="loadIbanList(ibanList.current_page - 1)">Previous</a>
              </li>
              <li class="page-item" :class="{ disabled: ibanList.current_page === ibanList.last_page }">
                <a class="page-link" href="#" @click.prevent="loadIbanList(ibanList.current_page + 1)">Next</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <Footer/>
  </div>
</template>




<script>
import { fetchIbanList } from '@/services/IbanService'; // adjust path as needed
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
export default {
  components: {
    Navbar,
    Footer
  },
  data() {
    return {
      activeTab: 'user',
      ibanList: {
        data: [],
        current_page: 1,
        last_page: 1
      }
    };
  },
  methods: {
    loadIbanList(page) {
      const token = localStorage.getItem('token'); // assuming token is stored here
      fetchIbanList(page, token).then(response => {
        this.ibanList.data = response.data.data;
        this.ibanList.current_page = response.data.current_page;
        this.ibanList.last_page = response.data.last_page;
      }).catch(error => {
        console.error('Error fetching data:', error);
        // handle error appropriately
      });
    }
  },
  created() {
    this.loadIbanList(this.ibanList.current_page); // Load initial page
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

