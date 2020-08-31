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
    <span class="page-stats ml-1">{{ pagination.from }} - {{ pagination.to }} de {{ pagination.total }}</span>
    <a
      v-if="pagination.prevPageUrl"
      class="btn btn-sm btn-outline-info ml-1"
      @click="$emit('prev');"
    >Anterior</a>
    <a v-else class="btn btn-sm btn-outline-info ml-1" :disabled="true">Anterior</a>

    <a
      v-if="pagination.nextPageUrl"
      class="btn btn-sm btn-outline-info ml-1"
      @click="$emit('next');"
    >Siguiente</a>
    <a v-else class="btn btn-sm btn-outline-info ml-1" :disabled="true">Siguiente</a>
  </nav>
</template>
<script>
export default {
  props: ["pagination"],
};
</script>