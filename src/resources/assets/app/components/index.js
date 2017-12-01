import TaskList from './TaskList.vue'

const components = [
  TaskList
]

export default (() => {
  let retVal = {}

  components.forEach(component => {
    retVal[component.name] = component
  })

  return retVal
})()
