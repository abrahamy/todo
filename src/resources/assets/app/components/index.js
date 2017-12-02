import Tasks from './Tasks.vue'

const components = [
  Tasks
]

export default (() => {
  let retVal = {}

  components.forEach(component => {
    retVal[component.name] = component
  })

  return retVal
})()
