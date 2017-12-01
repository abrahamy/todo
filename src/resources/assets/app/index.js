import Vue from 'vue'
import components from './components'
import plugin from './plugin'

Vue.use(plugin)

const app = new Vue({
  el: '#app',
  components
})
