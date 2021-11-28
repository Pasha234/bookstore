const app = Vue.createApp({
  data() {
    return {
      counter: 0,
      items: [{
        title: 'Властелин Колец',
        price: '450',
        prev_price: '650',
        img: '/staticfiles/img/LOTR.jpg',
        quantity: 1,
      }],
    }
  },
  methods: {
    incrementCounter(index) {
      if (this.items[index].quantity < 999) {
        this.items[index].quantity++
      }
    },
    decrementCounter(index) {
      if (this.items[index].quantity > 1) {
        this.items[index].quantity--
      }
    },
    inputQuantity(event, index) {
      if (parseInt(event.target.value) && event.target.value > 1) {
        this.items[index].quantity = event.target.value
      }
    },
    changeQuantity(event, index) {
      if (parseInt(event.target.value) && event.target.value > 1) {
        this.items[index].quantity = event.target.value
      }
    },

  },
  computed: {
    totalSum() {
      return this.items.reduce((total, value) => total + Number(value.price), 0)
    }
  }
})

app.mount('#container')