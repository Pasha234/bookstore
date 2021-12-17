const app = Vue.createApp({
  data() {
    return {
      discountItems: [],
      loading: false,
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  created() {
    this.fetchDiscountItems()
  },
  methods: {
    fetchDiscountItems() {
      fetch(`api/products/getDiscountProducts`)
        .then(response => response.json())
        .then(result => this.discountItems = result)
    },

    addInShoplist(index) {
      if (!this.loading) {
        this.loading = true
        let formData = new FormData()
        formData.append('_token', this.csrf)
        fetch(`api/shoplist/${this.discountItems[index].id}/add`, {
          method: 'POST',
          body: formData,
        })
          .then(response => response.json())
          .then(result => {
            if (result.success == 1) {
              this.discountItems[index].quantity = 1
              this.discountItems[index].shoplist_id = Number(result.id)
            } else {
              console.log('Error: cannot add an item in the shoplist');
            }
            this.loading = false
          })
      }
    },
    incrementCounter(index) {
      if (this.discountItems[index].quantity < 999) {
        if (!this.loading) {
          this.loading = true
          let formData = new FormData()
          formData.append('quantity', this.discountItems[index].quantity + 1)
          formData.append('_token', this.csrf)
          fetch(`/api/shoplist/${this.discountItems[index].shoplist_id}/change_quantity`, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(result => {
              if (result.success == 1) {
                this.discountItems[index].quantity++
              } else {
                console.log('Error: cannot increment value');
              }
              this.loading = false
            })
        }
      }
    },
    decrementCounter(index) {
      if (this.discountItems[index].quantity > 0) {
        if (!this.loading) {
          if (this.discountItems[index].quantity == 1) {
            this.deleteItem(index)
            return null
          }
          this.loading = true
          let formData = new FormData()
          formData.append('quantity', this.discountItems[index].quantity - 1)
          formData.append('_token', this.csrf)
          fetch(`/api/shoplist/${this.discountItems[index].shoplist_id}/change_quantity`, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(result => {
              if (result.success == 1) {
                this.discountItems[index].quantity--
              } else {
                console.log('Error: cannot decrement value');
              }
              this.loading = false
            })
        }
      }
    },
    inputQuantity(event, index) {
      event.preventDefault()
      if (!isNaN(Number(event.target.value)) && Number(event.target.value) >= 0) {
        if (!this.loading) {
          if (Number(event.target.value) === 0) {
            this.deleteItem(index)
            return null
          }
          this.loading = true
          let formData = new FormData()
          formData.append('quantity', event.target.value)
          formData.append('_token', this.csrf)
          fetch(`/api/shoplist/${this.discountItems[index].shoplist_id}/change_quantity`, {
            method: 'POST',
            body: formData
          })
            .then(response => response.json())
            .then(result => {
              if (result.success == 1) {
                this.discountItems[index].quantity = event.target.value
              } else {
                console.log('Error');
              }
              this.loading = false
            })
        }
      }
    },

    deleteItem(index) {
      if (!this.loading) {
        this.loading = true
        let formData = new FormData()
        formData.append('_token', this.csrf)
        fetch(`/api/shoplist/${this.discountItems[index].shoplist_id}/delete`, {
          method: 'POST',
          body: formData
        })
          .then(response => response.json())
          .then(result => {
            if (result.success == 1) {
              this.discountItems[index].quantity = 0
              this.discountItems[index].shoplist_id = null
            } else {
              console.log('Error');
            }
            this.loading = false
          })
      }
    }
  }
})

app.mount('#container')