import { ref, computed } from 'vue'

// 全域購物車狀態
const cartItems = ref([])

// 初始化時從 localStorage 讀取資料
const initCart = () => {
  const savedCart = localStorage.getItem('shoppingCart')
  if (savedCart) {
    try {
      cartItems.value = JSON.parse(savedCart)
    } catch (error) {
      console.error('讀取購物車資料失敗:', error)
      cartItems.value = []
    }
  }
}

// 儲存購物車到 localStorage
const saveCartToStorage = () => {
  localStorage.setItem('shoppingCart', JSON.stringify(cartItems.value))
}

export function useCart() {
  // 確保初始化
  if (cartItems.value.length === 0) {
    initCart()
  }

  // 加入購物車
  const addToCart = (product, quantity = 1) => {
    const existingItem = cartItems.value.find(item => item.id === product.id)

    if (existingItem) {
      // 如果商品已存在，增加數量
      existingItem.quantity += quantity
    } else {
      // 如果商品不存在，新增到購物車
      cartItems.value.push({
        ...product,
        quantity: quantity
      })
    }

    saveCartToStorage()
    console.log('已加入購物車:', product.name, '數量:', quantity)

    return true
  }

  // 移除購物車商品
  const removeFromCart = (productId) => {
    const index = cartItems.value.findIndex(item => item.id === productId)
    if (index > -1) {
      cartItems.value.splice(index, 1)
      saveCartToStorage()
    }
  }

  // 更新商品數量
  const updateQuan = (productId, newQuan) => {
    const item = cartItems.value.find(item => item.id === productId)
    if (item) {
      if (newQuan <= 0) {
        removeFromCart(productId)
      } else {
        item.quantity = newQuan
        saveCartToStorage()
      }
    }
  }

  // 清空購物車
  const clearCart = () => {
    cartItems.value = []
    localStorage.removeItem('shoppingCart')
  }

  // 計算購物車總數量
  const totalItems = computed(() => {
    return cartItems.value.reduce((total, item) => total + item.quantity, 0)
  })

  // 計算購物車總金額
  const totalPrice = computed(() => {
    return cartItems.value.reduce((total, item) => total + (item.price * item.quantity), 0)
  })

  return {
    cartItems,
    addToCart,
    removeFromCart,
    updateQuan,
    clearCart,
    totalItems,
    totalPrice
  }
}