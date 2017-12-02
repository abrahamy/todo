import axios from 'axios'
import Buefy from 'buefy'
import Vue from 'vue'
import TasksComponent from './components/Tasks.vue'

if (process.env.NODE_ENV !== 'production') {
    Vue.config.debug = true
    Vue.config.devtools = true
}

Vue.use(Buefy, { defaultIconPack: 'fa' })

document.addEventListener('DOMContentLoaded', event => {
    const http = axios.create({
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
      }
    })

    Object.defineProperty(Vue.prototype, '$axios', { value: http })
})

const app = new Vue({
  el: '#app',
  components: {
      tasks: TasksComponent
  }
})
