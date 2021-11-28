document.addEventListener('DOMContentLoaded', function() {
  const navbar = document.getElementById('sidebar')
  const overlay = document.querySelector('.overlay')

  function expandNavBar() {
    navbar.classList.add('active')
    navbar.style.left = '0'
    overlay.style.opacity = 0
    overlay.classList.add('active')
    overlay.style.opacity = 1
  }

  function diminishNavBar() {
    navbar.style.left = null
    overlay.style.opacity = 0
    setTimeout(() => {
      navbar.classList.remove('active')
      overlay.classList.remove('active')
    }, 600);
    
  }

  document.getElementById('burger').addEventListener('click', diminishNavBar)
  document.querySelector('.overlay').addEventListener('click', diminishNavBar)
  document.getElementById('burger_min').addEventListener('click', expandNavBar)
})