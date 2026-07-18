(() => {
  const ready = (callback) => {
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
      callback()
    } else {
      document.addEventListener('DOMContentLoaded', callback)
    }
  }

  ready(() => {
    const navToggle = document.querySelector('.nav-toggle')
    const siteNav = document.querySelector('.site-nav')

    if (navToggle && siteNav) {
      const closeSubmenus = (exceptItem) => {
        siteNav.querySelectorAll('.menu-item-has-children.is-submenu-open').forEach((item) => {
          if (item !== exceptItem) {
            item.classList.remove('is-submenu-open')
            const link = item.querySelector(':scope > a')
            if (link) link.setAttribute('aria-expanded', 'false')
          }
        })
      }

      navToggle.addEventListener('click', () => {
        const isOpen = siteNav.classList.toggle('is-open')
        navToggle.classList.toggle('is-open', isOpen)
        navToggle.setAttribute('aria-expanded', String(isOpen))
        document.body.classList.toggle('nav-open', isOpen)
        if (!isOpen) closeSubmenus()
      })

      siteNav.querySelectorAll('.menu-item-has-children > a').forEach((link) => {
        link.addEventListener('click', (event) => {
          event.preventDefault()

          const item = link.parentElement
          if (!item) return

          const isOpen = item.classList.toggle('is-submenu-open')
          link.setAttribute('aria-expanded', String(isOpen))
          if (isOpen) closeSubmenus(item)
        })
      })

      siteNav.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
          if (link.parentElement?.classList.contains('menu-item-has-children')) {
            return
          }

          if (siteNav.classList.contains('is-open')) {
            siteNav.classList.remove('is-open')
            navToggle.classList.remove('is-open')
            navToggle.setAttribute('aria-expanded', 'false')
            document.body.classList.remove('nav-open')
            closeSubmenus()
          }
        })
      })

      document.addEventListener('click', (event) => {
        if (!siteNav.contains(event.target)) {
          closeSubmenus()
        }
      })
    }

    const revealElements = document.querySelectorAll('.reveal-on-scroll, .animate-fade-up')
    if (revealElements.length) {
      if (!('IntersectionObserver' in window)) {
        revealElements.forEach((el) => el.classList.add('is-visible'))
        return
      }

      document.documentElement.classList.add('js-reveal')

      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-visible')
              observer.unobserve(entry.target)
            }
          })
        },
        { threshold: 0.15 }
      )

      revealElements.forEach((el) => observer.observe(el))
    }
  })
})()
