<style lang="scss">
.pagination {
  justify-content: flex-end !important;
  .page-stats {
    align-items: center;
    margin-right: px;
  }
  i {
    color: #3273dc !important;
  }
}
</style>
<template>
  <nav class="pagination">
    <span class="page-stats">{{ pagination.from }} - {{ pagination.to }} of {{ pagination.total }}</span>
    <a
      v-if="pagination.prevPageUrl"
      class="btn btn-sm"
      @click="$emit('prev');"
    >Prev</a>
    <a v-else class="btn btn-sm" :disabled="true">Prev</a>

    <a
      v-if="pagination.nextPageUrl"
      class="btn btn-sm"
      @click="$emit('next');"
    >Next</a>
    <a v-else class="btn btn-smt" :disabled="true">Next</a>
  </nav>
</template>
<script>
export default {
  props: ["pagination"],
};
</script>