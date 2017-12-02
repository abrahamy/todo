<template>
    <nav class="panel">
        <p class="panel-heading">
            Tasks
        </p>
        <div class="panel-block">
            <b-field grouped>
                <b-input type="text"
                    placeholder="Description"
                    v-model="task.description"
                    expanded required/>
                <b-select placeholder="Pick a category"
                    v-model="task.category_id"
                    required>
                    <option v-for="category in categories"
                        :value="category.id"
                        :key="category.id">
                        {{ category.name }}
                    </option>
                </b-select>
                <p class="control">
                    <button class="button is-primary" @click.prevent="storeTask">
                        <b-icon icon="send"></b-icon>
                    </button>
                </p>
            </b-field>
            <button class="button is-text" type="button"
                @click.prevent="createCategory">
                Add New Category
            </button>
        </div>
        <label class="panel-block"
            v-for="task in pendingTasks"
            :key="task.id">
            <input type="checkbox"
                @click="toggleDone(task)"> {{ task.description }}
        </label>
        <label class="panel-block has-text-grey-lighter has-line-through"
            v-for="task in completedTasks"
            :key="task.id">
            <input type="checkbox"
                @click="toggleDone(task)"> {{ task.description }}
        </label>
    </nav>
</template>

<script>
export default {
  name: "task-list",
  mounted(){
      this.getInitialData()
  },
  data(){
      return {
          categories: [],
          tasks: [],
          task: {},
          urls: {
              categories: '/todo/categories',
              tasks: '/todo/tasks'
          }
      }
  },
  computed: {
      pendingTasks(){
          this.tasks.filter(t => !t.done)
      },
      completedTasks(){
          return this.tasks.filter(t => t.done)
      }
  },
  methods: {
    getInitialData() {
        let getters = [
            this.urls.categories,
            this.urls.tasks
        ].map(this.$axios.get)

        let loadingComponent = this.$loading.open()
        this.$axios.all(getters).then(this.$axios.spread(
            (categoriesResponse, tasksResponse) => {
                loadingComponent.close()
                this.categories = categoriesResponse.data.data
                this.tasks = tasksResponse.data.data
            }
        )).catch(error => {
            loadingComponent.close()
            this.$toast.open({
                type: 'is-danger',
                message: 'Unable to retrieve data at this moment, please try again later.'
            })
            console.log(error)
        })
    },
    fetchTasks(){
        this.$axios.get(this.urls.tasks).then(response => {
            this.tasks = response.data.data
        })
    },
    fetchCategories(){
        this.$axios.get(this.urls.categories).then(response => {
            this.categories = response.data.data
        })
    },
    storeTask() {
        if (!(this.task.description && this.task.category_id)) {
            this.$toast.open({
                type: 'is-warning',
                message: 'Task and Category are required!'
            })
            return
        }

        let payload = { ...this.task }
        let loadingComponent = this.$loading.open()
        this.$axios.post(this.urls.tasks, payload).then(response => {
            loadingComponent.close()
            this.$toast.open({
                type: 'is-success',
                message: 'Task saved!'
            })
            this.task = {}
            this.fetchTasks()
        }).catch(error => {
            loadingComponent.close()
            this.$toast.open({
                type: 'is-danger',
                message: error.response && error.response.data.message ?
                    error.response.data.message : 'An unexpected error occured, task not saved.'
            })
            console.log(error)
        })
    },
    toggleDone(task){
        let payload = { ...task }
        let url = `${this.urls.tasks}/${payload.id}`
        let loadingComponent = this.$loading.open()

        payload.done = !payload.done
        this.$axios.put(url, payload).then(response => {
            loadingComponent.close()
            this.fetchTasks()
        }).catch(error => {
            this.$toast.open({
                type: 'is-danger',
                message: error.response && error.response.data.message ?
                    error.response.data.message : 'An unexpected error occured, action failed.'
            })
            console.log(error)
        })
    },
    createCategory(){
        this.$dialog.prompt({
            message: 'Category Name:',
            maxlength: 30,
            onConfirm: (value) => {
                let loadingComponent = this.$loading.open()
                this.$axios.post(
                    this.urls.categories, { name: value }
                ).then(response => {
                    loadingComponent.close()
                    this.fetchCategories()
                    this.$toast.open('New category added!')
                }).catch(error => {
                    loadingComponent.close()
                    console.log(error)
                })
            }
        })
    }
  }
};
</script>

<style lang="sass" scoped>
// Font Awesome
@import "~font-awesome/css/font-awesome";

// Buefy: Bulma Components for VueJS
@import "~bulma/bulma";
@import "~buefy/src/scss/buefy";

.has-line-through {
    text-decoration: line-through;
}
</style>


