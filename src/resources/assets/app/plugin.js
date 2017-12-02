import axios from 'axios'
import Buefy from 'buefy'

const installAxios = Vue => {
  document.addEventListener('DOMContentLoaded', event => {
    const instance = axios.create({
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
      }
    })

    console.log('Testing')

    Object.defineProperty(Vue.prototype, '$axios', { value: instance })
  })
}

const debugMode = Vue => {
  if (process.env.NODE_ENV !== 'production') {
    Vue.config.debug = true
    Vue.config.devtools = true
  }
}

export default {
  install (Vue) {
    Vue.use(Buefy, { defaultIconPack: 'fa' })
    installAxios(Vue)
    debugMode(Vue)
  }
}
