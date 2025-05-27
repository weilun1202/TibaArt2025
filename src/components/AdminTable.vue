<template>
  <div class="table-wrapper">
    <table class="custom-table">
      <thead>
        <tr>
          <th
            v-for="col in columns"
            :key="col.key"
            @click="toggleSort(col.key)"
          >
            {{ col.label }}
            <span v-if="sortKey === col.key">
              {{ sortOrder === 'asc' ? '▲' : '▼' }}
            </span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(row, rowIndex) in sortedData"
          :key="rowIndex"
        >
          <td
            v-for="col in columns"
            :key="col.key"
          >
            {{ row[col.key] }}
          </td>
        </tr>
        <tr v-if="!sortedData.length">
          <td :colspan="columns.length" class="empty">
            無資料
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  columns: Array, // [{ key: 'name', label: '姓名' }]
  data: Array,    // [{ name: '小明', ... }]
})

const sortKey = ref(null)
const sortOrder = ref('asc')

function toggleSort(key) {
  if (sortKey.value === key) {
    sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc'
  } else {
    sortKey.value = key
    sortOrder.value = 'asc'
  }
}

const sortedData = computed(() => {
  if (!sortKey.value) return props.data
  return [...props.data].sort((a, b) => {
    const valA = a[sortKey.value]
    const valB = b[sortKey.value]
    if (valA === valB) return 0
    if (sortOrder.value === 'asc') return valA > valB ? 1 : -1
    return valA < valB ? 1 : -1
  })
})
</script>

<style lang="scss" scoped>
@import '/style.scss';
.table-wrapper {
  overflow-x: auto;
}

.custom-table {
  width: 100%;
  border-collapse: collapse;
  background-color: white;
}

.custom-table thead {
  background-color: $primaryGreen;
  color: #fff;
}

.custom-table th,
.custom-table td {
  border: 1px solid #ddd;
  padding: 8px 12px;
  text-align: left;
}

.custom-table th {
  cursor: pointer;
  user-select: none;
}

.custom-table tbody tr:hover {
  background-color: #f9f9f9;
}

.custom-table .empty {
  text-align: center;
  color: #888;
  padding: 16px;
}
</style>
