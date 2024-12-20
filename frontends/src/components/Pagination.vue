
<template>
  <div class="pagination-wrapper">
    <button @click="changePage(ibanList.current_page - 1)" :disabled="ibanList.current_page <= 1">Prev</button>
    <span>Page {{ ibanList.current_page }} of {{ ibanList.last_page }}</span>
    <button @click="changePage(ibanList.current_page + 1)" :disabled="ibanList.current_page >= ibanList.last_page">Next</button>
  </div>
</template>

<script>
export default {
  props: ['ibanList'],
  methods: {
    changePage(page) {
      this.$emit('paginate', page);
    }
  }
}
</script>
