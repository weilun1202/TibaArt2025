// /stores/memExpo.js
import { defineStore } from 'pinia'
import axios from 'axios'

export const useExpoStore = defineStore('expo', {
  state: () => ({
    expos: [],
    loading: false,
    error: null
  }),
  actions: {
    async fetchExposByArtistId(artistId) {
      this.loading = true
      try {
        const res = await axios.get(`http://localhost/TIBAART/getMemExpo.php?id=${artistId}`)
        // const res = await axios.get(`https://tibamef2e.com/tjd101/g2/api/getMemExpo.php?id=${artistId}`) // 正式版
        this.expos = res.data
      } catch (err) {
        this.error = err
      } finally {
        this.loading = false
      }
    }
  }
})
