const app = Vue.createApp({
  data() {
    return {
      similiarItems: [],
      loading: false,
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      product_id: window.location.pathname.match(/\/(\d+)$/m)[1],
      product: {}
    }
  },
  created() {
    this.fetchSimiliarItems()
  },
  methods: {
    fetchSimiliarItems() {
      fetch(`/api/products/${this.product_id}/getSimiliarItems`)
        .then(response => response.json())
        .then(result => this.similiarItems = result)
    },

    addInShoplist(item) {
      if (!this.loading) {
        this.loading = true
        let formData = new FormData()
        formData.append('_token', this.csrf)
        fetch(`/api/shoplist/${item.id}/add`, {
          method: 'POST',
          body: formData,
        })
          .then(response => response.json())
          .then(result => {
            if (result.success == 1) {
              item.quantity = 1
              item.shoplist_id = Number(result.id)
            } else {
              console.log('Error: cannot add an item in the shoplist');
            }
            this.loading = false
          })
      }
    },
    incrementCounter(item) {
      if (item.quantity < 999) {
        if (!this.loading) {
          this.loading = true
          let formData = new FormData()
          formData.append('quantity', item.quantity + 1)
          formData.append('_token', this.csrf)
          fetch(`/api/shoplist/${item.shoplist_id}/change_quantity`, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(result => {
              if (result.success == 1) {
                item.quantity++
              } else {
                console.log('Error: cannot increment value');
              }
              this.loading = false
            })
        }
      }
    },
    decrementCounter(item) {
      if (item.quantity > 0) {
        if (!this.loading) {
          if (item.quantity == 1) {
            this.deleteItem(item)
            return null
          }
          this.loading = true
          let formData = new FormData()
          formData.append('quantity', item.quantity - 1)
          formData.append('_token', this.csrf)
          fetch(`/api/shoplist/${item.shoplist_id}/change_quantity`, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(result => {
              if (result.success == 1) {
                item.quantity--
              } else {
                console.log('Error: cannot decrement value');
              }
              this.loading = false
            })
        }
      }
    },
    inputQuantity(event, item) {
      event.preventDefault()
      if (!isNaN(Number(event.target.value)) && Number(event.target.value) >= 0) {
        if (!this.loading) {
          if (Number(event.target.value) === 0) {
            this.deleteItem(item)
            return null
          }
          this.loading = true
          let formData = new FormData()
          formData.append('quantity', event.target.value)
          formData.append('_token', this.csrf)
          fetch(`/api/shoplist/${item.shoplist_id}/change_quantity`, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(result => {
              if (result.success == 1) {
                item = event.target.value
              } else {
                console.log('Error');
              }
              this.loading = false
            })
        }
      }
    },

    deleteItem(item) {
      if (!this.loading) {
        this.loading = true
        let formData = new FormData()
        formData.append('_token', this.csrf)
        fetch(`/api/shoplist/${item.shoplist_id}/delete`, {
          method: 'POST',
          body: formData
        })
          .then(response => response.json())
          .then(result => {
            if (result.success == 1) {
              item.quantity = 0
              item.shoplist_id = null
            } else {
              console.log('Error');
            }
            this.loading = false
          })
      }
    }
  }
})

const vm = app.mount('#container')