<x-app-layout>
    <div class="container" x-data="init()">
        <div class="row justify-content-center">
            <div class="col-12">
                <h5 class="my-5">
                    {{ $list->title }}
                </h5>

                <form class="d-flex mb-4" role="search">
                    <input class="form-control me-2" type="search" x-model="searchForm.keyword" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit" @click.prevent="search">Search</button>
                </form>

                <div class="row">
                    <div class="col-3">
                        <form>
                            <input class="form-control mb-2" type="search" x-ref="searchTags" x-model="searchForm.tags" id="searchTags" placeholder="Filter by tags">
                            <button class="btn btn-outline-primary form-control mb-2" type="button" @click.prevent="search">Filter</button>
                            <button class="btn btn-outline-primary form-control mb-2" type="button" @click.prevent="searchForm.tags = []">Clear Filters</button>
                        </form>
                    </div>

                    <div class="col-6">
                        <!-- Modal -->
                        <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editTaskModalLabel">Edit the Task</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <template x-if="editForm.success">
                                        <div class="alert alert-success position-relative">
                                            <span x-text="editForm.success"></span>
                                            <button @click="editForm.success = null" type="button" class="btn position-absolute top-50 end-0 translate-middle">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </template>

                                    <template x-if="editForm.errors">
                                        <div class="alert alert-danger position-relative">
                                            <ul class="mb-0">
                                                <template x-for="error in editForm.errors">
                                                    <li x-text="error"></li>
                                                </template>
                                            </ul>
                                            <button @click="editForm.errors = null" type="button" class="btn position-absolute top-50 end-0 translate-middle">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </template>

                                    <div class="d-flex justify-content-center">
                                        <div class="position-relative mb-3">
                                            <a :href="editForm.image">
                                                <img width="150" height="150" :src="editForm.thumbnail" id="thumbnail" class="rounded-start">
                                            </a>
                                            <div class="d-flex position-absolute top-0 end-0">
                                                <button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('image').click();"><i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" @click="deleteImage"><i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                            <input type="file" id="image" @change="updateImage($event)" class="visually-hidden">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" x-model="editForm.title" class="form-control" placeholder="Title">
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" x-ref="tags" class="form-control" x-model="editForm.tags" id="editTags" placeholder="Tags">
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" x-model="editForm.completed" id="completed">
                                        <label class="form-check-label" for="completed">
                                          Completed
                                        </label>
                                      </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" @click.prevent="update" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <template x-for="task in tasks">
                            <div class="card mb-3">
                                <div class="card-body row align-items-center">
                                    <div class="col-10">
                                        <h6 class="card-title">
                                            <a href="#" x-text="task.title" :class="task.completed ? 'link-success text-decoration-line-through': ''" data-bs-toggle="modal" data-bs-target="#editTaskModal" @click.prevent="loadTask(task)"></a>
                                        </h6>
                                        <p class="mb-0 d-flex gap-1">
                                            <template x-for="tag in task.tags">
                                                <span class="badge text-bg-secondary" x-text="tag.name.en"></span>
                                            </template>
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <template x-if="createForm.success">
                                    <div class="alert alert-success position-relative">
                                        <span x-text="createForm.success"></span>
                                        <button @click="createForm.success = null" type="button" class="btn position-absolute top-50 end-0 translate-middle">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </template>

                                <template x-if="createForm.errors">
                                    <div class="alert alert-danger position-relative">
                                        <ul class="mb-0">
                                            <template x-for="error in createForm.errors">
                                                <li x-text="error"></li>
                                            </template>
                                        </ul>
                                        <button @click="createForm.errors = null" type="button" class="btn position-absolute top-50 end-0 translate-middle">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </template>

                                <div class="mb-3">
                                    <input type="text" x-model="createForm.title" class="form-control" placeholder="Title">
                                </div>
                                <div>
                                    <button type="button" @click.prevent="create" class="form-control btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>

    <script>
        function init() {
            return {
                createForm: {
                    success: null,
                    errors: null,
                    title: ''
                },
                editForm: {
                    success: null,
                    errors: null,
                    id: null,
                    title: '',
                    thumbnail: null,
                    image: null,
                    tags: [],
                    completed: false,
                },
                TagHelper: {
                    parse(tags) {
                        return tags ? 
                            JSON.parse(tags).map(tag => tag.value) :
                            [];
                    },
                    toArray(tags) {
                        return tags.map(tag => tag.name.en);
                    }
                },
                searchForm: {
                    keyword: '',
                    tags: []
                },
                list: {{ $list->id }},
                tasks: [],
                init() {
                    this.loadTasks();
                },
                loadTasks(options) {
                    axios.get(`/api/lists/${this.list}/tasks`, {
                        params: options
                    }).then(response => {
                        this.tasks = response.data.result;
                    })
                },
                loadTask(task) {
                    this.editForm.errors = null;
                    this.editForm.success = null;
                    this.editForm.id = task.id;
                    this.editForm.image = task.image;
                    this.editForm.title = task.title;
                    this.editForm.thumbnail = task.thumbnail ? task.thumbnail : 'https://placehold.co/300x300';
                    this.editForm.completed = Boolean(task.completed);
                    this.editForm.tags = this.TagHelper.toArray(task.tags);
                },
                search() {
                    this.searchForm.tags = this.TagHelper.parse(this.$refs.searchTags.value)
                    this.loadTasks(this.searchForm);
                },
                update() {
                    tags = this.TagHelper.parse(this.$refs.tags.value);

                    axios.patch(`/api/tasks/${this.editForm.id}`, {
                        title: this.editForm.title,
                        tags: tags,
                        completed: this.editForm.completed
                    }).then(response => {
                        this.loadTasks()
                        this.editForm.success = "The data has been updated.";
                    }).catch(error => {
                        this.editForm.errors = error.response.data.errors;
                    });
                },
                updateImage(event) {
                    const formData = new FormData();
                    formData.append('image', event.target.files[0]);
                    formData.append("_method", "patch");

                    axios.post(`/api/tasks/${this.editForm.id}/update-image`, formData)
                        .then(response => {
                            this.loadTasks()
                            this.loadTask(response.data.result);
                            this.editForm.success = "The image has been updated.";
                        }).catch(error => {
                            this.editForm.errors = error.response.data.errors;
                        });
                },
                deleteImage() {
                    axios.patch(`/api/tasks/${this.editForm.id}/delete-image`)
                        .then(response => {
                            this.loadTasks()
                            this.loadTask(response.data.result);
                            this.editForm.success = "The image has been deleted."
                        });
                },
                create() {
                    axios.post(`/api/tasks`, {
                        list: this.list,
                        title: this.createForm.title
                    }).then(response => {
                        this.createForm.title = '';
                        this.loadTasks()
                        this.createForm.success = 'The task has been created.'
                    }).catch(error => {
                        this.createForm.errors = error.response.data.errors;
                    });
                },
            }
        }
    </script>
</x-app-layout>
