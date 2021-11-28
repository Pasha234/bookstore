document.addEventListener('DOMContentLoaded', function() {
  let current_slide = 1
  const slider_img_container = document.getElementById('slider_img_container')
  const slider_text_container = document.getElementById('sliderText')
  const slider_pagination = document.getElementById('slider_pagination')
  let current_img = slider_img_container.querySelector(`img[data-number="${current_slide}"]`)
  let current_text = slider_text_container.querySelector(`span[data-number="${current_slide}"]`)

  function changeSlideListener(event) {
    if (event.target.id == 'slider_arrow_right'){
      if (slider_img_container.querySelector(`img[data-number="${current_slide+1}"]`)) {
        changeSlide(current_slide + 1)
      } else {
        changeSlide(1)
      }
    } else if (event.target.id == 'slider_arrow_left') {
      if (current_slide > 1) {
        changeSlide(current_slide - 1)
      } else {
        slider_pagination.querySelectorAll('.pagination__dot')[current_slide-1].classList.remove('active')
        current_text.style.display = 'none'
        current_img.style.display = 'none'
        current_img = slider_img_container.lastChild
        current_img.style.display = 'block'
        current_slide = current_img.dataset.number
        current_text = slider_text_container.querySelector(`span[data-number="${current_slide}"]`)
        current_text.style.display = 'block'
        slider_pagination.querySelectorAll('.pagination__dot')[current_slide-1].classList.add('active')
      }
      
    } else if (event.target.dataset.dot) {
      changeSlide(event.target.dataset.number)
    }
  }

  function changeSlide(slideNumber) {
    slider_pagination.querySelectorAll('.pagination__dot')[current_slide-1].classList.remove('active')
    current_text.style.display = 'none'
    current_slide = slideNumber
    current_img.style.display = 'none'
    current_img = slider_img_container.querySelector(`img[data-number="${current_slide}"]`)
    current_text = slider_text_container.querySelector(`span[data-number="${current_slide}"]`)
    current_img.style.display = 'block'
    current_text.style.display = 'block'
    slider_pagination.querySelectorAll('.pagination__dot')[current_slide-1].classList.add('active')
  }

  document.getElementById('slider').addEventListener('click', changeSlideListener)
})
