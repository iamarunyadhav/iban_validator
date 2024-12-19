<template>
  <div>
    <Navbar/>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg">
          <h5 class="card-header bg-primary text-white">IBAN Validator</h5>
          <div class="card-body">
            <form @submit.prevent="validateIban">
              <div class="mb-3 position-relative">
                <label for="iban" class="form-label">Enter IBAN Number</label>
                <input type="text" class="form-control" id="iban" v-model="iban" required
                  placeholder="e.g., DE89 3704 0044 0532 0130 00">
                <div class="invalid-tooltip" v-show="!isValid && iban.length">
                  Please enter a valid IBAN.
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100">Validate</button>
            </form>
            <transition name="fade">
              <div v-if="validationMessage" class="alert mt-3" :class="{'alert-success': isValid, 'alert-danger': !isValid}" role="alert">
                {{ validationMessage }}
              </div>
            </transition>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Footer/>
  </div>
</template>
<script>
export default {
  data() {
    return {
      iban: '',
      validationMessage: '',
      isValid: false
    };
  },
  methods: {
    validateIban() {
      const regex = /^([A-Z]{2}\d{2}[A-Z\d]{1,30})$/;
      this.isValid = regex.test(this.iban);
      this.validationMessage = this.isValid ? 'IBAN is valid!' : 'Invalid IBAN number.';
    }
  }
};
</script>


<style scoped>
.invalid-tooltip {
  position: absolute;
  top: 100%;
  z-index: 5;
  display: block;
  width: 100%;
  padding: .25rem .5rem;
  margin-top: .1rem;
  font-size: .875em;
  color: #f8d7da;
  background-color: #f5c2c7;
  border-radius: .25rem;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0;
}
</style>

