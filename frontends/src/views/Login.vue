<template>
  <div>
    <Navbar/>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login</h2>
            <form @submit.prevent="login">
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" v-model="form.email" placeholder="Enter email">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" v-model="form.password" placeholder="Password">
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign In</button>
              </div>
            </form>
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
export default {
  components: {
    Navbar,
    Footer
  },
  data() {
    return {
      form: {
        email: '',
        password: ''
      }
    };
  },
  methods: {
  login() {
    axios.get('/sanctum/csrf-cookie').then(response => {
      axios.post('http://127.0.0.1:8000/api/v1/login', this.form, { withCredentials: true })
        .then(response => {
          console.log('Logged in:', response.data.token);
          // this.$store.commit('setUserId', response.data.user_id);
          this.$store.commit('setAuthentication', true);
          localStorage.setItem('token',response.data.token);
          if (response.data.user_role === 'admin') {
            this.$router.push('/admin-dashboard');
          } else {
            this.$router.push('/user-dashboard');
          }
        })
        .catch(error => {
          console.error('Login error:', error);
          alert('Login failed: ' + (error.response.data.message || 'Unknown error'));
        });
    }).catch(error => {
      console.error('CSRF cookie error:', error);
    });
  }
}

};
</script>

<style scoped>
/* Overall container and spacing adjustments */
.container {
  max-width: 600px; /* Confine to a moderate width for focus */
  margin: auto; /* Centering the container */
  padding-top: 40px; /* Space from the top */
}

/* Card styling for depth and focus */
.card {
  border: none;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for 3D effect */
  background-color: #ffffff; /* Bright and clean background */
}

/* Card body for internal spacing */
.card-body {
  padding: 2rem;
}

/* Title styling for emphasis and alignment */
.card-title {
  color: #0056b3; /* A shade of blue for a professional tone */
  text-align: center;
  margin-bottom: 1.5rem;
  font-size: 1.75rem; /* Slightly larger size for visibility */
}

/* Form label adjustments for clarity */
.form-label {
  font-size: 1rem;
  color: #495057; /* Dark grey for readability */
  font-weight: bold; /* Bold text for better label definition */
}

/* Input field styling for aesthetics and interaction */
.form-control {
  border-radius: 0.375rem;
  border: 1px solid #ced4da;
  padding: 0.75rem 1rem;
  font-size: 1rem;
  transition: border-color 0.3s, box-shadow 0.3s; /* Smooth transition for focus */
}

/* Focus effects for input fields */
.form-control:focus {
  border-color: #80bdff;
  outline: none;
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25); /* Blue glow for focus indication */
}

/* Button styling for interaction */
.btn-primary {
  background-color: #007bff; /* Vibrant blue for action buttons */
  border-color: #007bff;
  color: #ffffff;
  font-size: 1rem;
  padding: 0.75rem 1.2rem;
  border-radius: 0.375rem;
  transition: background-color 0.2s, box-shadow 0.2s; /* Smooth transitions for mouse interactions */
}

/* Button hover and focus states for interactive feedback */
.btn-primary:hover {
  background-color: #0056b3; /* Darker blue on hover for visual feedback */
  border-color: #004085;
}

.btn-primary:focus {
  box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5); /* Matching blue shadow for focus */
}

/* Grid system adjustments for better control over button layout */
.d-grid {
  margin-top: 20px; /* Space above the button grid */
}
</style>

