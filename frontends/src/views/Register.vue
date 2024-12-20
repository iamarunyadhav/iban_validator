<template>
  <div>
    <Navbar/>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Register</h2>
            <form @submit.prevent="register">
              <!-- Name field -->
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" v-model="form.name" placeholder="Enter your name">
              </div>
              <!-- Email field -->
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" v-model="form.email" placeholder="Enter your email">
              </div>
              <!-- Password field -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" v-model="form.password" placeholder="Create a password">
                <div v-if="passwordErrors" class="text-danger mt-2">
                    {{ passwordErrors }}
                  </div>
              </div>

              <!-- Password Confirmation field -->
              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" v-model="form.password_confirmation" placeholder="Repeat your password">
              </div>
              <!-- Submit button -->
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </form>
            <div v-if="validationMessage" class="alert mt-3" :class="{'alert-success': isValid, 'alert-danger': !isValid}" role="alert">
                  {{ validationMessage }}
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
export default {
  components: {
    Navbar,
    Footer
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      apiUrl: config.apiUrl ,
      validationMessage: '',
      isValid: false,
      passwordErrors: ''
    };
  },
  methods: {
    register() {

      if (!this.validatePassword(this.form.password)) {
        this.passwordErrors = 'Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, a number, and a special character.';
        return;
      }
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post(`${this.apiUrl}/v1/register`, this.form)
          .then(response => {
            this.isValid = true; // Set to true on successful register
            this.validationMessage = response.data.message || 'Successfully Registered!';
            setTimeout(() => {
              this.isValid = false;
              this.validationMessage = "";
              this.$router.push('/');
            }, 3000);
          })
          .catch(error => {
            this.isValid = false;
            this.validationMessage = error.response.data.message || 'Register failed. Please check your input data.';
            setTimeout(() => {
              this.validationMessage = "";
            }, 3000);
          });
      });
    },
    validatePassword(password) {
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
      return regex.test(password);
    }
  }
};
</script>

<style scoped>
/* Overall container and spacing adjustments */
.container {
  max-width: 600px; /* Ideal width for forms */
  margin: auto; /* Centers the container on the page */
  padding-top: 40px; /* Top padding for spacing from the header */
}

/* Card styling for a neat and focused appearance */
.card {
  border: none;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
  background-color: #ffffff; /* Clean white background for focus */
}

/* Card body styling for internal padding and alignment */
.card-body {
  padding: 2rem;
}

/* Title styling for clear section demarcation */
.card-title {
  color: #0056b3; /* Professional and calm blue */
  text-align: center;
  margin-bottom: 1.5rem; /* Spacing below the title */
  font-size: 1.75rem; /* Larger font for emphasis */
}

/* Form labels for clarity and visibility */
.form-label {
  font-size: 1rem;
  color: #495057; /* Dark grey for easy readability */
  font-weight: bold; /* Bold to highlight the input field labels */
}

/* Input field styling for ease of use and legibility */
.form-control {
  border-radius: 0.375rem;
  border: 1px solid #ced4da;
  padding: 0.75rem 1rem;
  font-size: 1rem;
  transition: border-color 0.3s, box-shadow 0.3s; /* Smooth transitions for interactive elements */
}

/* Enhanced focus state for input fields to draw attention */
.form-control:focus {
  border-color: #80bdff;
  outline: none;
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25); /* Subtle blue glow for focus */
}

/* Button styling for actions */
.btn-primary {
  background-color: #007bff; /* Bright blue for a friendly call to action */
  border-color: #007bff;
  color: #ffffff;
  font-size: 1rem;
  padding: 0.75rem 1.2rem;
  border-radius: 0.375rem;
  transition: background-color 0.2s, box-shadow 0.2s; /* Dynamic feedback for user interaction */
}

/* Button hover and focus states for feedback */
.btn-primary:hover {
  background-color: #0056b3; /* Darker blue on hover for a richer interaction */
  border-color: #004085;
}

.btn-primary:focus {
  box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5); /* Consistent styling for focused buttons */
}

/* Grid layout for button spacing */
.d-grid {
  margin-top: 20px; /* Space above the button for better visual separation */
}
</style>

