<x-app-layout>
    <div class="container mt-5" x-data="init()">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h5>
                        Todo Lists
                    </h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Create List
                    </button>

                    <div class="modal fade right" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width: 350px;">
                            <form class="modal-content">
                                <div class="modal-header py-4">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create a list</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                        <template x-if="createForm.success">
                                            <div>
                                                <div class="alert alert-success position-relative">
                                                    <span x-text="createForm.success"></span>
                                                    <button @click="createForm.success = null" type="button" class="btn position-absolute top-50 end-0 translate-middle">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
            
                                        <template x-if="createForm.errors">
                                            <div>
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
                                            </div>
                                        </template>

                                        <div class="mb-3">
                                            <input type="text" x-model="createForm.title" class="form-control" placeholder="Title" required>
                                        </div>
                
                                        <div class="mb-3">
                                            <textarea class="form-control" x-model="createForm.description" placeholder="Description" rows="4"></textarea>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" @click.prevent="createList" class="btn btn-primary">Create</button>
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <template x-for="list in lists">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title"><a :href="`/lists/${list.id}`" x-text="list.title"></a></h5>
                                  <p class="card-text" x-text="list.description"></p>
                                </div>
                            </div>
                        </div>
                    </template>
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
                    title: '',
                    description: ''
                },
                lists: [],
                init() {
                    this.loadLists();
                },
                loadLists() {
                    axios.get('/api/lists').then(response => {
                        this.lists = response.data.result;
                    })
                },
                createList() {
                    axios.post('/api/lists', {
                        title: this.createForm.title,
                        description: this.createForm.description
                    }).then(response => {
                        this.loadLists();
                        this.createForm.title = '';
                        this.createForm.description = ''
                        this.createForm.success = 'The list has been created.'
                    }).catch(error => {
                        this.createForm.errors = error.response.data.errors;
                    });
                }
            }
        }
    </script>
</x-app-layout>
