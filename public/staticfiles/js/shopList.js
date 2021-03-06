const app = Vue.createApp({
  data() {
    return {
      items: [],
      loading: false,
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  created() {
    this.fetchItems()
  },
  methods: {
    fetchItems() {
      fetch('/api/shoplist')
        .then(response => response.json())
        .then(result => {
          this.items = result
        })
    },
    incrementCounter(index) {
      if (this.items[index].quantity < 999) {
        if (!this.loading) {
          this.loading = true
          let formData = new FormData()
          formData.append('quantity', this.items[index].quantity + 1)
          formData.append('_token', this.csrf)
          fetch(`/api/shoplist/${this.items[index].id}/change_quantity`, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(result => {
              if (result.success == 1) {
                this.items[index].quantity++
              } else {
                console.log('Error');
              }
              this.loading = false
            })
        }
      }
    },
    decrementCounter(index) {
      if (this.items[index].quantity > 1) {
        if (!this.loading) {
          this.loading = true
          let formData = new FormData()
          formData.append('quantity', this.items[index].quantity - 1)
          formData.append('_token', this.csrf)
          fetch(`/api/shoplist/${this.items[index].id}/change_quantity`, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(result => {
              if (result.success == 1) {
                this.items[index].quantity--
              } else {
                console.log('Error');
              }
              this.loading = false
            })
        }
      }
    },
    inputQuantity(event, index) {
      if (parseInt(event.target.value) && event.target.value > 1) {
        this.items[index].quantity = event.target.value
        if (!this.loading) {
          this.loading = true
          let formData = new FormData()
          formData.append('quantity', event.target.value)
          formData.append('_token', this.csrf)
          fetch(`/api/shoplist/${this.items[index].id}/change_quantity`, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(result => {
              if (result.success == 1) {
                this.items[index].quantity = event.target.value
              } else {
                console.log('Error');
              }
              this.loading = false
            })
        }
      }
    },
    changeQuantity(event, index) {
      if (parseInt(event.target.value) && event.target.value > 1) {
        this.items[index].quantity = event.target.value
      }
    },

    deleteItem(index) {
      if (this.items[index]) {
        if (!this.loading) {
          this.loading = true
          let formData = new FormData()
          formData.append('_token', this.csrf)
          fetch(`/api/shoplist/${this.items[index].id}/delete`, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(result => {
              if (result.success == 1) {
                this.items.splice(index, 1)
              } else {
                console.log('Error');
              }
              this.loading = false
            })
        }
      }
    }
  },
  computed: {
    totalSum() {
      if (this.items.length) {
        return this.items.reduce((total, value) => total + Number(value.price) * Number(value.quantity), 0).toFixed(2)
      } else {
        return 0
      }
    }
  }
})

app.mount('#container')