const app = Vue.createApp({
  data() {
    return {
      searchItems: [],
      loading: false,
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      category: window.location.pathname.match(/^\/([^\/]*)/m)[1],
      searchedItems: [],
      minPrice: '',
      maxPrice: '',
      searchWord: '',
      errorHandler: '',
    }
  },
  created() {
    let uri = window.location.href.split('?');
    let getVars = []
    if(uri.length == 2) {
      let vars = uri[1].split('&');
      getVars = [];
      vars.forEach(function(v) {
        getVars.push(v)
      });
    }
    getVars.forEach(value => {
      let vars = value.split('=')
      if (vars[0] == 'min_price') {
        this.minPrice = vars[1]
      }
      if (vars[0] == 'max_price') {
        this.maxPrice = vars[1]
      }
      if (vars[0] == 'search_word') {
        this.searchWord = decodeURI(vars[1])
      }
    })
    if (getVars)
    this.fetchSearchedItems(getVars)
  },
  methods: {
    fetchSearchedItems(getVars) {
      let getString = ''
      if (getVars.length > 0) {
        getString = '?' + getVars.join('&')
      }
      fetch(`/api/${this.category}/search${getString}`)
        .then(response => response.json())
        .then(result => result.error ? this.errorHandler = result.msg : this.searchedItems = result)
    },

    getDirections() {
      return Array.from(document.querySelectorAll('#direction_fields .direction__field input')).filter(value => value.checked).map(input => input.value).join(',')
    },

    doSearch() {
      let getVars = []
      let directions = this.getDirections()
      if (directions) {
        getVars.push(`directions=` + directions)
      }
      if (this.minPrice.replace(' ', '')) {
        getVars.push('min_price=' + this.minPrice)
      }
      if (this.maxPrice.replace(' ', '')) {
        getVars.push('max_price=' + this.maxPrice)
      }
      if (this.searchWord.replace(' ', '')) {
        getVars.push('search_word=' + this.searchWord)
      }
      history.pushState(null, null, '?' + getVars.join('&'))
      this.fetchSearchedItems(getVars)
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