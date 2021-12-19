const app = Vue.createApp({
  data() {
    return {
      loading: false,
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      orders: [],
      change_avatar: false,
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
    },

    changeAvatar(event) {
      let formData = new FormData()
      formData.append('_token', this.csrf)
      formData.append('avatar', event.target.files[0])
      fetch(`/api/personal/changeAvatar`, {
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            document.getElementById('avatar_sidebar').setAttribute('src', "/storage/" + result.img)
            document.getElementById('avatar_personal').setAttribute('src', "/storage/" + result.img)
          }
        })
    },

    showAvatarForm() {
      if (this.change_avatar) {
        this.change_avatar = false
      } else {
        this.change_avatar = true
      }
    }
  }
})

const vm = app.mount('#container')