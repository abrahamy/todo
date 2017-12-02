import Buefy from 'buefy'
import Vue from 'vue'
import TasksComponent from './components/Tasks.vue'

if (process.env.NODE_ENV !== 'production') {
    Vue.config.debug = true
    Vue.config.devtools = true
}

Vue.use(Buefy, { defaultIconPack: 'fa' })

const app = new Vue({
  el: '#app',
  components: {
      tasks: TasksComponent
  }
})
