<template>
  <div class="search-table">
    <!-- 搜尋 -->
    <div class="search-bar">
      <label>搜尋欄位：</label>
      <select v-model="selectedKey">
        <option disabled value="">請選擇欄位</option>
        <option v-for="col in columns" :key="col.key" :value="col.key">
          {{ col.label }}
        </option>
      </select>

      <input
        type="text"
        v-model="keyword"
        placeholder="輸入搜尋關鍵字"
        :disabled="!selectedKey"
      />
      <!-- 新增按鈕 -->
      <button class="add-button btn" @click="handleAdd">＋ 新增資料</button>
    </div>

    <!-- 表格 -->
    <table class="result-table">
      <thead>
        <tr>
          <th v-for="col in columns" :key="col.key" :class="col.class">
            {{ col.label }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(row, index) in paginatedData" :key="index">
          <td v-for="col in columns" :key="col.key" :class="col.class">
            <!-- 狀態欄位：開關按鈕 -->
              <template v-if="col.type === 'switch'">
                <button
                  @click="toggleStatus(row)"
                  :class="['switch-btn', row.status ? 'on' : 'off']"
                >
                  {{ row.status ? '啟用' : '停用' }}
                </button>
              </template>
              <!-- 狀態欄位：下拉選單 -->
              <template v-else-if="col.type === 'select'">
                <select v-model="row[col.key]" @change="handleStatusChange(row)">
                  <option
                    v-for="option in col.options || []"
                    :key="option"
                    :value="option"
                  >
                    {{ option }}
                  </option>
                </select>
              </template>
              <!-- 詳細按鈕 -->
              <template v-else-if="col.type === 'button'">
                <button 
                @click="emit('view-more', row)"
                class="more-btn">
                  {{ col.buttonLabel || '查看' }}
                </button>
              </template>
            
            <template v-else>
              {{ row[col.key] }}
            </template>
          </td>
        </tr>
        <tr v-if="paginatedData.length === 0">
          <td :colspan="columns.length" class="empty">無符合資料</td>
        </tr>
      </tbody>
    </table>

    <!-- 分頁器 -->
    <div class="pagination" v-if="totalPages > 1">
      <button @click="prevPage" :disabled="currentPage === 1">上一頁</button>
      <span>第 {{ currentPage }} 頁 / 共 {{ totalPages }} 頁</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">下一頁</button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
  columns: Array,
  data: Array
})

const emit = defineEmits(['add', 'toggle-status', 'status-change', 'view-more'])

const selectedKey = ref('')
const keyword = ref('')
const currentPage = ref(1)
const itemsPerPage = 10


// 篩選後的資料
const filteredData = computed(() => {
  if (!selectedKey.value || !keyword.value) 
  return props.data
  return props.data.filter(row => {
    const value = row[selectedKey.value]?.toString() || ''
    return value.includes(keyword.value)
  })
})

// 分頁後的資料
const paginatedData = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  return filteredData.value.slice(start, start + itemsPerPage)
})

const totalPages = computed(() =>
  Math.ceil(filteredData.value.length / itemsPerPage)
)

function prevPage() {
  if (currentPage.value > 1) currentPage.value--
}

function nextPage() {
  if (currentPage.value < totalPages.value) currentPage.value++
}

function handleAdd() {
  emit('add')
}

// 當篩選條件改變時，重設到第 1 頁
watch([selectedKey, keyword], () => {
  currentPage.value = 1
})


// 狀態按鈕開關
function toggleStatus(row) {
  row.status = !row.status
  emit('toggle-status', row)  // 通知外層
}

function handleStatusChange(row) {
  emit('status-change', row)
}

</script>



<style lang="scss" scoped>
@import '/style.scss';

.search-table {
  padding: 16px;
}
/* 搜尋 */

.search-bar {
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  gap: 16px;
  flex-wrap: wrap;
}

.search-bar input,
.search-bar select {
  padding: 10px;
  font-size: 16px;
}

/* 新增按鈕 */
.btn{
  font-size: 16px;
  line-height: 42px;
}

/* 表格 */
.result-table {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed;
}

.result-table th,
.result-table td {
  border: 1px solid #ddd;
  padding: 16px;
  text-align: left;
}

.result-table th {
  background-color: $primaryGreen;
  color: #fff;
}

.result-table tbody tr:hover{
  background-color: #eee;
}

.result-table .empty {
  text-align: center;
  color: #888;
  padding: 16px;
}

/* 分頁器 */
.pagination {
  margin-top: 16px;
  display: flex;
  align-items: center;
  gap: 16px;
}

.pagination button {
  padding: 16px;
  background-color: #eee;
  border: 1px solid #ccc;
  cursor: pointer;
}

.pagination button:disabled {
  background-color: #f9f9f9;
  color: #aaa;
  cursor: default;
}

// 狀態按鈕
.switch-btn {
  padding: 6px 12px;
  border: none;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  transition: 0.2s ease;
}

.switch-btn.on {
  background-color: $logoColor4;
  color: white;
}

.switch-btn.off {
  background-color: #ccc;
  color: white;
}

// 查看按鈕
.more-btn{
  padding: 6px 12px;
  border: none;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  background-color: $logoColor3;
  color: white;
  &:hover{
    background-color: lighten($logoColor3, 10%);
  }
}

// 表格長寬
@for $i from 1 through 200 {
  @if $i % 10 == 0{
    .w-#{$i} {
      width: #{$i}px;
    }
  }
}
.ellipsis {
  box-sizing: border-box;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

</style>
