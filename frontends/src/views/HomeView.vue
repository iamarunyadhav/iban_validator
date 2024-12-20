<template>
  <div>
    <Navbar />
    <div class="container mt-5">
        <header class="py-5 mb-4 border-bottom">
            <div class="container text-center">
              <h1 class="display-4 fw-bold">IBAN Validator</h1>
              <p class="lead text-white">Ensure secure and efficient operations.</p>
            </div>
        </header>

      <!-- Feature Cards Section -->
      <div class="row text-center mt-5">
        <!-- User Registration -->
        <div class="col-lg-6 mb-4">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <h2 class="card-title">Register & Join</h2>
              <p class="card-text">Sign up to access IBAN numbers Validation with ease.</p>
              <router-link to="/register" class="btn btn-primary">Sign Up Now</router-link>
            </div>
          </div>
        </div>

        <!-- User Login -->
        <div class="col-lg-6 mb-4">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <h2 class="card-title">Secure Login</h2>
              <p class="card-text">Log in securely to access your IBAN validations.</p>
              <router-link to="/login" class="btn btn-primary">Access Account</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer/>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';


export default {
  components: {
    Navbar,
    Footer
  }
};
</script>

<style scoped>
header {
  background-color: #007bff; /* A vibrant primary color */
  background-image: linear-gradient(315deg, #007bff 0%, #004785 100%);
  color: #ffffff;
}

/* Global card styling enhancements */
.card {
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

/* Button enhancements */
.btn-primary {
  background-color: #007bff;
  border-color: #0062cc;
}

.btn-primary:hover {
  background-color: #005cbf;
  border-color: #004085;
}

/* Footer enhancements if needed */
footer {
  background-color: #f8f9fa;
  padding: 20px 0;
  font-size: 0.875rem;
  text-align: center;
  border-top: 1px solid #dee2e6;
}

@media (max-width: 768px) {
  .header {
    padding-top: 36px;
    padding-bottom: 36px;
  }

  .btn {
    padding: .375rem .75rem;
  }
}
</style>
