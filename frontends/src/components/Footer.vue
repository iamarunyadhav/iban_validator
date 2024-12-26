<template>
  <footer class="footer">
    <div class="container text-center text-white">
      POC Powered by Ascentic© {{ currentYear }}
    </div>
  </footer>
</template>

<script>
export default {
  name: 'FooterBar',
  data() {
    return {
      currentYear: new Date().getFullYear(), // Gets the current year dynamically
    };
  },
};
</script>

<style scoped>
.footer {
  background-color: #007bff;
  color: #ffffff;
  padding: 10px 0;
  text-align: center;
  width: 100%;
  position: fixed; /* Makes the footer fixed */
  bottom: 0; /* Positions it at the bottom of the page */
  left: 0;
  z-index: 1000; /* Ensures the footer stays on top of other content */
}
</style>
