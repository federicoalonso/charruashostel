<template>
  <table class="table is-bordered data-table">
    <thead class="thead-dark">
      <tr>
        <th
          v-for="column in columns"
          :key="column.name"
          @click="$emit('sort', column.name)"
          :style="'width:' + column.width + ';' + 'cursor:pointer;'"
        >
            {{ column.label }}
            <a><i :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'fa fa-sort-up' : 'fa fa-sort-down') : 'fa fa-sort'"></i></a>
        </th>
      </tr>
    </thead>
    <slot></slot>
  </table>
</template>

<script>
export default {
  props: ["columns", "sortKey", "sortOrders"],
};
</script>
