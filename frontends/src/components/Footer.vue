<template>
  <footer class="footer">
    <div class="container text-center">
      Powered by Ascentic © {{ currentYear }}
    </div>
  </footer>
</template>

<script>
export default {
  name: 'FooterBar',
  data() {
    return {
      currentYear: new Date().getFullYear()  // Gets the current year dynamically
    };
  }
}
</script>

<style scoped>
.footer {
  padding: 20px;
  background-color: #f8f9fa;
  border-top: 1px solid #e7e7e7;
  color: #777;
  position: absolute;
  bottom: 0;
  width: 100%;
}
.container {
  padding: 10px;
  text-align: center;
}
</style>
