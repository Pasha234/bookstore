const app = Vue.createApp({
  data() {
    return {
      loading: false,
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      orders: [],
    }
  },
  created() {
    this.fetchOrders()
  },
  methods: {
    fetchOrders() {
      fetch(`/api/orders`)
        .then(response => response.json())
        .then(result => this.orders = result)
    }
  }
})

const vm = app.mount('#container')