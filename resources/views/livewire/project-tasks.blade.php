<div class="my-4 mx-4">
    <h1>Task Board</h1>
    <div class="accordion">
        @forelse ($projects as $p)
            <div wire:key="{{ $p->id }}" class="border border-black p-3 my-4 rounded-3 d-flex justify-content-between align-items-center"  x-data="{}">
                <div>
                    <h3 id="h3{{ $p->id }}">{{ $p->project_name }}</h3>
                </div>

                <div class="d-flex">
                    <button class="accordion-button collapsed" type="button"
                    wire:click="toggleAccordion({{ $p->id }})"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse{{ $p->id }}"
                    aria-expanded="false"
                    aria-controls="collapse{{ $p->id }}"></button>
                </div>

            </div>
            <div id="collapse{{ $p->id }}" class="accordion-collapse collapse {{ in_array($p->id, $openProjectIds) ? 'show' : '' }}"
                aria-labelledby="h3{{ $p->id }}"
                data-bs-parent="#accordion">
                <div>
                    <button class="btn btn-success rounded-1" wire:click="toggleInput">New Task</button>
                </div>
                @if ($showInput)
                    <input class="my-2" placeholder="Input task name" type="text" wire:model.live="newTaskName" wire:keydown.enter="storeTask({{ $p->id }})">
                @endif
                <div class="accordion-content"
                    data-project-id="{{ $p->id }}"
                    x-init="
                        new Sortable($el, {
                            animation: 150,
                            handle: '.drag-handle',
                            ghostClass: 'sortable-ghost',
                            onEnd: function(e) {
                                const itemIds = Array.from(e.to.children).map(item => item.dataset.taskId);
                                $wire.call('updateTaskOrder', e.from.dataset.projectId, itemIds);
                            }
                        })
                    ">
                    @forelse ($p->tasks as $t)
                        <div class="border border-black p-3 my-4 rounded-3 d-flex justify-content-between align-items-center"
                        data-task-id="{{ $t->id }}">
                            <span class="drag-handle text-gray-400 hover:text-gray-600 cursor-grab me-3">
                                &#x2261; {{-- Hamburger icon --}}
                            </span>
                            @if($editTaskId == $t->id)
                                <input class="my-2" placeholder={{ $t->task_name }} type="text" wire:model.live="editTaskName" >
                            @else
                                <div>
                                    <p>#{{ $t->priority }} {{ $t->task_name}}</p>
                                </div>
                            @endif

                            <div class="d-flex gap-2">
                                @if($editTaskId == $t->id)
                                    <button class="btn btn-primary rounded-1" wire:click="updateTask({{ $t->id }})">Save</button>
                                    <button class="btn btn-danger rounded-1" wire:click="cancelEdit">Cancel</button>
                                @else
                                    <button class="btn btn-primary rounded-1" wire:click="editTask({{ $t->id }}, '{{ $t->task_name }}')">Update</button>
                                    <button class="btn btn-danger rounded-1" wire:click="deleteTask({{ $t->id }}, {{ $t->project_id }})">Delete</button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p>No task yet on this project</p>
                    @endforelse
                </div>
            </div>
        @empty
            <p>No projects yet.</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</div>
