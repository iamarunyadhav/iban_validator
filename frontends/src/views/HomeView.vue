<template>
  <div>
    <Navbar />
    <div class="container mt-5">
      <header class="py-5 mb-4 border-bottom">
        <div class="container">
          <div class="text-center my-5">
            <h1 class="fw-light">IBAN VALIDATOR</h1>
            <p class="lead text-muted">
            ensure secure and efficient operations.
            </p>
          </div>
        </div>
      </header>

      <!-- Feature Cards Section -->
      <div class="row text-center">
        <!-- User Registration -->
        <div class="col-lg-6 mb-5">
          <div class="card h-100 shadow border-0">
            <div class="card-body">
              <h2 class="card-title">Register & Join</h2>
              <p class="card-text">
                Sign up to access personalized features and begin validating IBAN numbers with ease and precision.
              </p>
              <router-link to="/register" class="btn btn-primary">Sign Up Now</router-link>
            </div>
          </div>
        </div>

        <!-- User Login -->
        <div class="col-lg-6 mb-5">
          <div class="card h-100 shadow border-0">
            <div class="card-body">
              <h2 class="card-title">Secure Login</h2>
              <p class="card-text">
                Log in securely to access your dashboard and manage IBAN validations and settings.
              </p>
              <router-link to="/login" class="btn btn-primary">Access Account</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
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
  background-color: #f8f9fa;
  background-image: linear-gradient(180deg, #f8f9fa 10%, #fff 100%);
  padding-top: 48px;
  padding-bottom: 48px;
}
</style>
