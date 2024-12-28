<template>
  <div>
    <Navbar/>
    <div class="container mt-5">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" :class="{ active: activeTab === 'info' }" href="#" @click.prevent="activeTab = 'info'">IBAN Info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" :class="{ active: activeTab === 'validator' }" href="#" @click.prevent="activeTab = 'validator'">IBAN Validator</a>
        </li>
      </ul>

      <div class="tab-content mt-3">
        <div v-show="activeTab === 'info'" class="container">
          <h2 class="mb-3">IBAN Format and Structure Information</h2>
          <p><strong>IBAN Structure Validation:</strong> This includes checking the specific positions and characters inside the IBAN as per each country's internal rules. This check is crucial where internal account number check digit validation is not supported.</p>
          <p><strong>Possible Outcomes:</strong></p>
          <ul>
            <li>IBAN Formatting and Structure is valid!</li>
            <li>IBAN Formatting and Structure is not valid!</li>
          </ul>
          <h4>Format and Structure Checks Include:</h4>
          <ul>
            <li>Bank code position - Ensures the bank identifier is in the correct place.</li>
            <li>Branch identifier position - Checks are performed for 58 countries that include branch codes.</li>
            <li>National check digit position - This is checked only for countries supporting internal check digits.</li>
            <li>Structure validation - Assesses if bank and branch codes, if applicable, are alpha, numeric, or alphanumeric.</li>
          </ul>
        </div>

        <div v-show="activeTab === 'validator'" class="row justify-content-center">
          <div class="col-md-10">
            <div class="card mb-3">
              <h5 class="card-header">Example IBAN for the United Kingdom</h5>
              <div class="row card-body">
                <div class="row">
                  <div class="col-md-3">
                    <p><strong>Country Code:</strong> GB (Great Britain)</p>
                  </div>
                  <div class="col-md-2">
                    <p><strong>Check Digits:</strong> 12</p>
                  </div>
                  <div class="col-md-2">
                    <p><strong>Bank Code:</strong> ABCD</p>
                  </div>
                  <div class="col-md-2">
                    <p><strong>Branch Code:</strong> 123***</p>
                  </div>
                  <div class="col-md-3">
                    <p><strong>Bank Account Number:</strong> 123*****</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <h5 class="card-header">IBAN Validator</h5>
              <div class="card-body">
                <form @submit.prevent="validateIban">
                  <div class="mb-3">
                    <label for="iban" class="form-label">Enter IBAN Number</label>
                    <input type="text" class="form-control" id="iban" v-model="iban" required placeholder="Enter IBAN here">
                  </div>
                  <button type="submit" class="btn btn-primary">Validate</button>
                </form>
                <div v-if="validationMessage" class="alert mt-3" :class="{'alert-success': isValid, 'alert-danger': !isValid}" role="alert">
                  {{ validationMessage }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer/>
  </div>
</template>

<script>
import axios from 'axios';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import config from '@/config';
import { getCsrfCookie, validateIban } from '@/services/IbanService';

export default {
  components: {
    Navbar,
    Footer
  },
  data() {
    return {
      activeTab: 'info',
      iban: '',
      validationMessage: '',
      isValid: false,
      apiUrl: config.apiUrl
    };
  },
  methods: {
    async validateIban() {
      this.iban = this.iban.replace(/\s+/g, ''); // Normalize input
      const regex = /^([A-Z]{2}\d{2}[A-Z\d]{1,30})$/;

      if (!regex.test(this.iban)) {
        this.isValid = false;
        this.validationMessage = 'Invalid IBAN format. Please check and try again.';
        return;
        setTimeout(() => {
          this.validationMessage = '';
        }, 3000);
      }

      try {
        await getCsrfCookie();
        const response = await validateIban(this.iban, localStorage.getItem('token'));
        this.isValid = true;
        this.validationMessage = response.data.message || 'IBAN is valid!';

        setTimeout(() => {
          this.isValid = false;
          this.validationMessage = '';
          this.$router.push(response.data.user_role === 'admin' ? '/admin-dashboard' : '/user-dashboard');
        }, 3000); // Redirect after showing message for 3 seconds
      } catch (error) {
        this.isValid = false;
        this.validationMessage = (error.response && error.response.data.message) || 'Network or server error occurred while validating IBAN.';
        setTimeout(() => {
          this.validationMessage = '';
        }, 3000);
      }
    }
  }
};
</script>


<style scoped>
/* General Page Styling */
.container {
  max-width: 960px;
  margin: 0 auto;
  font-family: 'Arial', sans-serif;
  color: #333;
}

/* Navigation Tabs */
.nav-tabs {
  border-bottom: 2px solid #007bff;
  margin-bottom: 20px;
}

.nav-tabs .nav-link {
  color: #007bff;
  border: 1px solid transparent;
  border-radius: 0;
  padding: 10px 15px;
  font-size: 16px;
  transition: background-color 0.3s, border-color 0.3s, color 0.3s;
}

.nav-tabs .nav-link:hover {
  color: #0056b3;
  background-color: #f1f1f1;
  border-color: #ddd;
}

.nav-tabs .nav-link.active {
  background-color: #007bff;
  color: #fff;
  border-color: #007bff #007bff transparent;
  font-weight: bold;
}

/* Card Styling */
.card {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border: none;
  border-radius: 8px;
  overflow: hidden;
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

/* Form Styling */
.form-label {
  font-size: 16px;
  font-weight: bold;
  color: #555;
}

.form-control {
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 15px;
  padding: 10px;
  transition: border-color 0.3s;
}

.form-control:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Button Styling */
.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.3s, box-shadow 0.3s;
}

.btn-primary:hover {
  background-color: #0056b3;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

/* Alerts */
.alert {
  border-radius: 5px;
  font-size: 15px;
}

.alert-success {
  background-color: #d4edda;
  border-color: #c3e6cb;
  color: #155724;
}

.alert-danger {
  background-color: #f8d7da;
  border-color: #f5c6cb;
  color: #721c24;
}

/* Responsive Design */
@media (max-width: 768px) {
  .card-body {
    padding: 15px;
  }

  .form-label {
    font-size: 14px;
  }

  .btn-primary {
    padding: 8px 15px;
    font-size: 14px;
  }

  .nav-tabs .nav-link {
    font-size: 14px;
    padding: 8px 10px;
  }
}
</style>
